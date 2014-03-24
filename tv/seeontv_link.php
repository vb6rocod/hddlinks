#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
$queryArr = explode(',', $query);
$link = $queryArr[0];
$tit = urldecode($queryArr[1]);
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//streamer=rtmp%3A%2F%2Flive00.seeon.tv%2Fredirect&file=hhzpgreq2jowut3.flv&autostart=true&plugins=http://static.seeon.tv/jwplayer/seeon-plugin.swf
$html = file_get_contents($link);
$server=mt_rand(1,30);
//$server="1";
//rtmp://live3.seeon.tv/edge/ktc6f73bm5w2ny8
$id=str_between($html,"&file=",".flv");
$link="rtmp://live".$server.".seeon.tv/edge/".$id;
print $link;
?>
