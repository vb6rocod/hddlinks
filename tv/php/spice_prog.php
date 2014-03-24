#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function c($title) {
     $title = htmlentities($title);
     $title = str_replace("&ordm;","s",$title);
     $title = str_replace("&Ordm;","S",$title);
     $title = str_replace("&thorn;","t",$title);
     $title = str_replace("&Thorn;","T",$title);
     $title = str_replace("&icirc;","i",$title);
     $title = str_replace("&Icirc;","I",$title);
     $title = str_replace("&atilde;","a",$title);
     $title = str_replace("&Atilde;","I",$title);
     $title = str_replace("&ordf;","S",$title);
     $title = str_replace("&acirc;","a",$title);
     $title = str_replace("&Acirc;","A",$title);
     $title = str_replace("&oacute;","o",$title);
     $title = str_replace("&amp;", "&",$title);
     return $title;
}
$l = $_GET["file"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.spicetv.ro/");
  $html = curl_exec($ch);
  curl_close($ch);
$now=str_between($html,'span class="now">','</span>');
$now=str_replace("<em>"," ",$now);
$now = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$now);
$now=urlencode($now);
$now=preg_replace("/%0A|%09/","",$now);
$now=urldecode($now);
print $now."\n\r\n\r";
$videos = explode('span class="nextPro">', $html);
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t1=explode("</span",$video);
  $now=str_replace("</em>"," ",$t1[0]);
$now = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$now);
$now=urlencode($now);
$now=preg_replace("/%0A|%09/","",$now);
$now=urldecode($now);
print $now."\n\r\n\r";
}
?>

