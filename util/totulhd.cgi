#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl -s --insecure --cookie "/tmp/totulhd.txt" --referer "http://www.videoslasher.com/static/player/flowplayer.commercial-3.2.7.swf" "$QUERY_STRING"
