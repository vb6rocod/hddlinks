#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://www.vtc.com.vn/xml.php?id=75&tp=l&pop=undefined
//$link="http://vtc.com.vn/XMLFile.aspx?id=".$link."&tp=l&pop=";
$link="http://www.vtc.com.vn/xml.php?id=".$link."&tp=l&pop=";
$html=file_get_contents($link);
$s=str_between($html,"<connect>","</connect>");
$f=str_between($html,"<play>","</play>");
$server=$s."/".$f;
$server=str_replace("/live",":1935/live",$server);
print $server;
?>
