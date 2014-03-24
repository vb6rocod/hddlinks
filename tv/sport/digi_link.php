#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://s2.digisport.ro/onedb/transcode:50ba5cb995f9cfd70500009f.mp4?start=0
//http://s2.digisport.ro/onedb/transcode:50bc81cc95f9cfa833000003.mp4?start=0
//http://s2.digisport.ro//onedb:transcode/51102c2495f9cf1f5d000000.mp4
//http://s2.digisport.ro//onedb:transcode/5110389695f9cfaf19000000.mp4
//http://s2.digisport.ro//onedb/picture:5110cfd995f9cf7136000001
//http://s2.digisport.ro//onedb/transcode/5110cfd995f9cf7136000001.mp4
//http://s1.digisport.ro//onedb/transcode/513d188695f9cf8e18000000.240p.mp4
//http://s2.digisport.ro//onedb/transcode/513d188695f9cf8e18000000.240p.mp4
//http://s2.digisport.ro//onedb/513cc5ec95f9cfdb64000000.360p.mp4
//data-versions="240p.mp4,360p.mp4,480p.mp4,720p.mp4,android.mp4,blackberry.mp4,iphone.mp4,mp4,ogv,webm"
//data-src="
$cookie="D://cookie.txt";
$cookie="/tmp/cookie.txt";
$id = $_GET["file"];
//$id=urldecode($id);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $id);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
//echo $html;
$t1=explode('data-src="',$html);
$t2=explode('"',$t1[1]);
$id1=$t2[0];
$link="http://s2.digisport.ro//".$id1.".360p.mp4";
$link=str_replace("onedb","onedb/transcode",$link);
print $link;
?>
