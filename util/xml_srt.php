#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
set_time_limit(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
clearstatcache();
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/*xml";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/*xml";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/*xml";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/*xml";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/*xml";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/*xml";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/*xml";
} else {
     $dir = "";
}
if ($dir <> "") {
$file_list = glob($dir);
for ($i=0; $i< count($file_list); $i++) {
$link=$file_list[$i];
$out="";
$srt = str_replace(".xml",".srt",$link);
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
$fp = fopen($srt, 'w');
fwrite($fp, $out);
fclose($fp);
}
$rm = "rm -f ".$dir;
exec ($rm);
flush();
}
?>
