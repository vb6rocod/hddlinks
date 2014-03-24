#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tip = $queryArr[1];
}
$html = file_get_contents($link);
If ($tip=="1") {
$link = str_between($html, 'video_file = "', '"');
} else {
$link = str_between($html, 'addVariable("moviepath","', '"');
}
print $link;
?>
