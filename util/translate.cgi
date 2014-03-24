#!/bin/sh
#
#   http://code.google.com/media-translate/
#   Copyright (C) 2010  Serge A. Timchenko
#
#   This program is free software: you can redistribute it and/or modify
#   it under the terms of the GNU General Public License as published by
#   the Free Software Foundation, either version 3 of the License, or
#   (at your option) any later version.
#
#   This program is distributed in the hope that it will be useful,
#   but WITHOUT ANY WARRANTY; without even the implied warranty of
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#   GNU General Public License for more details.
#
#   You should have received a copy of the GNU General Public License
#   along with this program. If not, see <http://www.gnu.org/licenses/>.
#

#QUERY_STRING=scan

TRANSLATE=${TRANSLATE:-/usr/local/etc/translate}

. $TRANSLATE/lib/common

XSPFSCAN=${XSPFSCAN:-$BASEPATH/etc/xspf.scan}
STARTPOINT=${STARTPOINT:-''}
CACHEPATH=${CACHEPATH:-/tmp}
TEMP=${TEMP:-/tmp}

YOUTUBE_HD=${YOUTUBE_HD:-'yes'}
VIMEO_HD=${VIMEO_HD:-'yes'}
IVI_HD=${IVI_HD:-'yes'}
NET_BANDWIDTH=${NET_BANDWIDTH:-}

PLUGINS_DIR=$BASEPATH/plugins/
RC_OK=0
RC_FAIL=1

STREAM_TEST_TIMEOUT=15

DEFAULTFILTER="(mp3|mp2|mpga|ogg|wav|wma|wax|m4a|mp4a|avi|mpeg|mpg|mpe|wmv|wvx|wm|wmx|flv|qt|mov|asf|asx|mp4|m4v|mp4v|mpg4|xspf|m3u|pls|cue|txt|flac|jpg|jpeg|jpe|png|gif|bmp)"

UDPXY_URL=${UDPXY_URL:-'http://127.0.0.1:8080'}
UDPXY_URL=`echo "$UDPXY_URL" | awk '{sub(/\/$/, ""); gsub(/\//, "\\\/"); gsub(/\./, "\\\."); print}'`

#RTMPGW_URL=${RTMPGW_URL:-'http://127.0.0.1:88'}
RTMPGW_URL=`echo "$RTMPGW_URL" | awk '{sub(/\/$/, ""); print}'`

USERAGENT="Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13"

TMPFILE=$TEMP/$$.tmp

[ ! -d $CACHEPATH ] && CACHEPATH=$TEMP

arg_cmd=`echo "$QUERY_STRING" | awk -F, '{print $1}'`
arg_opt=`echo "$QUERY_STRING" | awk -F, '{print $2}'`
arg_url=`echo "$QUERY_STRING" | awk -F, '{for(i=3; i<NF; i++) printf "%s,", $(i); printf "%s", $(NF); }'`

arg_url=`urldecode_s "$arg_url"`
arg_opt=`urldecode_s "$arg_opt"`

# http://127.0.0.1/translate[?<scan|*>]
# http://127.0.0.1/translate?stream,[<option1;...optionN>],<url>

# Available options:
#   Content-type:<content type>
#   HD:<yes|no>
#   Protocol:<mms|mmst|mmsh|http|rtsp|ftp>
#   Bandwidth:<bps>
#   Speed:<streaming speed>

# http://127.0.0.1/translate?<info|status>,,<url>
# http://127.0.0.1/translate?text,,<url>
# http://127.0.0.1/translate?playlist,,<path to playlist>

# <list>
#   <item>
#     <title></title>
#     <location></location>
#   </item>
# </list>

#
# <info>
# <stream url="" type="" server="<icecast|shoutcast|youtube|vimeo>" class="<audio|video|playlist>" protocol="" server_url="" />
# <item>
#   <name/><value/>
# </item>
# <status>
#   <server-status>         s
#   <stream-status>         si (Mount started: <time>)
#   <listener-peak>         si (status: Stream is up at 96 kbps with 138 of 250 listeners (134 unique))
#   <average-listener-time> s
#   <stream-title/>         si
#   <content-type/>         si
#   <stream-genre/>         si
#   <current-song/>         si

#   <stream-bitrate/>       si (status: Stream is up at 96 kbps with 138 of 250 listeners (134 unique))
#   <listeners>             si (status: Stream is up at 96 kbps with 138 of 250 listeners (134 unique))

# </status>
# </info>
#

icy_name=
icy_genre=
icy_br=
icy_url=
icy_description=

ms_author=
ms_title= 

server_type='' # icecast | shoutcast | youtube | vimeo | rutube | ivi
stream_status_url=''

get_opt "Content-type"
stream_type=$opt

check_stream_flag=yes

local url_plugin=''
find_protocol_plugin "'$arg_url'" url_plugin
if [ -n "$url_plugin" ]; then
  . $PLUGINS_DIR"$url_plugin" "'$arg_url'"
fi

stream_url=${arg_url}

