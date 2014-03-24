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

#
# Translate CGI module
# 'vimeo.com' plug-in
#
# version: 2.0 26.12.2010 0:08
#
# http://vimeo.com/13768695
# http://vimeo.com/moogaloop.swf?clip_id=13199616
#
# options:
#   HD:[0|1]

TRANSLATE=${TRANSLATE:-/usr/local/etc/translate}

. $TRANSLATE/lib/common

CACHEPATH=${CACHEPATH:-/tmp}
TEMP=${TEMP:-/tmp}

USERAGENT="Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13"

TMPFILE=$TEMP/$$.tmp

[ ! -d $CACHEPATH ] && CACHEPATH=$TEMP

arg_cmd=`echo "$QUERY_STRING" | awk -F, '{print $1}'`
arg_opt=`echo "$QUERY_STRING" | awk -F, '{print $2}'`
arg_url=`echo "$QUERY_STRING" | awk -F, '{for(i=3; i<NF; i++) printf "%s,", $(i); printf "%s", $(NF); }'`

arg_url=`urldecode_s "$arg_url"`
arg_opt=`urldecode_s "$arg_opt"`

if echo "${arg_url}" | grep -q -s '\(www\.\)*vimeo\.com.*/\(moogaloop.swf?clip_id=\)*[0-9][0-9]*$'; then 

  hdc=1
  
  local video_id=`echo "$arg_url" | sed -e 's/.*\///;s/&.*//;s/.*=//'`
  
  local CACHEFILE=$CACHEPATH/vm.$video_id
  local tsttime=
  
  
  local sig_param=
  local time_param=
  local hd_param=
  local player_url=
  
  USERAGENT="Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13"
  
  if [ -z "$sig_param" ]; then   
      host_response=`$MSDL -q -o ${TMPFILE} -p http --useragent "${USERAGENT}" "http://player.vimeo.com/config/$video_id?type=moogaloop&referrer=vimeo.com&cdn_server=a.vimeocdn.com&player_server=player.vimeo.com&clip_id=$video_id" 2>&1`
      if [ -f ${TMPFILE} ]; then
        sig_param=`sed 's/.*,"signature":"//;s/",.*//' ${TMPFILE}`
        time_param=`sed 's/.*,"timestamp"://;s/,.*//' ${TMPFILE}`
        player_url=`sed 's/.*,"player_url":"//;s/",.*//' ${TMPFILE}`
        hd_param=`sed 's/.*,"hd"://;s/,.*//' ${TMPFILE}`
        icy_name=`$MSDL -q -o - -p http --useragent "${USERAGENT}" http://vimeo.com/$video_id | grep '<div class="title">' | sed 's/.*class=[^>]*>//;s/<\/.*//g'`
        icy_name=`unescapeXML "$icy_name"`
        
        echo $sig_param > $CACHEFILE
        echo $time_param >> $CACHEFILE
        echo $player_url >> $CACHEFILE
        echo $hd_param >> $CACHEFILE
        echo $icy_name >> $CACHEFILE
        rm -f $TMPFILE
      fi
  fi
  
  if [ -n "$sig_param" ]; then
    local quality="sd"
    [ -n "$hdc" -a "$hd_param" = "1" ] && quality="hd"
    server_type='vimeo'
    protocol='http'
    #$MSDL -q -o /dev/null -p http --useragent "${USERAGENT}" "http://t.vimeo.com/nocache/i.gif?a=load&t=moogaloop&vid=${video_id}&q=${quality}" 2>&1
    #$MSDL -q -o /dev/null -p http --useragent "${USERAGENT}" "http://t.vimeo.com/nocache/i.gif?a=play&t=moogaloop&vid=${video_id}&q=${quality}" 2>&1
    stream_url="http://${player_url}/play_redirect?clip_id=${video_id}&sig=${sig_param}&time=${time_param}&quality=${quality}&codecs=H264,VP8,VP6&type=moogaloop&embed_location=http://creativemonkeyz.com"
    $MSDL --debug -o /dev/null --stream-timeout 1 -p http --useragent "${USERAGENT}" "$stream_url" 2>${TMPFILE}.log
    stream_type=`sed -n '/^[Cc]ontent\-[Tt]ype:/p' ${TMPFILE}.log | sed -n '$p' | awk '{gsub(/\r/,""); print $2}' | sed 's/[,;]$//'`
    local redirect=`sed -n '/^redirect to/p' ${TMPFILE}.log | sed -n '$p' | awk '{print $3}'`
    [ -n "$redirect" ] && stream_url="$redirect"
    rm -f ${TMPFILE}.log
  fi
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/wget --limit-rate=500K -q -O -  "$stream_url"
fi

return $RC_FAIL
