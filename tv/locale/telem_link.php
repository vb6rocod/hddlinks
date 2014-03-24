#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$t1=explode('class="flowplayer"',$html);
$t2=explode('href="',$t1[1]);
$t3=explode('"',$t2[1]);
$link="http://www.telem.ro".$t3[0];
print $link;
?>
