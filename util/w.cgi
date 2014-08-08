#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec wget -q "$QUERY_STRING" -O -
