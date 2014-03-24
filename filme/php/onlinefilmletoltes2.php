#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
//http://onlinefilmletoltes.eu/files/?u=aiud7n1i&go=1
//Referer: http://abfbc35c.linkbucks.com/url/http://onlinefilmletoltes.eu/files/?u=aiud7n1i&go=1

$link="http://onlinefilmletoltes.eu/files/?u=".$link."&go=1";
$ref="http://abfbc35c.linkbucks.com/url/".$link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$ref);
  curl_setopt($ch, CURLOPT_HEADER,1);
  curl_setopt($ch, CURLOPT_NOBODY,1);
  //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);

$t1=explode("ocation:",$html);
$t2=explode("\n",$t1[1]);
$l=trim($t2[0]);
if ($l) {
  $l="http://127.0.0.1/cgi-bin/scripts/filme/php/link1.php?file=".urlencode($l);
  $movie=file_get_contents($l);
  print $movie;
}
?>
