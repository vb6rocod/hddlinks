#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//echo urlencode('"');
$link = $_GET["file"];
$link=urldecode($link);
//$exec = "rm -f /tmp/log.txt";
//$ret=exec($exec);
$h=file_get_contents($link);

$l1="http://twiki.org/cgi-bin/xtra/tzdate";
    $process = curl_init($l1);
	curl_setopt($process, CURLOPT_HTTPGET, 1);
	curl_setopt($process, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($process,CURLOPT_CONNECTTIMEOUT, 5);
	$h1 = curl_exec($process);
	curl_close($process);
$time_gmt=trim(str_between($h1,"date-->","+"));

$tt=strtotime($time_gmt);
$t1=explode('getJSON("',$h);
$t2=explode('"',$t1[1]);
$t=$t2[0]."_&=".$tt;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $t);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $link);
  $h2 = curl_exec($ch);
  curl_close($ch);
//echo $h2;
$token=str_between($h2,'token":"','"');

$t1=explode('streamer: "',$h);
$t4=explode('"',$t1[1]);
$rtmp=$t4[0];
$t2=explode('file: "',$t1[1]);
$t3=explode('"',$t2[1]);
$y=$t3[0];
$t1=explode(".",$y);
$y=$t1[0];
$t1=explode('flashplayer: "',$h);
$t2=explode('"',$t1[1]);
$w=$t2[0];
if (strpos($rtmp,"redirect") !== false) {
$exec = "/usr/local/etc/www/cgi-bin/scripts/rtmpdump -V -v -T ".$token." -r ".$rtmp." -y ".$y." -W ".$w." -p http://ilive.to  2>/tmp/log.txt";
$ret=exec($exec,$a);
$h=file_get_contents("/tmp/log.txt");
$t1=explode("redirect, STRING:",$h);
$t2=explode("<",$t1[1]);
$rtmp=$t2[0];
}
$w="http://player.ilive.to/player_ilive_2.swf";
$out="#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -b 60000 -q -v -p http://ilive.to -r ".$rtmp." -W ".$w." -y ".$y.' -T "'.$token.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/ilive.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/ilive.cgi");
sleep(1);
print $out;
?>
