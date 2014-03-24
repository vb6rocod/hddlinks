#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$html = str_between($html,'<div class="items video">','</div>');
$videos = explode('href="',$html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
	$t2 = explode('"',$video);
	$link = "http://www.cfr1907.ro".$t2[0];
	
	$t1 = explode('src="',$video);
	$t2 = explode('"',$t1[1]);
	$image = "http://www.cfr1907.ro".$t2[0];
	
	$t1 = explode('title="',$video);
	$t2 = explode('"',$t1[1]);
	$title = $t2[0];
	if ($title == "") {
		$title = "Link";
	}
print $link;
}
?>
