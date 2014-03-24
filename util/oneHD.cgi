#!/bin/sh
cd /tmp/cached
wget -q   http://livehd.tv/live.php >/dev/null
wget -q   http://www.livehd.tv/rtmp/flash-mbr.php
token=`cat live.php | grep token | sed "s/\(.*\)token':'//;s/',\(.*\)//"`
if [ -z "$token"  ]; then token=6c69766568642e747620657374652063656c206d616920746172652121; fi
ip=`cat flash-mbr.php | grep rtmp | sed "s_/live\(.*\)__;s_\(.*\)rtmp://__;s_:1935__"`
if [ -z "$ip"  ]; then ip=91.201.78.3; fi
streamer=`cat flash-mbr.php | grep rtmp | sed "s_</jwplayer:streamer\(.*\)__;s_\(.*\)jwplayer:streamer>__"`
channel=`echo $QUERY_STRING|sed "s_\(.*\)live/__g;s_\&amp;_\&_g;s/+//g"`
if [ -z "$streamer"  ]; then streamer=`echo $QUERY_STRING|sed "s_\&amp;_\&_g;s/+//g;s/93.114.43.3/$ip/g;s:/$channel::"`; fi
if [ `echo $channel | grep sd -c` = 0  ]; then
	if [ `echo $channel | grep hd -c` = 0  ]; then channel=`echo $channel+hd|sed "s/+//g"`; fi
fi
if [ "$channel" = "onehd"  ]; then channel=${channel}hd; fi

rm live.php >/dev/null
rm flash-mbr.php >/dev/null

cat <<EOF
Content-type: video/flv

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 1000 -l 2 -y `echo -e $channel` -T $token -W http://www.livehd.tv/player/player.swf -p http://www.livehd.tv/ -r `echo -e $streamer`
