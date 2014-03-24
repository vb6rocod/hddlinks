#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$cookie="/tmp/cookie.txt";
$link="http://www.youfreetv.net/index.php?section=channel&value=".$link;
$html=file_get_contents($link);
$rtmp=str_between($html,"streamer: '","'");
$a = substr(strrchr($rtmp, "/"), 1);
$y=str_between($html,"file: '","'");
$w=str_between($html,"flash', src: '","'");
if (strpos($w,"http") === false)
   $w="http://www.youfreetv.net/".$w;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $w);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$l="Rtmp-options:-a ".$a." -W ".$w." -y ".$y.",".$rtmp;
$l=str_replace(" ","%20",$l);
print $l;
?>