out_error_info()
{
  echo "Content-type: text/xml"
  echo 
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<info><error>$1</error><log><![CDATA["
  echo "$2"
  echo "]]></log></info>"
}

get_shoutcast_item()
{
  sed -e "s/.*$1: <\/font><\/td><td><font class=default><b>//" $TMPFILE | sed 's/<\/b>.*//' | sed 's/<.*>//g;s/&amp;/&/g;s/&nbsp;/ /g;s/&lt;/</g;s/&gt;/>/g'
}

get_icecast_item()
{
  sed "1,/$1:/d" $TMPFILE | sed '/.*:$/,$d' | sed 's/\n/ /g'
}

print_status_item()
{
  local s=`echo -n "$2" | awk '{gsub(/\t/," ");gsub(/\r/,"");print}' | sed 's/^[ \n]*//;s/[ \n]*$//;' | awk '{if(NR >1) printf("%s", " "); printf("%s", $0);}' | sed 's/ *$//'`
  [ -n "$s" ] && echo "<$1><![CDATA[`unescapeXML \"$s\"`]]></$1>"
  return 0
}

#urldecode() 
#{ 
#  echo -e "$(sed 'y/+/ /; s/%/\\x/g')"
#}
#urldecode()
#{
#  echo "$@" | sed 's/^.*$/'"`echo "$@" | sed 'y/+/ /; s/%/\\\\x/g; s/\//\\\\\//g'`"'/'
#}

test_stream()
{ 
  $MSDL $2 --debug -o ${TMPFILE} --stream-timeout 1 --no-treat-metafile $3 2>${TMPFILE}.log &
  
  local timeout=$1
  while /bin/ps | grep -q -s "^ *$! "; do
    let timeout=$timeout-1
    if [ $timeout -le 0 ]; then
      kill -9 $!
      break
    fi
    sleep 1
  done
  
  if [ $timeout -le 0 ]; then
      echo '!!timeout!!' >> ${TMPFILE}.log
      echo 'cannot establish stream' >> ${TMPFILE}.log
  fi
  
  cat ${TMPFILE}.log
  rm -f ${TMPFILE}.log
  rm -f ${TMPFILE}
  return 0
}  


check_av_stream()
{
  if [ "$check_stream_flag" == "no" ]; then
    return 0
  fi
  
  get_opt "Protocol"
  case $opt in
    mmst|mmsh|http|rtsp|ftp)
      msdlopt="-p $opt"
    ;;
    *)
      msdlopt=''
  esac

  get_opt "Bandwidth"
  [ -z "$opt" -a -n "$NET_BANDWIDTH" ] && opt=$NET_BANDWIDTH
  [ -n "$opt" ] && msdlopt="$msdlopt -b $opt"

  get_opt "Speed"
  [ -n "$opt" ] && msdlopt="$msdlopt -s $opt"

  buf=  
  if echo "$arg_url" | grep -q -s "^.*://"; then
  
#    if echo "$arg_url" | grep -q -s "^ftp://"; then
#      protocol='ftp'
#    else
      buf=`test_stream $STREAM_TEST_TIMEOUT "$msdlopt" "$arg_url"`

      ms_x_wms_contentdesc=`echo "$buf" | sed -n "/^a=pgmpu:data:application\/x\-wms\-contentdesc/p" | sed -n '$p'`
      ms_x_wms_contentdesc=`urldecode_s "$ms_x_wms_contentdesc"`
    
      if echo $buf | grep -q -s "!!timeout!!"; then
        if echo "$msdlopt" | grep -q -s "\-p "; then
          :
        else
          buf=`test_stream $STREAM_TEST_TIMEOUT "-p mmsh $msdlopt" "$arg_url"`
        fi
      elif echo $buf | grep -q -s "invalid redirection url"; then
        buf=`test_stream $STREAM_TEST_TIMEOUT "-p http $msdlopt" "$arg_url"`
      elif echo $buf | grep -q -s "MMSH header parse error by http header parse error"; then
        buf=`test_stream $STREAM_TEST_TIMEOUT "-p http $msdlopt" "$arg_url"`
      fi
      
      if echo $buf | grep -q -s "cannot establish stream"; then
        reason="`echo "$buf" | sed -n '/^cannot establish stream/{g;1!p;};h'`"
        out_error_info "cannot establish stream ($reason)" "$buf"
        exit
      fi  
      
      stream_url=`echo "$buf" | sed -n '/^url:/p' | sed -n '$p' | sed 's/ *url: *//'`
      protocol=`echo "$buf" | sed -n '/^download protocol:/p' | sed -n '$p' | sed 's/.*: //'`
      if [ "$protocol" == "rtsp - real" ]; then
        protocol='real'
      else
        protocol=`echo "$protocol" | awk '{print $1}'`
      fi
      redirect=`echo "$buf" | sed -n '/^redirect to/p' | sed -n '$p' | awk '{print $3}'`
      
      if [ -n "$redirect" ]; then
        stream_url=$redirect
      fi
      
      url_protocol=`echo $stream_url | sed 's/^\(.*\):\/\/.*$/\1/'`
      
      if [ "$protocol" == "mmsh" ]; then 
        stream_url=`echo $stream_url | sed "s/^\(.*\)\(:\/\/.*\)/$protocol\2/"`
      fi 
      
    
#    fi
  else
    protocol='file'
  fi
  
  if [ -z "$stream_type" ]; then
    type=`echo "$buf" | sed -n '/^[cC]ontent[ -][tT]ype/p' | sed -n '$p' | awk '{ match($0, /[ ;:]+([a-z]+\/[a-z\-]+)[ ;]*.*$/, arr); print arr[1]}'`
    
    # autodetect stream type
    
    if echo $buf | grep -qs "FINISHED"; then
      type=${type:-'application/octet-stream'}
    fi
    
    case $protocol in
      http|ftp|file)
        if [ "$protocol" == "http" ]; then
          if [ "$type" == "text/html" -o -z "$type" ]; then
            if echo "${stream_url}" | grep -q -s ".*[^a-zA-Z0-9]rss[^a-zA-Z0-9]*.*"; then
              type=application/xml
            elif echo "${stream_url}" | grep -q -s "^http://.*/\(udp\|rtp\)/[0-9\.:]*$"; then
              type=video/x-msvideo
            fi
          fi
        fi
        if [ -z "$type" -o "$type" == "text/plain" -o "$type" == "text/html" ]; then
          ext=`echo "${stream_url}" | sed 's/\./\n/g' | sed -n '$p'`
          case $ext in
            flv|FLV)
              type=video/x-flv
            ;;
            mp3|MP3|mp2|MP2|mpga|MPGA)
              type=audio/mpeg
            ;;
            wma|WMA)
              type=audio/x-ms-wma
            ;;
            wax|WAX)
              type=audio/x-ms-wax
            ;;
            wmv|WMV)
              type=video/x-ms-wmv
            ;;
            wvx|WVX)
              type=video/x-ms-wvx
            ;;
            wm|WM)
              type=video/x-ms-wm
            ;;
            wmx|WMX)
              type=video/x-ms-wmx
            ;;
            m3u|M3U)
              type=audio/x-mpegurl
            ;;
            pls|PLS)
              type=audio/x-scpls
            ;;
            cue|CUE)
              type=audio/x-cue
            ;;
            xspf|XSPF)
              type=application/xspf+xml
            ;;
            avi|AVI|mpeg|MPEG|mpg|MPG|mpe|MPE)
              type=video/mpeg
            ;;
            qt|QT|mov|MOV)
              type=video/quicktime
            ;;
            asf|ASF|asx|ASX)
              type=video/x-ms-asf
            ;;
            mp4|MP4|m4v|M4V)
              type=video/mp4
            ;;
            wav|WAV)
              type=audio/wav
            ;;
            ogg|OGG)
              type=application/ogg
            ;;
            rss|RSS)
              type=application/rss+xml
            ;;
            jpg|JPG|jpe|JPE|jpeg|JPEG)
              type=image/jpeg
            ;;
            png|PNG)
              type=image/png
            ;;
            gif|GIF)
              type=image/gif
            ;;
            bmp|BMP)
              type=image/bmp
            ;;
            txt|TXT)
              type=text/plain
            ;;
          esac
        elif echo "$type" | grep -q -s "\(video/x-ssf\)"; then
          type=video/x-flv
        elif echo "$type" | grep -q -s "\(audio/\|video/\|application/xspf\|application/ogg\|image\)"; then
          :
        elif echo "$type" | grep -q -s "\(text/xml\|application/xml\|application/rss\)"; then
          :
        elif echo "$type" | grep -q -s "\(application/octet-stream\)"; then
          type=video/x-msvideo
        else
          out_error_info "unknown content type: \"$type\"" "$buf"
          exit
        fi

        get_icy_meta()
        {
          echo "$buf" | sed -n "/^$1:/p" | sed -n '$p' | sed "s/^$1://" | $TOUTF8
        }
        
        icy_name=`get_icy_meta 'icy-name'`
        icy_name=${icy_name:-`get_icy_meta 'x-audiocast-name'`}
        icy_genre=`get_icy_meta 'icy-genre'`
        icy_genre=${icy_genre:-`get_icy_meta 'x-audiocast-genre'`}
        icy_br=`get_icy_meta 'icy-br'`
        icy_br=${icy_br:-`get_icy_meta 'x-audiocast-bitrate'`}
        icy_url=`get_icy_meta 'icy-url'`
        icy_url=${icy_url:-`get_icy_meta 'x-audiocast-url'`}
        icy_pub=`get_icy_meta 'icy-pub'`
        icy_pub=${icy_pub:-`get_icy_meta 'x-audiocast-public'`}
        icy_description=`get_icy_meta 'icy-description'`
        icy_description=${icy_description:-`get_icy_meta 'x-audiocast-description'`}
        icy_notice1=`get_icy_meta 'icy-notice1'`
        icy_notice2=`get_icy_meta 'icy-notice2'`

      ;;
      mmsh|mmst|rtsp)
        isvideostream=`echo "$buf" | grep "\(is video stream\|video stream detected!!!!\)"`
        isaudiostream=`echo "$buf" | grep "\(is audio stream\|audio stream detected!!!!\)"`
        if [ -n "$isvideostream" ]; then
          type=video/x-msvideo
        elif [ -n "$isaudiostream" ]; then
          type=audio/x-ms-wma
        else
          out_error_info "unknown stream" "$buf"
          exit
        fi
        
        ms_author=`echo "$ms_x_wms_contentdesc" | awk '/,author,/ { a=index($0, ",author,"); s=substr($0, a+8); a=index(s,","); s=substr(s, a+1); a=index(s,","); l=substr(s,0,a-1); s=substr(s,a+1,l); print s }'`
        ms_title=`echo "$ms_x_wms_contentdesc" | awk '/,title,/ { a=index($0, ",title,"); s=substr($0, a+7); a=index(s,","); s=substr(s, a+1); a=index(s,","); l=substr(s,0,a-1); s=substr(s,a+1,l); print s }'`
      ;;
      real)
        isvideostream=`echo "$buf" | grep "Video Stream \["`
        isaudiostream=`echo "$buf" | grep "Audio Stream \["`
        if [ -n "$isvideostream" ]; then
          type=`echo "$isvideostream" | sed 's/.*Stream \[//;s/\]//'`
        elif [ -n "$isaudiostream" ]; then
          type=`echo "$isaudiostream" | sed 's/.*Stream \[//;s/\]//'`
        else
          out_error_info "unknown stream" "$buf"
          exit
        fi
        
        ms_author=`echo "$buf" | grep "author     :" | sed 's/.*author     : //'`
        ms_title=`echo "$buf" | grep "title      :" | sed 's/.*title      : //'`
      ;;
      *)
        out_error_info "protocol not supported: \"$protocol\"" "$buf"
        exit
      ;;
    esac        
    
    stream_type=$type
  fi
  
  host=''
  host_response=''
  stream_class=`echo "$stream_type" | sed 's/\/.*//'`
  
  if [ "$protocol" == "http" -a "$stream_class" == "audio" ]; then
    # try to define stream server type
    host=`echo "$buf" | sed -n '/^Host: \[/p' | sed -n '$p' | awk '{print $3}'`
    
    case $arg_cmd in
      info)
        buf=`$MSDL --debug -o /dev/null -p http --useragent "${USERAGENT}" --stream-timeout 1 "http://${host}" 2>&1`
        host_content_type=`echo "$buf" | sed -n '/^[Cc]ontent\-[Tt]ype:/p' | sed -n '$p'`
      ;;
      status)
        host_content_type='text/html'
      ;;
      *)
        host_content_type=
      ;;
    esac
    
    if echo "$host_content_type" | grep -qs "text\/html"; then
      host_response=`$MSDL -q -o ${TMPFILE} -p http --useragent "${USERAGENT}" --stream-timeout 30 "http://${host}" 2>&1`
      if [ -f ${TMPFILE} ]; then
        if grep -qsi "[^a-z]icecast[^a-z]" ${TMPFILE}; then
          stream_status_url="http://${host}"
          server_type='icecast'
          host_response=`cat ${TMPFILE}`
        elif grep -qsi "[^a-z]shoutcast[^a-z]" ${TMPFILE}; then
          stream_status_url="http://${host}"
          server_type='shoutcast'
          host_response=`cat ${TMPFILE}`
        fi
      fi
      [ "${arg_cmd}" != "info" -a "${arg_cmd}" != "status" -o -z "$server_type" ] && rm -f ${TMPFILE}
    fi
    
    if [ -z "$server_type" ]; then
      if echo "${icy_notice1} ${icy_notice2}" | grep -q -s -i "shoutcast"; then
        server_type='shoutcast'
      fi
    fi
    
    local is_icy=`awk -v streamurl="$stream_url" -v statusurl="icyx://${host}" '
      BEGIN {
        match(statusurl, /^icyx:\/\/(.*):(.*)$/, arr);
        host_ip = arr[1];
        host_port = arr[2];
        match(streamurl, /^([^:]*):\/\/([^\/]*)(.*)$/, arr);
        host = arr[2];
        path = arr[3];
        
        if (path == "")  path = "/";

        HttpService = "/inet/tcp/0/" host_ip "/" host_port
        ORS = "\n\n"
        print "GET " path " HTTP/1.0" "\nHost: " host "\nAccept: */*" "\nIcy-MetaData: 1" |& HttpService
        ORS = "\n"
        RS = "\r?\n\r?\n"
        HttpService |& getline Header
        print match(Header, /icy-metaint: *([0-9]*)/, arr)
        close(HttpService)
      }
    '`
    if [ "$is_icy" != "0" ]; then
      stream_status_url="icyx://${host}"
      [ -z "$server_type" ] && server_type='icecast'
    fi

  fi
}

