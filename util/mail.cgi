#!/bin/sh
y=`echo "$QUERY_STRING"`
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl -s -b "/tmp/serialepenet.txt" --referer "http://serialepenet.ro/476-embed-236/player/player.swf" "$y"
