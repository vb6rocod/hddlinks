#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link="http://listen.sky.fm/webplayer/".$link.".jsonp?callback=_API_Playlists_getChannel";
//http://pub5.sky.fm:80/sky_60srock_aacplus
//http://www.sky.fm/mp3/60srock.pls

//http://pub8.sky.fm:80/sky_60srock
//http://pub7.sky.fm:80/sky_60srock_aacplus
//http://pub3.sky.fm:80/sky_00srnb_aacplus.flv
//echo $link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html=curl_exec($ch);
  curl_close($ch);
$html=str_replace("\/","/",$html);
$html=str_replace('"',"",$html);
$h=str_between($html,'_API_Playlists_getChannel([',']');
$t1=explode(",",$h);
$n=count($t1);
$sel=mt_rand(1,$n);
//echo $sel;
$movie=$t1[$sel - 1];
$movie=str_replace(".flv","",$movie);
//$t1=explode("_aac",$movie);
//$movie=$t1[0];
print $movie;
?>
