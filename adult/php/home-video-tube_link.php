#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link = str_replace(' ','%20',$link);
$link = str_replace('[','%5B',$link);
$link = str_replace(']','%5D',$link);
$title = "Link";
$html = file_get_contents($link);
$link = str_between($html, 'to.addVariable("initexemel", "', '&');
$html = file_get_contents($link);
$link = str_between($html, '"FLVPath" Value="', '"');
print $link;
?>
