#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $dinamic = urldecode($queryArr[1]);
}
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$cookie="D://spice.txt";
$cookie="/tmp/spice1.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
//jsAppData=new Array("rtmp://core1.spicetv.ro:1935/redirect","mp4:spicetv/ro/Antena3.sdp","a9f811508037fa8566272aad0b890a51de1174301fd7210420092d838a6aab66");
$h=str_between($h,'jsAppData=new Array("',")");
$t1=explode('"',$h);
//echo $h;
$rtmp1=$t1[0];
//echo $rtmp1;

$h=str_replace('"',"",$h);
$t1=explode(",",$h);
$str=$t1[1];
$app="live?".$t1[2];
//test
if ($dinamic == "Da") {
if (strpos($rtmp1,"redirect") !== false) {
$exec = "rm -f /tmp/log.txt";
$ret=exec($exec);
$w="http://static.spicetvnetwork.ro/player/player.swf";
$app1="redirect?".$t1[2];
$exec = '/usr/local/etc/www/cgi-bin/scripts/rtmpdump -V -v -a "'.$app1.'" -r '.$rtmp1." -y ".$str." -W ".$w." -p http://www.spicetv.ro  2>/tmp/log.txt";
//echo $exec;
$ret=exec($exec,$a);
$h=file_get_contents("/tmp/log.txt");
//echo $h;
$t1=explode("redirect, STRING:",$h);
$t2=explode("?",$t1[1]);
$rtmp=trim($t2[0]);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
$h=str_between($h,'jsAppData=new Array("',")");
$h=str_replace('"',"",$h);
$t1=explode(",",$h);
$str=$t1[1];
$app="live?".$t1[2];
} else {
$rtmp=$rtmp1;
}
} else {
$rtmp="rtmp://edge2.spicetvnetwork.de:1935/live";
}
//rtmp://edge2.spicetvnetwork.de:1935/live
/*
$rtmp="rtmp://109.163.236.119:1935/live";
$rtmp="rtmp://edge1.spicetvnetwork.de:1935/live";
$rtmp="rtmp://edge2.spicetvnetwork.de:1935/live";
*/
//
$l="Rtmp-options:";
$l=$l." -a ".$app." -W http://static.spicetvnetwork.ro/player/player.swf";
$l=$l." -p http://www.spicetv.ro ";
$l=$l."-y ".$str;
$l=$l.",".$rtmp;
$l=str_replace(" ","%20",$l);
$movie=$l;
print $movie;
?>
