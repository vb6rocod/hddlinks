#!/bin/sh
killall wget
rm /tmp/*.pid
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
rm $loclog/log/*.log
