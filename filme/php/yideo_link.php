#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$l = $_GET["file"];
$h=file_get_contents($l);
$l1=urldecode(str_between($h,"proxy.link=","&"));
$srt=str_between($h,"captions.file=",'"');
$srt=str_replace(" ","%20",$srt);
$h1=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/xml_xml.php?file=".urlencode($srt));
$movie=file_get_contents("http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($l1));
$movie=str_replace(" ","%20",$movie);
print $movie;
?>
