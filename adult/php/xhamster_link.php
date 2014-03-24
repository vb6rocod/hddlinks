#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://88.208.24.199/key=HguE3Mr6VdY,end=1323796582/data=1314962759/buffer=450K/speed=83200/reftag=392380/4/xh/101778_Anja_Laval_and_Tyra_Misoux_lesbians_in_the_office_M22.flv
//http://88.208.24.199/key=npZZy9gmjSc,end=1323796582/data=1314962759/speed=83200/101778_Anja_Laval_and_Tyra_Misoux_lesbians_in_the_office_M22.flv
$link = $_GET["file"];
$html = file_get_contents($link);
$mod=str_between($html,"url_mode=","&");
$srv=str_between($html,"srv=","&");
$file=str_between($html,"file=","&");
if ($mod=="3")
  $link=urldecode($file);
else if ($mod=="1")
  $link=urldecode($srv."/key=".$file);
print $link;
?>
