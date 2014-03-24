#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link=urldecode($link);
$html=file_get_contents($link);
$rtmp=str_between($html,"streamer', '","'");
$a=substr(strrchr($rtmp, "/"), 1);
$y=str_between($html,"file', '","'");
$w="http://skystreamlive.com//player/skystreamlive.com.swf";
$p="http://skystreamlive.com";
$l="Rtmp-options:-a ".$a." -W ".$w." -p http://skystreamlive.com -y ".$y.",".$rtmp;
$l=str_replace(" ","%20",$l);
print $l;
?>
