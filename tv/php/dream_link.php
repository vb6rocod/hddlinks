#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$id=$_GET["link"];
//$id="1:0:1:2AA8:1838:FBFF:820000:0:0:0:";
//$h=file_get_contents("http://fms3.dns04.com:1888/web/zap?sRef=http://fms3.dns04.com:8001/1:0:1:3644:C8:13E:820000:0:0:0:".$id."");
//1:0:1:2AA8:1838:FBFF:820000:0:0:0:
$h=file_get_contents("http://fms3.dns04.com/api/zap?sRef=".$id."");

//echo $h;
$a=trim(str_between($h,"Active service is now '","'"));
$out=$out="http://fms3.dns04.com:8001/".$a;
print $out;
?>