call_url_plugin()
{
  local url_plugin=
  find_plugin "'$arg_url'" url_plugin
  if [ -z "$url_plugin" ]; then
    check_av_stream
    return $RC_OK
  else
    . $PLUGINS_DIR"$url_plugin" "'$arg_url'"
  fi
}

check_stream()
{
  if echo "${arg_url}" | grep -q -s "^ftp:\/\/.*\/$"; then 
    # fictional ftp browser content type
    stream_type=application/x-ftp-browser
  elif echo "${arg_url}" | grep -q -s "^\(/.*/\|/\)$"; then 
    # fictional file browser content type
    stream_type=application/x-file-browser
  elif call_url_plugin; then
    :
  else
    check_av_stream
  fi
  
  [ "$stream_type" == "audio/x-shoutcast-stream" ] && stream_type=audio/x-scpls
  
  case $stream_type in
    audio/x-cue)
      stream_class='cue'
    ;;
    audio/x-mpegurl|application/xspf*|audio/x-scpls|*/x-ms-asf)
      stream_class='playlist'
    ;;
    application/ogg)
      stream_class='audio'
    ;;
    application/x-ftp-browser)
      protocol='ftp'
      stream_class='directory'
    ;;
    application/x-file-browser)
      protocol='file'
      stream_class='directory'
    ;;
    text/xml|application/xml|application/rss*)
      stream_class='rss'
    ;;
    *)
      stream_class=${stream_class:-`echo "$stream_type" | sed 's/\/.*//'`}
    ;;
  esac
  
  [ "$stream_class" == "playlist" ] && check_playlist
  
  return 0
}

