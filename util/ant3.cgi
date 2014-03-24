#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 60000 -W http://static.mediadirect.ro/streamrecord/new3/player.swf -r `echo $QUERY_STRING|sed "s_\&amp;_\&_g"`
