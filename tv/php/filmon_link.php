#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $id = $queryArr[0];
   $serv = $queryArr[1];
}
$cookie="D://filmon.txt";
$cookie="/tmp/filmon.txt";
$l="http://www.filmon.com/ajax/getChannelInfo";
//channel_id=14&quality=low
$post="channel_id=".$id."&quality=low";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.filmon.com/");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8","X-Requested-With: XMLHttpRequest", "Content-Length: ".strlen($post)));
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h=curl_exec($ch);
  curl_close($ch);
  

$h=str_replace("\\","",$h);
//echo $h."<BR>";
//echo $h;
//
$rtmp=str_between($h,'serverURL":"','"');
$t1=explode("live/",$rtmp);
$rtmp1=$t1[0]."live/";
$a="live/".$t1[1];
$y=str_between($h,'streamName":"','"');
if ($serv == "SD")
   $y=str_replace("high.stream","low.stream",$y);
$link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:";
$link=$link."-y ".$y." -a ".$a." -W http://www.filmon.com/tv/modules/FilmOnTV/files/flashapp/filmon/FilmonPlayer.swf";
$link=$link." -p http://www.filmon.com,".$rtmp1;
$link=str_replace(" ","%20",$link);
print $link;

$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump -b 60000 -q -v -p "http://www.filmon.com" -W "http://www.filmon.com/tv/modules/FilmOnTV/files/flashapp/filmon/FilmonPlayer.swf" -r "'.$rtmp1.'" -a "'.$a.'" -y "'.$y.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/filmon.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/filmon.cgi");
sleep(1);
?>
