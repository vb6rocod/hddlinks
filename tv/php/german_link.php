#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function get_link($l1) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $page = curl_exec($ch);
  curl_close($ch);
  return $page;
}
$link = $_GET["file"];
if (strpos($link,".pls") !== false) {
$html = get_link($link);
preg_match("/(http|mms)(.*)/i",$html,$m);
$l = trim($m[0]);
} elseif (strpos($link,".asx") !== false) {
$html = get_link($link);
preg_match("/(http|mms)(.*)/i",$html,$m);
$l = trim($m[0]);
$l = explode('"',$l);
$l=$l[0];
} elseif (strpos($link, ".m3u") !== false) {
$html = get_link($link);
preg_match("/(http|mms)(.*)/i",$html,$m);
$l = trim($m[0]);
} elseif (strpos($link,".wpl") !== false) {
$html = get_link($link);
$t1=explode('src="',$html);
$t2=explode('"',$t1[1]);
$l=trim($t2[0]);
} else {
$l= $link;
}
print $l;
?>
