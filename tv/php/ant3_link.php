#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function enc($string) {
  $local3="";
  $arg1=strlen($string);
  $arg2="mediadirect";
  $l_arg2=strlen($arg2);
  $local4=0;
  while ($local4 < $arg1) {
    $m1=ord($string[$local4]);
    $m2=ord($arg2[$local4 % $l_arg2]);
    $local3=$local3.chr($m1 ^ $m2);
    $local4++;
  }
  return $local3;
}
$link = $_GET["file"];
$link=urldecode($link);
$html = file_get_contents($link);
$t1=explode('flashvars.str="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$link=enc($t1);
$l="http://index.mediadirect.ro/getUrl?file=".$link."&app=recantena3&publisher=0";
$h = file_get_contents($l);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms2.mediadirect.ro";
}
$link="rtmpe://".$serv.":80/recantena3?id=1676684/".$link;
print $link;
?>
