#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
exec ("rm -f /tmp/test.xml");
$id = $_GET["file"];
$file="http://panel.erstream.com/api/er/Get?cid=".$id."&format=4&customerid=16&action=redirect&id=".$id."";
$r=get_headers($file);
$out=trim(str_between($r[4],"Location:","mp4"))."mp4";
print $out;
?>
