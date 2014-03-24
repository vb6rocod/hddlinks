#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//error_reporting(0);
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
   $dir_log = "/tmp/usbmounts/sdc2/download/log/";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/";
   $dir_log = "/tmp/hdd/root/log/";
} else {
     $dir = "";
     $dir_log = "";
}
$query = $_GET["file"];

$queryArr = explode(',', $query);
$id = $queryArr[0];
$title = urldecode($queryArr[1]);
$name = $queryArr[2];

$out="";
$title=str_replace(" ","%20",$title);
$title=str_replace("\'","%27",$title);
$file="http://hdforall.uphero.com/srt/".$id.".srt";
$html=file_get_contents($file);
if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $html)) {
  $out=$html;
} else {
$sub="http://s1.ezflow.eu/xml/".$title.".xml";
$html = file_get_contents($sub);
if (!$html)
  $sub=str_replace("1280w","1600w",$sub);
$html = file_get_contents($sub);
if ($html) {
$videos = explode('<p', $html);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$line22=str_replace("<![CDATA[","",$video);
$line22=str_replace("]]>","",$line22);
$t1=explode('begin="',$line22);
$t2=explode('"',$t1[1]);
$start=$t2[0];
$start=str_replace(".",",",$start);
$t1=explode('end="',$line22);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$end=str_replace(".",",",$endtime);
$line=str_between($t1[1],'">',"</p");
$line=str_replace("<br />","\r\n",$line);
$out = $out.$n."\r\n";
$out = $out.$start." --> ".$end."\r\n";
$out = $out.$line."\r\n";
$out = $out."\r\n";
$n++;
}
}
}
$new_file = $dir.$name.".srt";
$fh = fopen($new_file, 'w');
fwrite($fh, $out);
fclose($fh);
?>
