#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//rtmp://ro.privesc.eu/storage/
$link = $_GET["file"];
$html = file_get_contents($link);
$t1=explode("'file': '",$html);
$t2=explode("'",$t1[1]);
$y="mp4:".$t2[0];
$rtmp=str_between($html,"streamer': '","'");
//$rtmp="rtmp://ro.privesc.eu/storage/";
$opt="Rtmp-options:-W http://storage.privesc.eu/flashplayer/player.swf -p http://www.privesc.eu";
$opt=$opt." -y ".$y.",".$rtmp;
$opt=str_replace(" ","%20",$opt);
print $opt;
?>
