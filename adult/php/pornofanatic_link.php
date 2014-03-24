#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function str_prep($string){
  $string = str_replace(' ','%20',$string);
  $string = str_replace('[','%5B',$string);
  $string = str_replace(']','%5D',$string);
  $string = str_replace('%3A',':',$string);
  $string = str_replace('%2F','/',$string);
  $string = str_replace('#038;','',$string);
  $string = str_replace('&amp;','&',$string);
  return $string;
}
$link = $_GET["file"];
$link=urldecode($link);
$link=str_prep($link);
$html = file_get_contents($link);
$t1=explode('name="FileName"',$html);
$t2=explode('value="',$t1[1]);
$t3=explode('"',$t2[1]);
$l1=$t3[0];
if ($l1== "") {
$l1=str_between($html,"addVariable('file','","'");
}
$link="http://127.0.0.1/cgi-bin/translate?stream,,".$l1;
print $link;
?>
