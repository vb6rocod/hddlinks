#!/bin/sh
cd /tmp/cached
wget -q -nc  http://livehd.tv/live.php >/dev/null
wget -q -nc  http://www.livehd.tv/rtmp/flash-mbr.php
token=`cat live.php | grep token | sed "s/\(.*\)token':'//;s/',\(.*\)//"`
if [ -z "$token"  ]; then token=6c69766568642e747620657374652063656c206d616920746172652121; fi
ip=`cat flash-mbr.php | grep rtmp | sed "s_/live\(.*\)__;s_\(.*\)rtmp://__;s_:1935__"`
if [ -z "$ip"  ]; then ip=91.213.34.18; fi
streamer=`cat flash-mbr.php | grep rtmp | sed "s_</jwplayer:streamer\(.*\)__;s_\(.*\)jwplayer:streamer>__"`
chanel=`echo $QUERY_STRING|sed "s_\(.*\)live/__g;s_\&amp;_\&_g;s/+//g"`
if [ -z "$streamer"  ]; then streamer=`echo $QUERY_STRING|sed "s_\&amp;_\&_g;s/+//g;s/93.114.43.3/$ip/g;s:/$chanel::"`; fi
if [ `echo $chanel | grep sd -c` = 0  ]; then
	if [ `echo $chanel | grep hd -c` = 0  ]; then chanel=`echo $chanel+hd|sed "s/+//g"`; fi
fi
rm live.php >/dev/null
rm flash-mbr.php >/dev/null

cat <<EOF
Content-type: video/flv

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 60000 -l 2 -y $chanel -T $token -W http://www.livehd.tv/player/player.swf -p http://www.livehd.tv/ -r `echo $streamer`
