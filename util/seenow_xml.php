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
error_reporting(0);
$cookie="D://seenow.txt";
$cookie="/tmp/seenow.txt";
exec ("rm -f /tmp/test.xml");
$file = $_GET["file"];
//
$file=urldecode($file);
$h=file_get_contents($cookie);
$t1=explode("PHPSESSID",$h);
$t2=explode("\n",$t1[1]);
$sid=trim($t2[0]);
//http://www.seenow.ro/movie-america-privita-din-aer-california-439-2
//http://www.seenow.ro/detail-america-privita-din-aer-connecticut-482-2-0
$l=str_replace("detail","movie",$file);
$l = substr($l, 0, -2);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$file);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
//flashvars.str="     ----->>>> mp4:Ep.824_Trasnitii_low.mp4
$t1=explode('flashvars.str="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$str=enc($t1);
//$str=str_replace("_low","",$str);
//flashvars.app="  ------>>>> {0}/primatv
$t1=explode('flashvars.app="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$app=enc($t1);
$t1=explode("/",$app);
$app=$t1[1];
//flashvars.data="   ----->>>>> dolce_video
$t1=explode('flashvars.data="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$data=enc($t1);
//flashvars.publisher="  ---->>>> 2
$t1=explode('flashvars.publisher="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$publisher=enc($t1);
//flashvars.sub="  ---->>>> 2
$t1=explode('flashvars.sub="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$sub=enc($t1);
//http://index.mediadirect.ro/getUrl?file=mp4:Target_of_an_Assassin.mp4&app=cinemateca&publisher=2
//http://index.mediadirect.ro/getUrl?file=mp4:documentare/Aerial_America_Ep3_720p_hp.mp4&app=seenow&publisher=17
$l= "http://index.mediadirect.ro/getUrl?file=".$str."&app=".$app."&publisher=".$publisher;
$h = file_get_contents($l);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms1.mediadirect.ro";
}
//Rtmp-options:
$movie="Rtmp-options:-a seenow -C S:".$sid." -W http://static1.mediadirect.ro/player-preload/swf/cnow_1037/player.swf -p http://www.seenow.ro/ -C O:1 -C O:0 ";
$movie=$movie."-y ".$str;
$movie=$movie.",rtmpe://".$serv."/".$app;
$movie=str_replace(" ","%20",$movie);
//rtmpe://fms25.mediadirect.ro:1935/seenow" -a "seenow" -W "http://static1.mediadirect.ro/player-preload/swf/cnow_1037/player.swf" -p "http://www.seenow.ro/movie-america-privita-din-aer-california-439-2" -C O:1 -C O:0 -y "mp4:documentare/Aerial_America_Ep01_California_540p_hp.mp4"
///////////////////////////////////////////////////////////////////////
if ($sub <> "") {
$ttxml ="";
$full_line = '';
$last_end=0;
$html = file_get_contents($sub);
$videos = explode('<p', $html);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$line22=str_replace("<![CDATA[","",$video);
$line22=str_replace("]]>","",$line22);
$t1=explode('begin="',$line22);
$t2=explode('"',$t1[1]);
$start=$t2[0];
$time1=explode(":",$start);
$begin = round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
$t1=explode('end="',$line22);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$time1=explode(":",$endtime);
$end = round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
$f = "/usr/local/bin/home_menu22";
if (!file_exists($f)) {
if ($begin > $last_end)
 {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
 }
 $last_end=$end;
}
$line=str_between($t1[1],">","</p");
$l=explode("<br />",$line);
$line1=trim($l[0]);
$line2=trim($l[1]);
$line1 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line1);
$line2 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line2);
if ($line2=="")
{
$line2=$line1;
$line1="";
}
$ttxml .=$begin."\n";
$ttxml .=$end."\n";
$ttxml .=$line1."\n";
$ttxml .=$line2."\n";
}
//dummy sub
if ($end > 0) {
if (!file_exists($f))
   $ttxml .=$end."\n";
else
   $ttxml .="10000"."\n";
$ttxml .="10002"."\n";
$ttxml .="\n";
$ttxml .="\n";
}
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
print $movie;
//echo $ttxml;
?>
