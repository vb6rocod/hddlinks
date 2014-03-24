#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://www.digi24.ro/js/init.onedb.js?v=21
//http://s1.digi24.ro//onedb:transcode/51e4230795f9cff067000000.480p.mp4
//s2.digi24.ro
//s6.digi24.ro
//onedb/51e4230795f9cff067000000
$link = $_GET["file"];
$link=str_replace(" ","+",$link);
//echo $link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h=curl_exec($ch);
  curl_close($ch);
$id=str_between($h,'data-src="','"');
$id=str_replace("onedb","onedb:transcode",$id);
$movie= "http://s1.digi24.ro//" .$id.".480p.mp4";
print $movie;
?>