check_playlist()
{
  get_opt "Resolve-playlist"
  local resolve=$opt
  [ "$resolve" == "0" ] && return 0;
  local playlist_file="$TEMP/temp.track"
  arg_url=$stream_url
  command_playlist | sed '1,2d;s/<track>/\n<track>/g;s/></>\n</g' > $playlist_file
  local count=`sed -n '/<track>/p' $playlist_file | sed -n '$='`
  if [ "$count" == "1" -o "$resolve" == "1" ]; then
    local buf=`awk -f getxml.awk -f getfirstitem.awk "$playlist_file" | sed '/^$/d'`
    local location=`echo "$buf" | sed -n '1p'`
    local title=`echo "$buf" | sed -n '2p'`
    local creator=`echo "$buf" | sed -n '3p'`
    if [ "$location" != "$stream_url" ]; then
      stream_url=''
      stream_type=''
      arg_url=$location
      check_stream
      icy_name=${icy_name:-"$title"}
      [ -n "$creator" ] && icy_name="$creator - $icy_name"
      ms_title=${ms_title:-"$title"}
      ms_author=${ms_author:-"$creator"}
    fi
  fi
#  rm -f $playlist_file
  return 0; 
}


command_playlist()
{
  echo "Content-type: text/xml"
  echo
  
  local playlist_file=${arg_url}
  
  local name=`echo "$arg_url" | sed 's/\//\n/g' | sed -n '$p'`
  local ext=`echo "$arg_url" | sed 's/\./\n/g' | sed -n '$p'`
  local path=`echo "$arg_url" | sed 's/\/[^\/]*$//'`
  
  if echo "${arg_url}" | grep -q -s ".*://"; then
    playlist_file="$TEMP/temp.playlist"
    rm -f $playlist_file
    protocol=`echo "$arg_url" | sed -e 's/:\/\/.*$//'`
    buf="`$MSDL --debug --useragent "${USERAGENT}" -o "$playlist_file" -p "$protocol" --no-treat-metafile "${arg_url}" 2>&1`"
#    type=`echo "$buf" | sed -n '/^content type/p' | sed -n '$p' | awk '{print $3}'`
    type=${stream_type:-`echo "$buf" | sed -n '/^[cC]ontent[ -][tT]ype/p' | sed -n '$p' | awk '{ match($0, /[ ;:]+([a-z]+\/[a-z\-]+)[ ;]*.*$/, arr); print arr[1]}'`}
    case $type in
      audio/x-cue)
        ext="cue"
      ;;
      audio/x-scpls|audio/x-shoutcast-stream)
        ext="pls"
      ;;
      audio/x-mpegurl)
        ext="m3u"
      ;;
      application/xspf*)
        ext="xspf"
      ;;
      */x-ms-asf)
        ext="asx"
      ;;
    esac
  fi
  
  case $ext in
    xspf|XSPF)
      cat "${playlist_file}"
    ;;
    m3u|M3U)
      if [ -f "${playlist_file}" ]; then
        awk -f $BASEPATH/bin/m3u2xspf -v name="$name" -v path="$path" -v ext="$ext" "${playlist_file}"
      else
        echo "<?xml version='1.0' encoding='UTF-8'?>"
        echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
        echo "<title><![CDATA[$playlist_file not found]]></title>"
        echo "</playlist>"
      fi
    ;;
    pls|PLS)
      if [ -f "${playlist_file}" ]; then
        awk -f $BASEPATH/bin/pls2xspf -v name="$name" -v path="$path" -v ext="$ext" "${playlist_file}"
      else
        echo "<?xml version='1.0' encoding='UTF-8'?>"
        echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
        echo "<title><![CDATA[$playlist_file not found]]></title>"
        echo "</playlist>"
      fi
    ;;
    cue|CUE)
      if [ -f "${playlist_file}" ]; then
        awk -f $BASEPATH/bin/cue2xspf -v path="$path" "${playlist_file}"
      else
        echo "<?xml version='1.0' encoding='UTF-8'?>"
        echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
        echo "<title><![CDATA[$playlist_file not found]]></title>"
        echo "</playlist>"
      fi
    ;;
    asx|ASX|asf|ASF)
      if [ -f "${playlist_file}" ]; then
        if grep -qsi "\[reference\]" ${playlist_file}; then
          cat "${playlist_file}" | awk '{gsub(/\t/," ");gsub(/\r/,"");sub(/^\s*/,"");sub(/\s*$/,"");print}' | awk -f $BASEPATH/bin/asf2xspf -v name="$name" -v path="$path"
        else
          cat "${playlist_file}" | awk '{gsub(/\t/," ");gsub(/\r/,"");print}' | sed 's/>[ \n]*</>\n</g;s/ *>/>/g;s/^ *//;s/ *$//' | awk -f $BASEPATH/bin/asx2xspf -v name="$name" -v path="$path"
        fi
      else
        echo "<?xml version='1.0' encoding='UTF-8'?>"
        echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
        echo "<title><![CDATA[$playlist_file not found]]></title>"
        echo "</playlist>"
      fi
    ;;
    *)
      echo "<?xml version='1.0' encoding='UTF-8'?>"
      echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
      echo "<title>Unknown playlist format</title>"
      echo "</playlist>"
    ;;
  esac    
  return 0
}

