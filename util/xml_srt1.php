#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
error_reporting(0);
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
//topUrl = "http://127.0.0.1/cgi-bin/scripts/util/xml_srt1.php?file=" + getItemInfo(getFocusItemIndex(),"subtitrare") + "," + getItemInfo(getFocusItemIndex(),"name");
$link = $_GET["file"];
$t1=explode(",",$link);
$link = $t1[0];
$srt = $dir.$t1[1].".srt";
$out="";
$html = file_get_contents($link);
$videos = explode('<p', $html);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$t1=explode('begin="',$video);
$t2=explode('"',$t1[1]);
$start=$t2[0];
if (strlen($start)==5) {
$start="00:".$start.",000";
} else {
$start=$start.",000";
}
$t1=explode('end="',$video);
$t2=explode('"',$t1[1]);
$end=$t2[0];
if (strlen($end)==5) {
$end="00:".$end.",000";
} else {
$end=$end.",000";
}
$line=str_between($t1[1],">","</p");
$line=str_replace("<br/>","\r\n",$line);
$out = $out.$n."\r\n";
$out = $out.$start." --> ".$end."\r\n";
$out = $out.$line."\r\n";
$out = $out."\r\n";
$n++;
}
$out = preg_replace("/<(.*)>|(\{(.*)\})/e","",$out);
$rm = "rm -f ".$srt;
exec ($rm);
if ($n > 2) {
$fp = fopen($srt, 'w');
fwrite($fp, $out);
fclose($fp);
print "Subtitrare descarcata";
} else {
print "Descarcare subtitrare esuata";
}
?>
