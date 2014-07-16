#!/bin/sh
PLAYER=`echo "$QUERY_STRING" | sed -n 's/^.*player=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
SERVER=`echo "$QUERY_STRING" | sed -n 's/^.*server=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`
NAME=`echo "$QUERY_STRING" | sed -n 's/^.*name=\([^;]*\).*$/\1/p' | sed "s/%20/ /g"`

echo -e running >/tmp/hdforall.dat
rm -f /tmp/scripts.zip
if [ $NAME = "uploadc" ]
then
  /opt/bin/curl -s $SERVER --referer "http://www.uploadc.com" -o /tmp/scripts.zip
else
  wget -q $SERVER -O /tmp/scripts.zip
fi
touch /tmp/scripts.zip
if [ -s /tmp/scripts.zip ]
then
if [ $PLAYER = "0" ]
then
    if [ -f /usr/local/etc/scripts/mini1.php ]
    then
    if [ -f /data/scripts/mini1.php ]
    then
     storage=/data
    elif [ -f /tmp/hdd/root/scripts/mini1.php ]
    then
     storage=/tmp/hdd/root
    elif [ -f /tmp/hdd/volumes/HDD1/scripts/mini1.php ]
    then
     storage=/tmp/hdd/volumes/HDD1
    elif [ -f /tmp/ramfs/volumes/C:/scripts/mini1.php ]
    then
     storage=/tmp/ramfs/volumes/C:
    elif [ -f /tmp/ramfs/volumes/D:/scripts/mini1.php ]
    then
     storage=/tmp/ramfs/volumes/D:
    else
     storage=/usr/local/etc
    fi
    #remove scripts
   rm -rf $storage/scripts
   unzip -q -o /tmp/scripts.zip -d $storage
   cd $storage/scripts
   for i in $( find -name '*.php' )
    do
     chmod +x $i
   done
   for i in $( find -name '*.cgi' )
     do
      chmod +x $i
   done
   cd $storage/scripts
     chmod +x *

     sync
     sync
     sync
   fi
fi
#Kingul mod HD4ALL -22.02.2014
if [ $PLAYER = "100" ]
then
storage=/usr/local/etc/www/cgi-bin
if [ -f $storage/scripts/mini1.php ]
then
   mount -o remount,rw /
   #remove scripts
   #rm -rf $storage/scripts
   unzip -q -o /tmp/scripts.zip -d $storage
   cd $storage/scripts
   for i in $( find -name '*.php' )
   do
  chmod +x $i
   done
   for i in $( find -name '*.cgi' )
   do
  chmod +x $i
   done
   cd $storage/scripts
   chmod +x *
   sync
   sync
   sync
    #SDK4
  if [ -f /usr/local/etc/www/cgi-bin/videoRenderer.rss ]; then
  cp -f /usr/local/etc/www/cgi-bin/scripts/filme/videoRenderer.rss /usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss
  cp -f /usr/local/etc/www/cgi-bin/scripts/filme/videoRenderer_h.rss /usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_h.rss
  fi
#oneHD DMD fix
  if [ -e /usr/local/etc/www/cgi-bin/onehd.cgi ]
  then
  cp ./util/oneHD.cgi /usr/local/etc/www/cgi-bin/onehd.cgi
  fi
