#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
//http://www.livestation.com/channels/43/playlist.xml?
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$ch=$_GET["file"];
$l="http://www.livestation.com/channels/".$ch."/playlist.xml?";
$html=file_get_contents($l);
$s=str_between($html,"<jwplayer:streamer>","</jwplayer:streamer>");
$t1=explode('url="',$html);
$t2=explode('"',$t1[1]);
$a=$t2[0];
$link=$s.$a;
print $link;
?>
