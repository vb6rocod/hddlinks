#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$l=str_between($html,"config=",'"');
$h=file_get_contents(urldecode($l));
$link = str_between($h, 'url": "', '"');
$link=str_replace("https","http",$link);
$movie=file_get_contents("http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".$link);
/*
if (!preg_match("/mp4/",$link))
  $link=str_between($html,'file": "','"');
*/
//$movie=str_replace("&","&amp;",$movie);
print $movie;
?>
