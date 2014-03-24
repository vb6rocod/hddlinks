#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link1 = $_GET["file"];
$html = file_get_contents($link1);
$link1 = "http://embed.videofriender.com/videos/embed?id=".str_between($html, 'embed?id=', '"');
$html = file_get_contents($link1);
$link=str_between($html,'param name="src" value="','"');
print $link;
?>
