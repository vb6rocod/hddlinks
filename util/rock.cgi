#!/bin/sh
y=`echo "$QUERY_STRING"`
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 60000 -r rtmp://93.114.43.3:1935/vod/ -a vod -y "mp4:$y"
