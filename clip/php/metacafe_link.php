#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//http://v.mccont.com/ItemFiles/%5BFrom%20www.metacafe.com%5D%209089514.23935216.4.mp4?__gda__=1347632054_e2fd8a03ea84125650d6b52240cb5b8d
//http://v.mccont.com/ItemFiles/%5BFrom%20www.metacafe.com%5D%209089514.23935216.4.mp4?__gda__=1347632471_9a21f3bbd97a2582f2a985f78b0c9c68
//http://v.mccont.com/ItemFiles/%5BFrom%20www.metacafe.com%5D%209089514.23935216.4.mp4?__gda__=__gda__
$html = file_get_contents($link);
$link = urldecode(str_between($html, '<object classid="', '</object>'));
//echo $link;
$link1 = str_between($link,'"mediaURL":"','"');
//echo $link1;
$key = str_between($link,'key":"__gda__","value":"','"');
$link1= str_replace('\/','/',$link1);
$link1= str_replace('\/','/',$link1);
$link1 = str_replace(' ','%20',$link1);
$link1 = str_replace('[','%5B',$link1);
$link1 = str_replace(']','%5D',$link1);
$link2 = $link1."?__gda__=".$key;
print $link2;
?>
