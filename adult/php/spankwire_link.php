#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
/*
$link = str_between($html, 'encodeURIComponentSub("', '"');
$html = file_get_contents($link);
$link1 = str_between($html, "<url>", "</url>");
$link1=str_replace("&amp;","&",$link1);
*/
//$link1=urldecode(str_between($html,'flashvars.video_url = "','"'));
//$link1=urldecode(str_between($html,'vidSource = unescape("','"'));
$link1=urldecode(str_between($html,'playerData.cdnPath480 = "','"'));
print $link1;
?>
