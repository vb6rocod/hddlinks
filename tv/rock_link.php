#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$y = $_GET["file"];
$y=urldecode($y);
$y="mp4:".base64_decode($y);
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/";
   $dir_log = "/tmp/usbmounts/sda1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/";
   $dir_log = "/tmp/usbmounts/sdb1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/";
   $dir_log = "/tmp/usbmounts/sdc1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/";
   $dir_log = "/tmp/usbmounts/sda2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/";
   $dir_log = "/tmp/usbmounts/sdb2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc2/download/";
   $dir = "/tmp/usbmounts/sdc2/download/log/";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/";
   $dir_log = "/tmp/hdd/root/log/";
} else {
     $dir = "";
     $dir_log = "";
}
$link_buf="/usr/local/etc/dvdplayer/onehd.dat";
$buf=trim(file_get_contents($link_buf));
$t1=explode(":",$y);
$y=$t1[1];
$dl=$dir.$y;
$l="http://www.livehd.tv/live.php";
$h=file_get_contents($l);
$token=str_between($h,"token':'","'");
if ( $token == "" ); $token="6c69766568642e747620657374652063656c206d616920746172652121";
$l="http://www.livehd.tv/rtmp/flash-mbr.php";
$h=file_get_contents($l);
//streamer>rtmpe://91.213.34.18:1935/live<
$rtmp=str_between($h,"rtmpe:","/live");
$rtmp="rtmp:".$rtmp."/vod";
$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b '.$buf.' -l 2 -T '.$token.' -q -v -r "'.$rtmp.'" -a "vod" -y "mp4:'.$y.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/rock.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/rock.cgi");
$out='#!/bin/sh
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -q -v -b '.$buf.' -l 2 -T '.$token.' -q -v -r "'.$rtmp.'" -a "vod" -y "mp4:'.$y.'" -o "'.$dl.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/rock_d.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/rock_d.cgi");
sleep(1);
print $exec;
?>
