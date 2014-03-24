#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$k = $_GET["file"];
$l="http://www.vplay.ro/play/dinosaur.do";
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_MAXREDIRS, 3);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch,CURLOPT_REFERER,"http://i.vplay.ro/f/embed.swf?key=".$k);
  //curl_setopt($ch, CURLOPT_COOKIEFILE, 'D://cookies.txt');
  $page = curl_exec($ch);
  curl_close($ch);
$l=str_between($page,"nqURL=","&");
print $l;
?>
