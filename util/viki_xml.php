#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
error_reporting(0);
exec ("rm -f /tmp/test.xml");
exec ("rm -f /tmp/dolce");
$id = $_GET["file"];
$l1="http://www.viki.com/player/medias/".$id."/info.json?rtmp=true&source=embed&embedding_uri=www.viki.com";
$html=file_get_contents($l1);
if (strpos($html,"rtmp") === false) {
$new_file="D://dolce.gz";
$new_file="/tmp/dolce.gz";
$fh = fopen($new_file, 'w');
fwrite($fh, $html);
fclose($fh);
$zd = gzopen($new_file, "r");
$html = gzread($zd, filesize($new_file));
gzclose($zd);
}
if (strpos($html,'"code":"ro"') !== false) $ro=1;
if (strpos($html,'"code":"en"') !== false) $en=1;
if ($ro) {
  $l2="http://www.viki.com/subtitles/media/".$id."/ro.json";
} else if ($en)  {
  $l2="http://www.viki.com/subtitles/media/".$id."/en.json";
}
if ($l2 <> "") {
$html=file_get_contents($l2);
if (strpos($html,"start_time") === false) {
$new_file="D://dolce.gz";
$new_file="/tmp/dolce.gz";
$fh = fopen($new_file, 'w');
fwrite($fh, $html);
fclose($fh);
//exec("/usr/local/etc/www/cgi-bin/scripts/gzip -d /tmp/dolce.gz");
exec("/usr/local/etc/www/cgi-bin/scripts/funzip /tmp/dolce.gz > /tmp/dolce");
sleep(1);
$html=file_get_contents("/tmp/dolce");
/*
$zd = gzopen($new_file, "r");
$html = gzread($zd, filesize($new_file));
gzclose($zd);
*/
}
$ttxml ="";
$last_end=0;
$videos = explode('content":"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('"start_time":',$video);
  $t2=explode(',',$t1[1]);
  $b1=trim($t2[0]);
  $t1=explode('"end_time":',$video);
  $t2=explode('}',$t1[1]);
  $d1=trim($t2[0]);
  $begin=round($b1/1000);
  $end=round($d1/1000);
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
  $t1=explode('"',$video);
  $line=trim($t1[0]);
  $line=str_replace("\n"," ",$line);
  $line=str_replace("&#xE3;","a",$line);
  $line=str_replace("&amp;quot;",'"',$line);
  $line=str_replace("\u0103","a",$line);
  $line=str_replace("\u00ee","i",$line);
  $line=str_replace("\u015f","s",$line);
  $line=str_replace("\u0163","t",$line);

  $t1=explode("<br>",$line);
  $line1=trim($t1[0]);
  $line2=trim($t1[1]);
  $line1 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line1);
  $line2 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line2);
  if ($line2=="")
  {
  $line2=$line1;
  $line1="";
  if (strlen($line2) > 45) {
    $newtext = wordwrap($line2, 45, "<br>");
    $t1=explode("<br>",$newtext);
    $line1=$t1[0];
    $line2=$t1[1];
  }
  }
  if ($end > 0 ) {
$ttxml .=$begin."\n";
$ttxml .=$end."\n";
$ttxml .=$line1."\n";
$ttxml .=$line2."\n";
  }
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
?>
