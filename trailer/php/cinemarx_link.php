#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$baseurl = "http://127.0.0.1/cgi-bin/translate?stream,Content-type:video/x-flv,";
    $html = file_get_contents($link);
    $t1 = explode('rx_s.addVariable("file", "', $html);
    $t2 = explode('"', $t1[1]);
    $link = $t2[0];
print $link;
?>
