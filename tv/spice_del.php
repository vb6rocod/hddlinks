#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$cookie="/tmp/spice1.txt";
if (file_exists("/data"))
  $cookie1= "/data/spice1.txt";
else
  $cookie1="/usr/local/etc/spice1.txt";
$l="http://www.spicetvbox.ro/user/device#";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,"http://www.spicetvbox.ro/user/device");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $html=str_between($html,'<ul class="list-group','</ul');
  $devices = explode('<li', $html);
  unset($devices[0]);
  $devices = array_values($devices);
  //print_r(sizeof($devices));

if (sizeof($devices) > 0) {
  foreach($devices as $device) {
   $t1=explode('href="',$device);
   $t2=explode('"',$t1[1]);
   $ld=$t2[0];
   $dd=trim(str_between($device,'</strong>','</span>'));
   if (strpos($dd,"Web TV - Browser") !== false) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ld);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,"http://www.spicetvbox.ro/user/device");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
   }
  }
print "Am sters lista de Web TV device-uri.";
} else {
print "Nu sunt device-uri Web TV in uz.";
}
$exec="rm -f /tmp/spice1.txt";
exec ($exec);
$exec="rm -f ".$cookie1;
exec ($exec);
?>
