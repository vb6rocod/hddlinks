#!/bin/sh
ID=`echo "$QUERY_STRING" | sed -n 's/^.*id=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
TOKEN=`echo "$QUERY_STRING" | sed -n 's/^.*token=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/translate/bin/msdl -q -o - "http://content.peteava.ro/video/$ID?start=0&token=$TOKEN"
