#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
//http://www.youporn.com/oldStreamURL/57272
$link = "http://www.youporn.com".str_between($html, "encodeURIComponent('", "'");
$html = file_get_contents($link);
$link1 = str_between($html, "<location>", "</location>");
$link1=str_replace("&amp;","&",$link1);
print $link1;
?>
