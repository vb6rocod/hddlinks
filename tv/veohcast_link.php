#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
/*
http://www.veohcast.tv/channelV.php?n=20012@hyqw
/videochannel.php?n=20012@hyqw
///videochannel.php?n=9B728SYFYUSTVNOW1
//http://veohcast.tv/videochannel.php?n=syfy
//Referer: http://www.veohcast.tv/videolive1channel.php?n=908060CT
//http://www.veohcast.tv/videolive1embed.php?n=908060CT
//rtmp://84.234.23.221/tvcatchup/live
$l1="http://www.veohcast.tv/".$link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ro; rv:1.9.1) Gecko/20090624 Firefox/3.5 GTB7.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
//src='/usa/syfy.php'
$l2=str_between($h,"src='/","'");
$l2="http://www.veohcast.tv/".$l2;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l2);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ro; rv:1.9.1) Gecko/20090624 Firefox/3.5 GTB7.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
//src="../video3.php?n=B9B0ASYFYUSTVNOW1"
$server=str_between($h,"so.addVariable('streamer', '","'");
if ($server == "") {
  $t1=explode("video",$h);
  $t2=explode('"',$t1[1]);
  $l2= "http://www.veohcast.tv/video".$t2[0];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l2);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ro; rv:1.9.1) Gecko/20090624 Firefox/3.5 GTB7.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
  $server=str_between($h,"so.addVariable('streamer', '","'");
}
//$f=str_between($h,"so.addVariable('file', '","%3F");
$f=str_between($h,"so.addVariable('file', '","'");
if (strpos($f,"%3F") !==false) {
  $t1=explode("%3F",$f);
  $f=$t1[0];
}
$rest = substr($server, -1);
if ($rest == "/") {
$server=substr($server, 0, -1);
}
$server=$server."/".$f;
print $server;
*/
///sector.php?n=z010301.stream
////veohV.php?n=00009.stream
$link=urldecode($link);
if (strpos($link,"z") !== false)
  $link1="http://www.veohcast.tv/sector.php?n=".$link;
else
  $link1="http://www.veohcast.tv/veohV.php?n=".$link;
$html=file_get_contents($link1);

$s=trim(str_between($html,"streamer', '","'"));
$f=str_between($html,"file', '","'");
$ll=$f.",".$s;
print $ll;
?>
