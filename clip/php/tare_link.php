#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link=urldecode($link);
$link="http://www.tare.ro/pacmanplus11/5540786-cazatura-urata-de-pe-scena";

$cookie="D://iplay.txt";
//$cookie="/tmp/iplay.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.tare.ro/recente/video");
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $id=str_between($html,'embedSrc = "','"');
  echo $id."<BR>";
  //echo $html."<BR>";

//$html = file_get_contents($link);
//http://cache.tare.ro/xml/playlist.xml/4ab5f8c6a24ec7ab0b4017d9043bb08b
//http://cache.tare.ro/50e6f3c225c18/videoplayer1.swf?key=187ecc9c87fec2e905a9edbad075f0a2&autostart=true&X1_ad_params:escape(%27pub=632203491294404&site=apropo&section=apropo_tare&zone=rectangle_video&size=0x0%20%27)
//http://cache.tare.ro/50e6f3c225c18/videoplayer1.swf?key=187ecc9c87fec2e905a9edbad075f0a2&autostart=true&X1_ad_params:escape('pub=632203491294404&site=apropo&section=apropo_tare&zone=rectangle_video&size=0x0 ')

$t0=explode('src: "',$html);
$t1=explode('?key=',$t0[1]);
$t2=explode('&',$t1[1]);
$id=$t2[0];
echo $id."<BR>";

$a1=explode('src: "',$t0[1]);
$a2=explode('"',$a1[1]);
$ref=$a2[0];
$ref=str_replace("'","%27",$ref);
$ref=str_replace(" ","%20",$ref);
echo $ref."<BR>";
//echo $html."<BR>";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ref);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_exec($ch);
  curl_close($ch);

//Referer: http://cache.tare.ro/50e566761743e/videoplayer1.swf?key=770583ea9b2f8092b07e68350a0a0880&autostart=true&X1_ad_params:escape(%27pub=632203491294404&site=apropo&section=apropo_tare&zone=rectangle_video&size=0x0%20%27)
//http://cache.tare.ro/xml/playlist.xml/187ecc9c87fec2e905a9edbad075f0a2
//http://cache.tare.ro/xml/playlist.xml/8369682d32208d382cf80fae43e51691
$l1="http://cache.tare.ro/xml/playlist.xml/".$id;
echo $l1."<BR>";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$ref);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$ref);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$link = str_between($html, 'url="', '"');
print $link;
?>
