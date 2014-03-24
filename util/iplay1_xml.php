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
  $arg2="equinox2";
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
$query = $_GET["file"];

$queryArr = explode(',', $query);
$rtmp = $queryArr[0];
$y = urldecode($queryArr[1]); //
//mp4:hdd2\\the_lifeguard_2013_720.mp4?type=movie&id=913
//mp4:hdd2\the_lifeguard_2013_720.mp4?type=movie&id=913
$y=str_replace("\\\\\\\\","/",$y);
$y=str_replace("\/","/",$y);
$sub = $queryArr[2];
$buf = $queryArr[3];
$subtitle = $queryArr[4];
$h=file_get_contents($cookie);
$t1=explode("PHPSESSID",$h);
$sid=trim($t1[1]);
//rtmpdump -r "rtmp://84.247.81.148:1935/vod/_definst_" -a "vod/_definst_" -f "WIN 11,6,602,168" -W "http://videobox.iplay.ro/swf/CimPlayer.swf" -p "http://videobox.iplay.ro/series/details/id/70" -C S:eqejjaq53d9e75fqreig3rsq9rsk1pj6ubtoagnhgo1lg7u92nr0 -y "mp4:hdd/zero_hour/01/zero_hour_s01_e01_720.mp4?type=series&id=3565"
$movie="Rtmp-options:-v -b ".$buf." -C S:".$sid." -W http://videobox.iplay.ro/swf/CimPlayer.swf -p http://videobox.iplay.ro ";
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
$line=urlencode($line);
$line=str_replace("%C3%83%C2%A2","â",$line);
$line=str_replace("%C3%84%C2%83","ã",$line);
$line=str_replace("%C3%85%C2%A3","þ",$line);
$line=str_replace("%C3%83%C2%AE","î",$line);
$line=str_replace("%C3%85%C2%A2","ª",$line);
$line=str_replace("%C3%85%C2%9F","º",$line);
$line=str_replace("%C3%85%C2%9E","ª",$line);
$line=str_replace("%C3%83%C2%8E","Î",$line);
$line=str_replace("%C2%A2","â",$line);
$line=str_replace("%C4%83","ã",$line);
$line=str_replace("%C4%82","Ã",$line);
$line=urldecode($line);

$line=str_replace("Ä","a",$line);
$line=str_replace("A*?","t",$line);
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
if ($end > 0) {
 $ttxml .=$end."\n";
 $ttxml .="10002"."\n";
 $ttxml .="\n";
 $ttxml .="\n";
}
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
}

print $movie;
//echo $ttxml;
?>
