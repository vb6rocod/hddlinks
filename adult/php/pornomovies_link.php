#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://videos.cdn.pornomovies.com/videos/93/13539.flv?nvb=20121009163845&nva=20121010123845&hash=0bf499b7b9839588dfb95&start=0

$link = $_GET["file"];
    $html = file_get_contents($link);
		$link = str_between($html, 'file", "', '"');
		$link=urldecode($link);
//$html = file_get_contents($link);
//$link = str_between($html, '<location>', '<');
print $link;
?>