#HDD  Links
sed -i 's/image\/youtube.gif/\/usr\/local\/etc\/translate\/rss\/image\/YouTubeLogo.jpg/g' ./clip/*.php
fi
mount -o,remount,r /
fi

#CS mod HD4ALL - 07.07.2014
if [ $PLAYER = "10" ]
then
	if [ -f /usr/local/bin/Resource/www/cgi-bin/scripts/mini1.php ]
    then
    if [ -f /usr/local/etc/IMS_Modules/Scripts/mini1.php ]
    then
     storage=/usr/local/etc/IMS_Modules
    else
     storage=/usr/local/bin/IMS_Modules
    fi
    #remove scripts
   #rm -rf $storage/scripts

	MNT=`mount | grep '/dev/root' | cut -d' ' -f6 | cut -c 2-3`
	 if [ "$MNT" != "rw" ] 
	 then
		mount -o,remount,rw /
	fi

   interface=`cat /usr/local/etc/dvdplayer/interface`
   
   cd $storage
   tar cf /usr/local/etc/dvdplayer/hdforall.dat Scripts/
   mv -f Scripts/util/ .
   rm -rf $storage/Scripts
   mkdir -p $storage/Scripts
   mv -f util Scripts/util
   ln -s $storage/Scripts $storage/scripts
   unzip -q -o /tmp/scripts.zip -d $storage
   rm $storage/scripts

   cd $storage/Scripts
   for i in $( find -name '*.php' )
    do
     chmod +x $i

	#HDD  Links
	#sed -i 's/image\/mele\/rss_title.jpg/image\/mele\/rss_title.png/g' $i
	#sed -i 's/-b 60000/-b 10000/g' $i
	sed -i 's/cgi-bin\/translate/cgi-bin\/scripts\/util\/translate.cgi/g' $i

	#HiMedia fix
	if [ $interface = "HiMedia" ]; then
		sed -i s/'userInput == "one" || userInput == "1"'/'userInput == "one" || userInput == "1" || userInput == "option_red"'/g $i
		sed -i s/'userInput == "two" || userInput == "2"'/'userInput == "two" || userInput == "2" || userInput == "option_green"'/g $i
		sed -i s/'userInput == "three" || userInput == "3"'/'userInput == "three" || userInput == "3" || userInput == "option_yellow"'/g $i
		sed -i s/'userInput == "four" || userInput == "4"'/'userInput == "four" || userInput == "4" || userInput == "option_blue"'/g $i
	fi

	#xTreamer fix
	if [ $interface = "xTreamer" ]; then
		sed -i 's/127.0.0.1\/cgi-bin/127.0.0.1:1024\/cgi-bin/g' $i
		sed -i 's/localhost\/cgi-bin/127.0.0.1:1024\/cgi-bin/g' $i
		sed -i s/'"enter")'/'"enter" || userInput == "ENTR")'/g $i
		sed -i s/'"pageup")'/'"pageup" || userInput == "PG")'/g $i
		sed -i s/'"pagedown")'/'"pagedown" || userInput == "PD")'/g $i
		sed -i s/'userInput == "pagedown" || userInput == "pageup"'/'userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG"'/g $i
		sed -i s/'userInput == "right"'/'userInput == "right"" || userInput == "R"'/g $i
		sed -i s/'userInput == "left"'/'userInput == "left"" || userInput == "L"'/g $i
	fi

   done
   for i in $( find -name '*.rss' )
    do
     chmod +x $i

	#HDD  Links
	#sed -i 's/image\/mele\/rss_title.jpg/image\/mele\/rss_title.png/g' $i
	#sed -i 's/-b 60000/-b 10000/g' $i
	
	#HiMedia fix
	if [ `cat /usr/local/etc/dvdplayer/interface` = "HiMedia" ]; then
		sed -i s/'userInput == "one" || userInput == "1"'/'userInput == "one" || userInput == "1" || userInput == "option_red"'/g $i
		sed -i s/'userInput == "two" || userInput == "2"'/'userInput == "two" || userInput == "2" || userInput == "option_green"'/g $i
		sed -i s/'userInput == "three" || userInput == "3"'/'userInput == "three" || userInput == "3" || userInput == "option_yellow"'/g $i
		sed -i s/'userInput == "four" || userInput == "4"'/'userInput == "four" || userInput == "4" || userInput == "option_blue"'/g $i
	fi

	#xTreamer fix
	if [ `cat /usr/local/etc/dvdplayer/interface` = "xTreamer" ]; then
		sed -i 's/127.0.0.1\/cgi-bin/127.0.0.1:1024\/cgi-bin/g' $i
		sed -i 's/localhost\/cgi-bin/127.0.0.1:1024\/cgi-bin/g' $i
		sed -i s/'"enter")'/'"enter" || userInput == "ENTR")'/g $i
		sed -i s/'"pageup")'/'"pageup" || userInput == "PG")'/g $i
		sed -i s/'"pagedown")'/'"pagedown" || userInput == "PD")'/g $i
		sed -i s/'userInput == "pagedown" || userInput == "pageup"'/'userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG"'/g $i
		sed -i s/'userInput == "right"'/'userInput == "right"" || userInput == "R"'/g $i
		sed -i s/'userInput == "left"'/'userInput == "left"" || userInput == "L"'/g $i
	fi

   done
   for i in $( find -name '*.cgi' )
     do
      chmod +x $i
   done
   cd $storage/Scripts
     chmod +x *

	#oneHD DMD fix
	 if [ -e ../../DMD/www/cgi-bin/onehd.cgi ]
	 then
		cp ./util/oneHD.cgi ../../DMD/www/cgi-bin/onehd.cgi
	 fi

	#SDK4
	 if [ -d /usr/local/bin/home_menu ]; then
		cp  -af /local/usr/etc/translate/rss/xspf/videoRenderer.rss /usr/local/bin/IMS_Modules/Scripts/util/videoRenderer.rss
		sed -i 's/-b 60000/-b 10000/g' ./util/*.cgi
		sed -i 's/b 10000\/-b 10000/b 60000\/-b 10000/g' ./util/hdforall.cgi
	 fi

	#HDD  Links
     sed -i 's/youtube.gif/YouTubeLogo.jpg/g' ./clip/*.php

	 if [ -e ./news ]
	 then
		sed -i 's/image\/mele\/weather.png/.\/IMS_Modules\/Weather\/image\/weather.jpg/g' ./news/news.php
	 fi
	 
     sync
     sync
     sync

   fi
fi
fi

rm -f /tmp/scripts.zip
rm -f /tmp/hdforall.dat
