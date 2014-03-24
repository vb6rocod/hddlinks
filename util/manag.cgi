#!/bin/sh
link=`echo "$QUERY_STRING" | sed -n 's/^.*link=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
PID=`echo "$QUERY_STRING" | sed -n 's/^.*pid=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
NAME=`echo "$QUERY_STRING" | sed -n 's/^.*name=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
GO=`echo "$QUERY_STRING" | sed -n 's/^.*go=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
if [ -d /tmp/usbmounts/sda1/download ]
then
	loc=/tmp/usbmounts/sda1/download
	loclog=/tmp/usbmounts/sda1/download
elif [ -d /tmp/usbmounts/sdb1/download ]
then
	loc=/tmp/usbmounts/sdb1/download
	loclog=/tmp/usbmounts/sdb1/download
elif [ -d /tmp/usbmounts/sdc1/download ]
then
	loc=/tmp/usbmounts/sdc1/download
	loclog=/tmp/usbmounts/sdc1/download
elif [ -d /tmp/usbmounts/sda2/download ]
then
	loc=/tmp/usbmounts/sda2/download
	loclog=/tmp/usbmounts/sda2/download
elif [ -d /tmp/usbmounts/sdb2/download ]
then
	loc=/tmp/usbmounts/sdb2/download
	loclog=/tmp/usbmounts/sdb2/download
elif [ -d /tmp/usbmounts/sdc2/download ]
then
	loc=/tmp/usbmounts/sdc2/download
	loclog=/tmp/usbmounts/sdc2/download
elif [ -d /tmp/hdd/volumes/HDD1/download ]
then
	loc=/tmp/hdd/volumes/HDD1/download
	if [ -d /tmp/hdd/root ]
	then
	  loclog=/tmp/hdd/root
    else
      loclog=/tmp/hdd/volumes/HDD1/download
    fi
else
	loc=''
	loclog=''
fi
case $GO in
		"start" ) 
		cd $loc
		/usr/local/etc/www/cgi-bin/scripts/wget -bc -a $loclog/log/$NAME.log -O $NAME $LINK > /tmp/$NAME.pid
		echo  "Start Download $NAME";;
		"stop" )
		kill -9 $PID
		rm /tmp/$NAME.pid
		echo  "Stop Download $NAME";;
		"delete" )
		kill -9 $PID
		rm /tmp/$NAME.pid
		rm $loclog/log/$NAME.log
		echo  "Sterge Download $NAME";;
esac
