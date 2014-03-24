#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $ref = urldecode($queryArr[1]);
}
$link=urldecode($link);
if (strpos($link,"?") !== false) {
$id=str_between($link,"video/","?");
$cur_link="http://player.vimeo.com/video/".$id;
} else {
$cur_link=$link;
}
$link= "http://127.0.0.1/cgi-bin/scripts/util/vimeo.cgi?stream,,".urlencode($cur_link);
print $link;
?> 
