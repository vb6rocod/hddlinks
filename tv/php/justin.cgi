#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump  -q -v -r "rtmp://stream.voyo.ro/rolinear_61241319" -W "http://voyo.ro/static/shared/app/flowplayer/13-flowplayer.cluster-3.2.1-01-004.swf"  -C O:1 -C NN:0:60564222.000000 -C NS:1:9a29fa785106a407304692a59529eb45 -C NN:2:6335.000000 -C NS:3:150ba64900e5c1ce12b8b4f2c9d3ae14 -C O:0 -y "linear3?eyJtZWQiOjYxMjQxMzE4LCJsaWMiOiI5YTI5ZmE3ODUxMDZhNDA3MzA0NjkyYTU5NTI5ZWI0NSIsInByb2QiOjYzMzUsImRldiI6IjE1MGJhNjQ5MDBlNWMxY2UxMmI4YjRmMmM5ZDNhZTE0IiwiYWlkIjoiIn0="