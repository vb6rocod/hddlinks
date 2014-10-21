#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $dinamic = urldecode($queryArr[1]);
}
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$cookie="D://spice.txt";
$cookie="/tmp/spice1.txt";
if (file_exists("/data"))
  $cookie1= "/data/spice1.txt";
else
  $cookie1="/usr/local/etc/spice1.txt";
if (file_exists($cookie1)) {
  $handle = fopen($cookie1, "r");
  $c = fread($handle, filesize($cookie1));
  fclose($handle);
  $fh = fopen($cookie, 'w');
  fwrite($fh, $c);
  fclose($fh);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,"http://www.spicetvbox.ro/live");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);

  $handle = fopen($cookie, "r");
  $c = fread($handle, filesize($cookie));
  fclose($handle);
  $fh = fopen($cookie1, 'w');
  fwrite($fh, $c);
  fclose($fh);

$rtmp=str_between($h,"var stvLiveStreamer='","'");
$str=str_between($h,"var stvLiveChannel='","'");
$t1=explode("live",$rtmp);
$rtmp=$t1[0]."live/";
$app="live".$t1[1];

//rtmp://edge2.spicetvnetwork.de:1935/live
/*
$rtmp="rtmp://109.163.236.119:1935/live";
$rtmp="rtmp://edge1.spicetvnetwork.de:1935/live";
$rtmp="rtmp://edge2.spicetvnetwork.de:1935/live";
*/
//
$l="Rtmp-options:";
$l=$l."-a ".$app." -W http://static.spicetvbox.com/flash/jwplayer.flash.swf";
$l=$l." -p ".$link." ";
$l=$l."-y ".$str;
$l=$l.",".$rtmp;
$l=str_replace(" ","%20",$l);
$movie=$l;
print $movie;
?>
