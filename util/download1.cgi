#!/bin/sh
DISK=`echo "$QUERY_STRING" | sed -n 's/^.*sda=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
LINK=`echo "$QUERY_STRING" | sed -n 's/^.*link=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
NAME=`echo "$QUERY_STRING" | sed -n 's/^.*name=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
if [ -n "$DISK"]
then
if [ -d /tmp/usbmounts/sda1/download ]
then
	loc=/tmp/usbmounts/sda1/download/
	loclog=/tmp/usbmounts/sda1/download
elif [ -d /tmp/usbmounts/sdb1/download ]
then
	loc=/tmp/usbmounts/sdb1/download/
	loclog=/tmp/usbmounts/sdb1/download
elif [ -d /tmp/usbmounts/sdc1/download ]
then
	loc=/tmp/usbmounts/sdc1/download/
	loclog=/tmp/usbmounts/sdc1/download
elif [ -d /tmp/usbmounts/sda2/download ]
then
	loc=/tmp/usbmounts/sda2/download/
	loclog=/tmp/usbmounts/sda2/download
elif [ -d /tmp/usbmounts/sdb2/download ]
then
	loc=/tmp/usbmounts/sdb2/download/
	loclog=/tmp/usbmounts/sdb2/download
elif [ -d /tmp/usbmounts/sdc2/download ]
then
	loc=/tmp/usbmounts/sdc2/download/
	loclog=/tmp/usbmounts/sdc2/download
elif [ -d /tmp/hdd/volumes/HDD1 ]
then
	loc=/tmp/hdd/volumes/HDD1/download/
	loclog=/tmp/hdd/root
else
	loc=''
	loclog=''
fi
mkdir $loc
/usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b 60000 -r rtmpe://s1.ezflow.eu:1935/honeypot -a honeypot -W http://s1.ezflow.eu/embed/player.swf -p http://www.iplay.ro -y mp4:$LINK.mp4 -C O:1 -C O:0 -o $loc$NAME.mp4

fi
