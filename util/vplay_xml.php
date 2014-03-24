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
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
$post="onLoad=%5Btype%20Function%5D&sc=undefined&lang=RO&key=".$file;
$l="http://www.vplay.ro/play/subs.do";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$ttxml ="<subtitrare>";
$last_end=0;
$videos = explode('"s":"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode('"',$video);
 $line=$t1[0];
 $line = str_replace("ª","S",$line);
 $line = str_replace("º","s",$line);
 $line = str_replace("Þ","T",$line);
 $line = str_replace("þ","t",$line);
 $l=explode("<br>",$line);
 $line1=$l[0];
 $line2=$l[1];
 $line1 = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$line1));
 $line2 = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$line2));
 if (strlen($line1) > 60) {
    $newtext = $line1.$line2;
    $newtext = wordwrap($newtext, 60, "<br>");
    $t1=explode("<br>",$newtext);
    $line1=$t1[0];
    $line2=$t1[1];
 }
 if ($line2=="")
 {
 $line2=$line1;
 $line1="";
 }
 $t1=explode('"f":',$video);
 $t2=explode(",",$t1[1]);
 $begin=$t2[0];
 $t1=explode('"t":',$video);
 $t2=explode('}',$t1[1]);
 $end=$t2[0];
 $f = "/usr/local/bin/home_menu";
 if (!file_exists($f)) {
 if ($begin > $last_end)
 {
   $ttxml .="<s>";
   $ttxml .="<t1>".$last_end."</t1>";
   $ttxml .="<t2>".$begin."</t2>";
   $ttxml .="<l1></l1>";
   $ttxml .="<l2></l2>";
   $ttxml .="</s>";
 }
 $last_end=$end;
 }
$ttxml .="<s>";
$ttxml .="<t1>".$begin."</t1>";
$ttxml .="<t2>".$end."</t2>";
$ttxml .="<l1>".$line1."</l1>";
$ttxml .="<l2>".$line2."</l2>";
$ttxml .="</s>";
}
//dummy sub
if ($end > 0) {
$ttxml .="<s>";
if (!file_exists($f))
   $ttxml .="<t1>".$end."</t1>";
else
   $ttxml .="<t1>10000</t1>";
$ttxml .="<t2>10002</t2>";
$ttxml .="<l1></l1>";
$ttxml .="<l2></l2>";
$ttxml .="</s>";
}
$ttxml .="</subtitrare>";
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
?>