command_text()
{
  check_stream
  echo "Content-type: text/plain"
  echo
  echo "Protocol: $protocol"
  echo "Type: $stream_type"
  echo "Stream url: $stream_url"
  echo "Host: $host"
  echo "Host response: $host_response"
  echo "Server type: $server_type"
  echo
  echo "$buf"
  echo
  return 0
}

command_info()
{
  if [ "$arg_cmd" == "status" ]; then
    check_server
  else
    check_stream
  fi
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<info>"
  escaped_url="`echo $stream_url | sed 's/&/&amp;/g'`"
  if [ "$protocol" == "http" -o "$protocol" == "mms" -o "$protocol" == "mmsh" -o "$protocol" == "rtsp" ]; then
    escaped_url="`echo $escaped_url | sed 's/ /%20/g'`"
  fi 
  echo "<stream url=\"$escaped_url\" type=\"$stream_type\" class=\"$stream_class\" protocol=\"$protocol\" server=\"$server_type\" server_url=\"$stream_status_url\" />"
  case $stream_class in
    audio|video)
      echo "<status>"
  	  
  	  meta_server_status=
  	  meta_stream_status=
  	  meta_stream_bitrate=
  	  meta_stream_title=
  	  meta_stream_genre=
  	  meta_content_type=
  	  meta_listeners=
  	  meta_listener_peak=
  	  meta_average_listener_time=
  	  meta_current_song=
  	  meta_stream_description=
  	  
  	  if [ -n "$stream_status_url" -a -f "$TMPFILE" ]; then
  
        if grep -q -s -i "charset=utf-8" ${TMPFILE}; then
          :
        else
          $TOUTF8 <${TMPFILE} >${TMPFILE}.utf8 && mv -f ${TMPFILE}.utf8 ${TMPFILE}
        fi
        
        case $server_type in
          shoutcast)
        	  meta_server_status=`get_shoutcast_item 'Server Status'`
        	  meta_stream_status=`get_shoutcast_item 'Stream Status'`
        	  meta_stream_bitrate=`echo "$value" | sed 's/.*is up at //' | awk '{print $1}'`
        	  meta_stream_title=`get_shoutcast_item 'Stream Title'`
        	  meta_stream_genre=`get_shoutcast_item 'Stream Genre'`
        	  meta_content_type=`get_shoutcast_item 'Content Type'`
        	  meta_listeners=`echo "$value" | sed 's/.*with //' | awk '{print $1}'`
        	  meta_listener_peak=`get_shoutcast_item 'Listener Peak'`
        	  meta_average_listener_time=`get_shoutcast_item 'Average Listen Time'`
        	  meta_current_song=`get_shoutcast_item 'Current Song'`
        	  meta_stream_description=''
        	;;
          icecast)
        	  mount_point=`echo "$stream_url" | sed 's/\//\n/g' | sed -n '$p' | sed 's/ *$//'` 
        	  if grep -q -s "/${mount_point}" ${TMPFILE}; then
              sed -e 's/<[^<>]*>/\n/g' ${TMPFILE} | sed 's/^ *//' | sed '/^ *$/d' | sed 's/&amp;/&/g;s/&nbsp;/ /g;s/&lt;/</g;s/&gt;/>/g' | sed "1,/[Mm]ount [Pp]oint.*${mount_point}/d" | sed '/[mM]ount [pP]oint/,$d' | sed '/upport icecast development/,$d' > ${TMPFILE}.$$
        	    mv -f $TMPFILE.$$ $TMPFILE
          	  meta_server_status=''
          	  meta_stream_status=`get_icecast_item 'Mount started'`
          	  meta_stream_bitrate=`get_icecast_item 'Bitrate'`
          	  meta_stream_title=`get_icecast_item 'Stream Title'`
          	  meta_stream_genre=`get_icecast_item 'Stream Genre'`
          	  meta_content_type=`get_icecast_item 'Content Type'`
          	  meta_listeners=`get_icecast_item 'Current Listeners'`
          	  meta_listener_peak=`get_icecast_item 'Peak Listeners'`
          	  meta_average_listener_time=''
          	  meta_current_song=`get_icecast_item 'Current Song'`
          	  meta_stream_description=''
          	fi
          ;;
          station.ru)
            meta_current_song=`echo "$host_response" | awk '/"Artist"/{match($0, /"Artist":"([^"]+)".*"Song":"([^"]+)"/, arr);print arr[1] " - " arr[2];}'`
          ;;
        esac
      fi
  
  	  if echo "$stream_status_url" | grep -qsi "^icyx://"; then
  	    meta_current_song=`awk -v streamurl="$stream_url" -v statusurl="$stream_status_url" '
  	      BEGIN {
  	        match(statusurl, /^icyx:\/\/(.*):(.*)$/, arr);
  	        host_ip = arr[1];
  	        host_port = arr[2];
  	        match(streamurl, /^([^:]*):\/\/([^\/]*)(.*)$/, arr);
  	        host = arr[2];
  	        path = arr[3];
  
            if (path == "")  path = "/";
  
            HttpService = "/inet/tcp/0/" host_ip "/" host_port
            ORS = "\n\n"
            print "GET " path " HTTP/1.0" "\nHost: " host "\nAccept: */*" "\nIcy-MetaData: 1" |& HttpService
            ORS = "\n"
            RS = "\r?\n\r?\n"
            HttpService |& getline Header
            if(match(Header, /icy-metaint: *([0-9]*)/, arr))
            {
              metaint = strtonum(arr[1]);
              RS = "\0"
              counter = 0;
              while(counter < metaint)
              {
                HttpService |& getline
                counter = counter + length($0) + 1
              }
              if(metaint != counter + 1)
              {
                split($0, a, "\x27;"); 
                if(match(a[1], /^.*StreamTitle=\x27(.*)/, arr))
                {
                  print arr[1];
                }
              }
            }
            close(HttpService)
  	      }
  	    '`
  	    if echo "$meta_current_song" | $TOUTF8 -t; then
  		    meta_current_song=`echo "$meta_current_song" | $XCODE -s | $TOUTF8`
  	    fi
  	  fi
  
      case $protocol in
        http|rtmp)
          meta_stream_title=${meta_stream_title:-"$icy_name"}
          meta_stream_genre=${meta_stream_genre:-"$icy_genre"}
          meta_stream_bitrate=${meta_stream_bitrate:-"$icy_br"}
          meta_stream_description=${meta_stream_description:-"$icy_description"}
        ;;
        mmst|mmsh|rtsp)
          if [ -n "$ms_author" -a -n "$ms_title" ]; then
            if [ "$ms_author" != "$ms_title" ]; then
              meta_stream_title="$ms_title / $ms_author"
            else
              meta_stream_title="$ms_title"
            fi
          else
            meta_stream_title="$ms_title$ms_author"
          fi
        ;;
      esac
  
      if echo "$meta_stream_title" | $TOUTF8 -t; then
  	meta_stream_title=`echo "$meta_stream_title" | $XCODE -s | $TOUTF8`
      fi
      if echo "$meta_stream_genre" | $TOUTF8 -t; then
  	meta_stream_genre=`echo "$meta_stream_genre" | $XCODE -s | $TOUTF8`
      fi
      if echo "$meta_stream_description" | $TOUTF8 -t; then
  	meta_stream_description=`echo "$meta_stream_description" | $XCODE -s | $TOUTF8`
      fi
      
      	  print_status_item 'server-status' "${meta_server_status}"
  	  print_status_item 'stream-status' "$meta_stream_status"
  	  print_status_item 'listener-peak' "$meta_listener_peak"
  	  print_status_item 'average-listener-time' "$meta_average_listener_time"
  	  print_status_item 'stream-title' "$meta_stream_title"
  	  print_status_item 'content-type' "$meta_content_type"
  	  print_status_item 'stream-genre' "$meta_stream_genre"
  	  print_status_item 'current-song' "$meta_current_song"
  	  print_status_item 'stream-bitrate' "$meta_stream_bitrate"
  	  print_status_item 'stream-description' "$meta_stream_description"
  	  print_status_item 'listeners' "$meta_listeners"
      echo "</status>"
      rm -f ${TMPFILE}
    ;;
    playlist)
      if echo "$icy_name" | $TOUTF8 -t; then
  	    icy_name=`echo "$icy_name" | $XCODE -s | $TOUTF8`
      fi
      if [ -n "$icy_name" ]; then
        echo "<status>"
        print_status_item 'stream-title' "$icy_name"
        echo "</status>"
      fi
    ;;
  esac
  echo "</info>"
  return 0
}

