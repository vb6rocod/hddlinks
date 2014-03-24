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
  $arg2="pwodoiucvbnkp";
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
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";
$sub_max = 53;
exec ("rm -f /tmp/test.xml");
//$file = $_GET["file"];
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $l = urldecode($queryArr[0]);
   $title = $queryArr[1];
   $title=str_replace(" ","+",$title);
   $episode = urldecode($queryArr[2]);
   $buf = $queryArr[3];
   $subtitle = $queryArr[4];
}
$t1=base64_decode($title);
$link=enc($t1);
$link=str_replace("\/","/",$link);
/*
{"server":"rtmp://s1.ezflow.eu/honeypot","stream":"mp4:filme/10.000.BC.2008.1080p.Blu-ray.Remux.AVC.TrueHD.5.1.KRaLiMaRKo.1280w.mp4","subtitle":"/media/movie/subtitle/xml/677.xml"}
*/
$y=str_between($link,'stream":"','"');
$sub=str_between($link,'subtitle":"','"');
$rtmp=str_between($link,'server":"','"');
$a = substr(strrchr($rtmp, "/"), 1);
$movie="Rtmp-options:-b ".$buf." -W http://videobox.iplay.ro/swf/CimPlayer.swf -p http://videobox.iplay.ro ";
$movie=$movie."-y ".$y;
$movie=$movie.",".$rtmp;
$movie=str_replace(" ","%20",$movie);
$movie=str_replace("\'","%27",$movie);
///////////////////////////////////////////////////////////////////////
$sub=str_replace(" ","%20",$sub);
$sub=str_replace("\'","%27",$sub);
if (strpos($sub,"default.xml") !== false) $subtitle="off";
$ttxml     = '';
$full_line = '';
$last_end=0;
if ($subtitle == "on") {
$html = file_get_contents($sub);
//echo $sub;
//echo $html;
if ($html) {
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
$time2=explode(".",$time1[2]);
$begin = round(3600*$time1[0] + 60*$time1[1] + $time2[0] + $time2[1]/1000);
$t1=explode('end="',$line22);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$time1=explode(":",$endtime);
$time2=explode(".",$time1[2]);
$end = round(3600*$time1[0] + 60*$time1[1] + $time2[0] + $time2[1]/1000);
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
$line=str_between($t1[1],'">',"</p");
$l=explode("<br />",$line);
$line1=trim($l[0]);
$line2=trim($l[1]);
$line1 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line1);
$line2 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line2);
 if (strlen($line1) >= $sub_max || strlen($line2) >=$sub_max) {
    $newtext = $line1." ".$line2;
    $newtext=str_replace("  "," ",$newtext);
    $newtext = wordwrap($newtext, $sub_max, "<br>");
    $t1=explode("<br>",$newtext);
    $line1=$t1[0];
    $line2=$t1[1];
 }
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
if (!file_exists($f))
   $ttxml .=$end."\n";
else
   $ttxml .="10000"."\n";
$ttxml .="10002"."\n";
$ttxml .="\n";
$ttxml .="\n";
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
}

print $movie;
//echo $ttxml;
?>
