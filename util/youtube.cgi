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
# 'youtube.com' plug-in
#
# version: 2.7 27.01.2012 23:40
#
# http://www.youtube.com/v/JZtcw6GIxTY
# http://www.youtube.com/watch?v=JZtcw6GIxTY
# http://www.youtube.com/movie?v=xO19ipsCxfI
# http://m.youtube.com/watch?gl=RU&client=mv-google&hl=ru&v=V-_YxX94cQ8
# http://www.youtube.com/embed/0v1ijbQocqo
#
# http://www.youtube.com/watch?v=v--IqqusnNQ&feature=list_related&playnext=1&list=AVGxdCwVVULXeKBZbzNyDrXn1k_UU4pSf9
#
# options:
#   HD:[0|1]

#unset RESOLVE_CACHE_ENABLED
TRANSLATE=${TRANSLATE:-/usr/local/etc/translate}

. $TRANSLATE/lib/common

CACHEPATH=${CACHEPATH:-/tmp}
TEMP=${TEMP:-/tmp}

USERAGENT="Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13"

TMPFILE=$TEMP/$$.tmp
AWK=awk
[ -x /usr/local/etc/translate/bin/awk ] && AWK=/usr/local/etc/translate/bin/awk
[ ! -d $CACHEPATH ] && CACHEPATH=$TEMP

arg_cmd=`echo "$QUERY_STRING" | awk -F, '{print $1}'`
arg_opt=`echo "$QUERY_STRING" | awk -F, '{print $2}'`
arg_url=`echo "$QUERY_STRING" | awk -F, '{for(i=3; i<NF; i++) printf "%s,", $(i); printf "%s", $(NF); }'`

arg_url=`urldecode_s "$arg_url"`
arg_opt=`urldecode_s "$arg_opt"`
if echo "${arg_url}" | grep -qs 'youtube\.com.*\(/embed/\|/v/\|/watch?\|movie?\).*$'; then

  hdc=1
  local video_id=`echo "$arg_url" | sed -e 's/.*[?&]v=//;s/.*\///;s/&.*//'`
  local CACHEFILE=$CACHEPATH/yt.$video_id
  local USERAGENTG="Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)"



  local tsttime=
  local fmt_url_map=


  if [ -z "$fmt_url_map" ]; then
      host_response=`$MSDL -q -o ${TMPFILE} -p http --useragent "${USERAGENTG}" http://www.youtube.com/watch?v=$video_id 2>&1`
      if [ -f ${TMPFILE} ]; then
        fmt_url_map=`grep -i 'url_encoded_fmt_stream_map=' ${TMPFILE} | sed -n '1p'`
        if [ -z "$fmt_url_map" ]; then
	        fmt_url_map=`grep -i 'fmt_url_map=' ${TMPFILE} | sed '1p'`
	        fmt_url_map=`echo "$fmt_url_map" | unidecode | unescapeXML | $AWK '{match($0, /&fmt_url_map=([^&]*)&/, arr);print arr[1];}' | urldecode`
	      else
        	fmt_url_map=`echo "$fmt_url_map" | unidecode | unescapeXML | $AWK '{match($0, /&url_encoded_fmt_stream_map=url%3D([^&]*)&/, arr);print arr[1];}' | urldecode | urldecode`
        fi
      fi
  fi

  if [ -n "$fmt_url_map" ]; then
    stream_type='video/mp4'
    stream_url=''
    server_type='youtube'
    protocol='http'
    if echo "$fmt_url_map" | grep -qs ",url="; then
    	#22 / HD720
    	[ -n "$hdc" ] && stream_url=`echo $fmt_url_map | awk 'BEGIN{RS=",url="} /itag=22/{print $0}' | sed 's/;.*//'`
    	#18 / MEDIUM (default)
    	[ -z "$stream_url" ] && stream_url=`echo $fmt_url_map | awk 'BEGIN{RS=",url="} /itag=18/{print $0}' | sed 's/;.*//'`
    else
    	#22 / HD720
    	[ -n "$hdc" ] && stream_url=`echo $fmt_url_map | awk '{match($0,/.*22\|([^,]+),?/,arr);print arr[1]}'`
    	#18 / MEDIUM (default)
    	[ -z "$stream_url" ] && stream_url=`echo $fmt_url_map | awk '{match($0,/.*18\|([^,]+),?/,arr);print arr[1]}'`
    fi
  fi
cat <<EOF
Content-type: video/mp4

EOF
exec wget -q -O -  "$stream_url"
fi
return $RC_FAIL
