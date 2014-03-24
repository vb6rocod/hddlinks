#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link="http://livenews.rtv.net/video.php?video=".$link;
$html = file_get_contents($link);
//echo $html;
$t1 = explode('href="', $html);
$t2 = explode('"', $t1[1]);
$link = $t2[0];
print $link;
?>
