#!/bin/sh
DISK=`echo "$QUERY_STRING" | sed -n 's/^.*sda=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
LINK=`echo "$QUERY_STRING" | sed -n 's/^.*link=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
NAME=`echo "$QUERY_STRING" | sed -n 's/^.*name=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
if [ -n "$DISK"]
then
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
elif [ -d /tmp/hdd/volumes/HDD1 ]
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
mkdir $loc
cd $loc
mkdir $loclog/log 
/usr/local/etc/www/cgi-bin/scripts/wget --progress=dot:mega -k -bc -a $loclog/log/$NAME.log -O $NAME "$LINK" > /tmp/$NAME.pid
else 
cd /tmp/usbmounts/sda$DISK
 wget -bq -O $NAME $LINK 
fi
