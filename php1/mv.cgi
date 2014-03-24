#!/bin/sh

cat <<EOF
Content-type: video/flv

EOF
exec /sbin/wget -O - --post-data `echo $QUERY_STRING|sed "s_\&amp;_\&_g"` "http://213.152.174.187/mvmu.php"
