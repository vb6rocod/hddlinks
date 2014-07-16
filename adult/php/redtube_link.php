#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$t1=explode("vpVideoSource",$html);
$t2=explode('"',$t1[1]);
$t3=explode('"',$t2[1]);
$out=str_replace("\/","/",$t3[0]);
print $out;
?>
