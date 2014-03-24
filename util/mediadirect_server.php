#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$l = $_GET["file"];
$s="http://index.mediadirect.ro/getUrl?publisher=1";
$h = file_get_contents($s);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "" || $serv == "fms11.mediadirect.ro") {
  $serv="fms15.mediadirect.ro";
}
$l1="/usr/local/etc/dvdplayer/mediadirect_token.dat";
$tp=trim(file_get_contents($l1));
$l=urldecode($l);
   $ch = curl_init($l);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_REFERER, "http://portaltv.ro/sn.php?token=");
   $h = curl_exec($ch);
   curl_close($ch);
   $y=str_between($h,"live3/","/");
   $t=str_between($h,"token=",'"');
   if (strpos($t,"Warning") !== false) $t="";
   $out=$serv."\n".$y."\n".$t.$tp;
$f="/tmp/mediadirect.txt";
$fp = fopen($f, 'w');
fwrite($fp, $out);
fclose($fp);
sleep(1);
?>
