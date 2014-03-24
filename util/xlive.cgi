#!/bin/sh
# Dreambox Live

c_param1=`echo $QUERY_STRING | cut -d'&' -f1 | cut -d= -f1`
c_value1=`echo $QUERY_STRING | cut -d'&' -f1 | cut -d= -f2`

echo "Content-type: text/html"
echo
echo "<html><head>"
echo "<title>repoman xLive</title>"
echo "<link type='text/css' rel='stylesheet' href='/cube_web_management.css' />"
echo "</head>"
echo "<body>"
	echo "<h1>repoman xLive</h1><hr><br>"

if [ $c_value1 = "install" ]
then
	if [ -e /tmp/hdd/volumes/HDD1 ]
	then
		storage=/tmp/hdd/volumes/HDD1
		loc="HDD"
	elif [ -e /tmp/usbmounts/sda1 ]
	then
		storage=/tmp/usbmounts/sda1
		loc="USB1"
	elif [ -e /tmp/usbmounts/sdb1 ]
	then
		storage=/tmp/usbmounts/sdb1
		loc="USB1"
	elif [ -e /tmp/usbmounts/sdc1 ]
	then
		storage=/tmp/usbmounts/sdc1
		loc="USB1"
	elif [ -e /tmp/usbmounts/sda2 ]
	then
		storage=/tmp/usbmounts/sda2
		loc="USB2"
	elif [ -e /tmp/usbmounts/sdb2 ]
	then
		storage=/tmp/usbmounts/sdb2
		loc="USB2"
	elif [ -e /tmp/usbmounts/sdc2 ]
	then
		storage=/tmp/usbmounts/sdc2
		loc="USB2"
	elif [ -e /tmp/usbmounts/sda ]
	then
		storage=/tmp/usbmounts/sda
		loc="USB"
	elif [ -e /tmp/usbmounts/sdb ]
	then
		storage=/tmp/usbmounts/sdb
		loc="USB"
	fi
	if [ -e $storage ]
	then
		echo "<h2>Install repoman Xlive on " $storage "</h2><br>"
		rm -f $storage/xlive.zip
		cd $storage
		wget -q http://hdforall.googlecode.com/files/xlive.zip -O xlive.zip
		if [ -f $storage/xlive.zip ]
		then
			echo "download OK....<br>"
			#remove scripts
			rm -rf $storage/xLive/repoman/*
			echo "unzip.....<br>"
			unzip -q -o xlive.zip
			rm -f $storage/xlive.zip
	  	    cd /usr/local/etc
	  	    rm -f xLive
	  	    ln -s $storage/xLive xLive
			echo "<h3>Install OK! Enjoy</h3>"
		else
			echo "<h3>Can not install repoman xLive!<br>Check network.</h3>"
		fi
	fi
fi

############################################

############################################
echo "<br></body></html>"
