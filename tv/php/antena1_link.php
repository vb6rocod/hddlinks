#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link = urldecode($link);
$html = file_get_contents($link);
//echo $html;
//http://ivm.inin.ro/js/embed.js?id=087JEIpfDdb
//http://ivm.aplay.ro/js/embed.js?id=JWlU0PlOEDL&width=470&height=352&autoplay=0&wide=true
//preg_match('/(ivm\.(inin|aplay)\.ro\/js\/embed\.js)(.*)(id=)([\w\-]+)/', $html, $match);
preg_match('/(\w+)\.ro\/js\/embed\.js(.*)(id=)([\w\-]+)/', $html, $match);
//$id = $match[4];
//print_r ($match);
//$l="http://ivm.inin.ro/js/embed.js?id=".$id;
$l="http://ivm.".$match[0];
//echo $l;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html = curl_exec($ch);
  curl_close($ch);
  //echo $html;
//$link = str_between($html, "real_file: '", "'");
//http://vodh2.inin.ro/antena1/2013/04/05/kComrkgwPkh.mp4?start=0
/*
$link = str_between($html,'"file":"','"');
$link=str_replace("\\","",$link);
//$link=str_replace("_400","",$link);
$link=$link."?start=0";
*/
$html=str_replace("\\","",$html);
preg_match('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)\.mp4@',$html,$m);
//print_r ($m);
$link= $m[0]."?start=0";

print $link;
?>
