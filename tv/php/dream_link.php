#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$id=$_GET["link"];
$opt[1]="http://188.26.30.180:8001/";
$opt[2]="http://79.116.18.76:8001/";
$opt[3]="http://79.118.49.96:8001/";
//$id="1:0:1:2AA8:1838:FBFF:820000:0:0:0:";
//$h=file_get_contents("http://fms3.dns04.com:1888/web/zap?sRef=http://fms3.dns04.com:8001/1:0:1:3644:C8:13E:820000:0:0:0:".$id."");
//1:0:1:2AA8:1838:FBFF:820000:0:0:0:
//$h=file_get_contents("http://109.228.140.220/api/zap?sRef=".$id."");
//$h=file_get_contents("http://217.162.34.65/api/zap?sRef=".$id."");
//$h=file_get_contents("http://217.162.34.65/api/zap?sRef=".$id."");
//echo $h;
//$a=trim(str_between($h,"Active service is now '","'"));
$out=$opt[mt_rand(1,3)].$id;
print $out;
?>
