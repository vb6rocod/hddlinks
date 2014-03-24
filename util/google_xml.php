#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
error_reporting(0);
exec ("rm -f /tmp/test.xml");
$file = $_GET["file"];
$file=urldecode($file);
$html=file_get_contents($file);
$ttxml ="";
$last_end=0;
$videos = explode('<text', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('start="',$video);
  $t2=explode('"',$t1[1]);
  $b1=$t2[0];
  $t1=explode('dur="',$video);
  $t2=explode('"',$t1[1]);
  $d1=$t2[0];
  $begin=round($b1);
  $end=round($b1+$d1);
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
  $t1=explode(">",$video);
  $t2=explode("<",$t1[1]);
  $line=trim($t2[0]);
  $line=str_replace("\n"," ",$line);
  $line=str_replace("&#xE3;","a",$line);
  $line=str_replace("&amp;quot;",'"',$line);
  $newtext = wordwrap($line, 44, "<br>");
  $t1=explode("<br>",$newtext);
  $line1=$t1[0];
  $line2=$t1[1];
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
?>
