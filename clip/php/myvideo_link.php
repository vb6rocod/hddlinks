#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://i4.myv-img.de/mv/web/144/movie33/b2/thumbs/9161536_1.jpg
//http://is4.myvideo.de/ro/movie33/b2/9161536.flv
$link = $_GET["file"];
//$h=file_get_contents($link);
//$link=str_between($h,"source src='","'");

$AgetHeaders = @get_headers($link);
//HTTP/1.1 404 Not Found
if (!preg_match("|200|", $AgetHeaders[0]))
$link=str_replace(".mp4",".flv",$link);

print $link;
?>