command_scan()
{
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
  echo "<title>Playlists</title>"
  echo "<trackList>"
  
  if [ -f "${XSPFSCAN}" ]; then
    for path in `cat "${XSPFSCAN}"`
    do
      path=`echo "$path" | sed 's/\/*$//'`
      if [ -d "${path}" ]; then
        ls -1 ${path}/*.xspf ${path}/*.m3u ${path}/*.pls 2>/dev/null | awk '\
          {
            title=a[split($0, a, "/")];
            match($0, /.*\.([^.\/]+)$/, arr);
            ext = tolower(arr[1]);
            print "<track><title><![CDATA[" title "]]></title><location><![CDATA[" $0 "]]></location><meta rel=\"protocol\">file</meta><meta rel=\"ext\">" ext "</meta></track>";
          }
        '
      fi
    done
  fi
  
  echo "</trackList>"
  echo "</playlist>"
  
  return 0
}

command_ls()
{
  get_opt "Filter"
  filter=${opt:="$DEFAULTFILTER"}

  get_opt "Chroot"
  isroot=$opt
      
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
  echo "<title><![CDATA[${arg_url}]]></title>"
  echo "<trackList>"

  if [ -d "${arg_url}" ]; then
    /bin/ls -1l "${arg_url}" 2>/dev/null | awk -v path="${arg_url}" ' 
      function resolvesymlink(s, dirpath) { 
        match(s, /^[^ ]+ *([^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *.+ *-> *)(.+)$/, src);
        current = s;
        currentpath = dirpath;
        while(current ~ /^l/) {
          match(current, /^[^ ]+ *([^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *.+ *-> *)(.+)$/, arr);
          if(arr[2] !~ /^\// ) {
            match(currentpath, /(.*\/)[^\/]*\/*$/, dirarr);
            currentpath = dirarr[1] arr[2];
          }
          else {
            currentpath = arr[2];
          }
          lscmd = "ls -1ld " currentpath " 2>/dev/null";
          ERRNO = 0;
          lscmd |& getline current; 
          close(lscmd); 
          
          if(ERRNO != 0)
            return "";
        }
        match(current, /^([^ ]+ *)[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *(.+)$/, arr);
        return arr[1] src[1] currentpath; 
      } 
      $0 ~ /^l/ { 
        s = resolvesymlink($0, path); 
        if(s != "")
          print s;
      } 
      $0 ~ /^(d|-)/ { 
        print $0; 
      } 
    ' > $TMPFILE
    awk -v path="${arg_url}" -v isroot="$isroot" '
      BEGIN {
        if(path !~ /\/$/) {
          path = path "/";
        }
        if(isroot != "yes")
        {
          match(path, /(.*\/)[^\/]+\/$/, arr);
          location=arr[1];
          title="..";
          if(location != "") {
            print "<track><title><![CDATA[" title "]]></title><location><![CDATA[" location "]]></location>";
            print "<meta rel=\"class\">directory</meta><meta rel=\"protocol\">file</meta></track>";
          }
        }
      }
      $1 ~ /^d/ {
        match($0, /^[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *(.+)$/, arr);
        title=arr[1];
        if(title ~ /->/) {
          match(title, /^(.+) +-> +(.+)$/, arr);
          location=arr[2];
          title=arr[1];
        }
        else {
          location=path arr[1];
        }
        if(location !~ /\/$/) {
          location=location "/";
        }
        print "<track><title><![CDATA[/" title "/]]></title><location><![CDATA[" location "]]></location>";
        print "<meta rel=\"class\">directory</meta><meta rel=\"protocol\">file</meta></track>";
      }
    ' $TMPFILE
    awk -v path="${arg_url}" -v filter="$filter" '
      BEGIN {
        if(path !~ /\/$/) {
          path = path "/";
        }
      }
      $1 ~ /^-/ {
        match($0, /^[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *(.+)$/, arr);
        title=arr[1];
        if(title ~ /->/) {
          match(title, /^(.+) +-> +(.+)$/, arr);
          location=arr[2];
          title=arr[1];
        }
        else {
          location=path arr[1];
        }
        match(location, /.*\.([^.\/]+)$/, arr);
        ext = tolower(arr[1]);
        if(ext ~ filter) {
          match(location, /^(.+):\/\//, arr);
          protocol = tolower(arr[1]);
          if(protocol == "")
            protocol = "file";
          print "<track><title><![CDATA[" title "]]></title>";
          print "<location><![CDATA[" location "]]></location>";
          print "<meta rel=\"ext\">" ext "</meta><meta rel=\"protocol\">" protocol "</meta></track>";
        }
      }
    ' $TMPFILE
    rm -f $TMPFILE
  fi
  
  echo "</trackList>"
  echo "</playlist>"
  
  return 0
}

command_lsftp()
{
  get_opt "Charset"
  charset=$opt
  get_opt "Filter"
  filter=${opt:="$DEFAULTFILTER"}

  get_opt "Chroot"
  isroot=$opt
  
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>"
  echo "<title><![CDATA[${arg_url}]]></title>"
  echo "<trackList>"

  $MSDL --ftp-list -q -o $TMPFILE "${arg_url}" 2>/dev/null 
  if [ -f $TMPFILE ]; then
    ICONV=
    [ "$charset" == "CP1251" ] && ICONV=$TOUTF8
    awk -v path="${arg_url}" -v toutf8="$ICONV" -v charset="$charset" -v isroot="$isroot" '
      function iconv(s) {
        if(toutf8 == "") return s;
        print s |& toutf8;
        close(toutf8, "to");
        toutf8 |& getline line;
        close(toutf8);
        return line;
      }
      BEGIN {
        if(path !~ /\/$/) {
          path = path "/";
        }
        if(isroot != "yes")
        {
          match(path, /^(ftp:\/\/.+\/)[^\/]+\/$/, arr);
          location=arr[1];
          title="..";
          if(location != null) {
            print "<track><title><![CDATA[" title "]]></title><location><![CDATA[" location "]]></location>";
            if(charset != "")
              print "<meta rel=\"translate\">Charset:" charset "</meta>";
            print "<meta rel=\"class\">directory</meta><meta rel=\"protocol\">ftp</meta></track>";
          }
        }
      }
      $1 ~ /^d/ {
        match($0, /^[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *(.+)[\n\r]+$/, arr);
        location=path arr[1] "/";
        title=arr[1];
        print "<track><title><![CDATA[/" iconv(title) "/]]></title><location><![CDATA[" location "]]></location>";
        if(charset != "")
          print "<meta rel=\"translate\">Charset:" charset "</meta>";
        print "<meta rel=\"class\">directory</meta><meta rel=\"protocol\">ftp</meta></track>";
      }
    ' $TMPFILE
    awk -v path="${arg_url}" -v toutf8="$ICONV" -v filter="$filter" '
      function iconv(s) {
        if(toutf8 == "") return s;
        print s |& toutf8;
        close(toutf8, "to");
        toutf8 |& getline line;
        close(toutf8);
        return line;
      }
      BEGIN {
        if(path !~ /\/$/) {
          path = path "/";
        }
      }
      $1 ~ /^-/ {
        match($0, /^[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *[^ ]+ *(.+)[\n\r]+$/, arr);
        title=arr[1];
        location=path title;
        match(location, /.*\.([^.\/]+)$/, arr);
        ext = tolower(arr[1]);
        if(ext ~ filter)
        {
          match(location, /^(.+):\/\//, arr);
          protocol = tolower(arr[1]);
          if(protocol == "")
            protocol = "file";
          print "<track><title><![CDATA[" iconv(title) "]]></title>";
          print "<location><![CDATA[" location "]]></location>";
          print "<meta rel=\"ext\">" ext "</meta><meta rel=\"protocol\">" protocol "</meta></track>";
        }
      }
    ' $TMPFILE
    rm -f $TMPFILE
  fi
  
  echo "</trackList>"
  echo "</playlist>"
  
  return 0
}

command_random()
{
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo "<randomList>"
  awk -v count=${arg_opt} -v start=${arg_url} '
    BEGIN {
      srand();
      r=start;
      seq[r]=0;
      print "<item>" r "</item>";
      for(i=1;i<count;i++) {
        do {
          r=int(count*rand());
        } while(r in seq);
        seq[r]=i;
        print "<item>" r "</item>";
      }
      exit;
    }
  '
  echo "</randomList>"
  
  return 0
}

check_server()
{
  
  if echo "$stream_status_url" | grep -q -s -i "^icyx://"; then
    stream_class='audio';
    server_type='x-cast';
  else
    host_response=`$MSDL -q -o ${TMPFILE} -p http --useragent "${USERAGENT}" --stream-timeout 30 "$stream_status_url" 2>&1`
    if [ -f ${TMPFILE} ]; then
      stream_class='audio';
      if grep -q -s -i "[^a-z]icecast[^a-z]" ${TMPFILE}; then
        server_type='icecast'
        host_response=`cat ${TMPFILE}`
      elif grep -q -s -i "[^a-z]shoutcast[^a-z]" ${TMPFILE}; then
        server_type='shoutcast'
        host_response=`cat ${TMPFILE}`
      elif echo "$stream_status_url" | grep -q -s -i "[^a-z]station.ru[^a-z]"; then
        server_type='station.ru'
        host_response=`cat ${TMPFILE}`
      fi
    fi
  fi
}

command_translit()
{
  echo "Content-type: text/xml"
  echo
  echo "<?xml version='1.0' encoding='UTF-8'?>"
  echo -n "<string><![CDATA["
  from_translit "$arg_url"
  echo "]]></string>"
  
  return 0
}

case ${arg_cmd} in
  text)
    command_text
  ;;
  info)
    command_info
  ;;
  stream|audio|video|image)
    get_opt "Protocol"
    case $opt in
      mms|mmst|mmsh|http|rtsp|ftp)
        msdlopt='-p $opt'
      ;;
      *)
        msdlopt=''
    esac

    get_opt "Bandwidth"
    [ -z "$opt" -a -n "$NET_BANDWIDTH" ] && opt=$NET_BANDWIDTH
    [ -n "$opt" ] && msdlopt="$msdlopt -b $opt"

    get_opt "Speed"
    [ -n "$opt" ] && msdlopt="$msdlopt -s $opt"

    get_opt "User-agent"
    [ -n "$opt" ] && msdlopt="$msdlopt --useragent \"$opt\""
    
    get_opt "Charset"
    charset=$opt

    if [ -z "$stream_type" ]; then
    	local TIMELIFE=${STREAM_INFO_TIMELIFE:-60}
		  local CACHEFILE=$CACHEPATH/stream.`echo $arg_url | sed 's/[^0-9a-zA-Z]/_/g'`
		  local tsttime
		  let tsttime=`date +%s`-$TIMELIFE
		  if [ -f $CACHEFILE ]; then
		    if [ `date +%s -r $CACHEFILE` -gt $tsttime ]; then
		      stream_url=`sed -ne "1p" $CACHEFILE`
		      stream_type=`sed -ne "2p" $CACHEFILE`
		      arg_opt=`sed -ne "3p" $CACHEFILE`
		    fi
		  fi
		  if [ -z "$stream_type" ]; then
		  	check_stream
        echo $stream_url > $CACHEFILE
        echo $stream_type >> $CACHEFILE
        echo $arg_opt >> $CACHEFILE
		  fi
    fi
    
    echo "Content-type: $stream_type"
    echo
    if echo "$stream_url" | grep -qs "^rtmp"; then
      get_opt "Rtmp-options"
      killall -q $RTMPDUMP 2>&1
      exec nice /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -o - -b 60000 -r "$stream_url" $opt
    elif [ "$charset" == "CP1251" ]; then
      $MSDL $msdlopt -q -o - "$stream_url" | $TOUTF8 | sed 's/windows-125./utf-8/'
    else
      exec $MSDL $msdlopt -q -o - "$stream_url"
    fi
  ;;
  random)
    command_random
  ;;
  status)
    stream_url=$arg_url
    stream_status_url=$arg_opt
    command_info
  ;;
  flac)
    get_opt "Flac-skip"
    flac_skip=$opt
    get_opt "Flac-until"
    flac_until=$opt
    
    echo "Content-type: audio/wav"
    echo
    exec $FLAC -d -c --skip="$flac_skip" --until="$flac_until" --totally-silent "$stream_url"
  ;;
  directory)
    if echo "${arg_url}" | grep -q -s "^ftp:\/\/.*\/$"; then 
      command_lsftp
    elif echo "${arg_url}" | grep -q -s "^/.*/$"; then 
      command_ls
    fi
  ;;
  translit)
    command_translit
  ;;
  playlist|startpoint)
    if [ "$arg_cmd" == "startpoint" ]; then
      arg_url="$STARTPOINT"
    fi
    if echo "${arg_url}" | grep -q -s "^ftp:\/\/.*\/$"; then 
      command_lsftp
    elif echo "${arg_url}" | grep -q -s "^/.*/$"; then 
      command_ls
    elif [ -z "${arg_url}" ]; then
      command_scan
    else
      command_playlist
    fi
  ;;
  renderer)
    echo "$arg_url"  > "/tmp/xspf_renderer.dat"
    echo "$arg_opt" >> "/tmp/xspf_renderer.dat"
    echo "Content-type: text/plain"
    echo
  ;;
  renderer-*)
    echo "{${arg_cmd}}" > "/tmp/xspf_renderer.dat"
    echo "Content-type: text/plain"
    echo
  ;;
  download)
    echo "Content-type: text/xml"
    echo
    echo "<success/>"
    exec $MSDL -q -o "$arg_opt" "$stream_url"
  ;;
  app)
    if [ -f $TRANSLATE/app/$arg_url ]; then
        . $TRANSLATE/app/$arg_url
    fi
  ;;
  app/*)
    if [ -f $TRANSLATE/$arg_cmd ]; then
        . $TRANSLATE/$arg_cmd
    fi
  ;;
  scan|*)
    command_scan
  ;;
esac
