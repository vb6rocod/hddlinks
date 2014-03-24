#!/bin/sh
cat <<EOF
Content-type: video/flv

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -b 60000 -v -W http://static1.mediadirect.ro/player-preload/swf/preloader/preloader.swf -r `echo $QUERY_STRING|sed "s_\&amp;_\&_g"`
