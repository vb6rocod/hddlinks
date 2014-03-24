#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$l = $_GET["file"];
$l=urldecode($l);
$html=file_get_contents($l);
//echo $html;
$t1=explode("VideoLAN.VLCPlugin",$html);
$t2=explode('target="',$t1[1]);
$t3=explode('"',$t2[1]);
$movie=$t3[0];
print $movie;
?>
