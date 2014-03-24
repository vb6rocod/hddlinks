#!/bin/sh
rtmp=`echo "$QUERY_STRING" | sed -n 's/^.*rtmp=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
w=`echo "$QUERY_STRING" | sed -n 's/^.*w=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
y=`echo "$QUERY_STRING" | sed -n 's/^.*y=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
token=`echo "$QUERY_STRING" | sed -n 's/^.*token=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 60000 -r rtmp://live.iguide.to/edge -W http://player.ilive.to/player_ilive_2.swf -p "http://ilive.to" -y "$y" -T "$token" -x "222634" -w "b8b2345b77014b0efd7316cb7d3376198bcbf4c358d28de1f3b14ee194bc5f1a"
