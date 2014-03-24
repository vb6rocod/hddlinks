#!/bin/sh
link=`echo "$QUERY_STRING" | sed -n 's/^.*link=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
referer=`echo "$QUERY_STRING" | sed -n 's/^.*referer=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
cookie=`echo "$QUERY_STRING" | sed -n 's/^.*cookie=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/wget -q --referer "$referer" "$link" -O -
