#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
$t1=explode(",",$link);
$link = $t1[0];
$k=str_between($link,"watch/","/");
$l="http://vplay.ro/watch/".$k."/";
//*************************
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $page = curl_exec($ch);
  curl_close($ch);

$l="http://www.vplay.ro/play/dinosaur.do";
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch,CURLOPT_REFERER,"http://i.vplay.ro/f/embed.swf?key=".$k);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $page = curl_exec($ch);
$link1=str_between($page,"nqURL=","&");
$subs = str_between($page,"[","]");
if (strpos($subs,'RO') !==false)
  $lang="RO";
else if (strpos($subs,'EN') !==false)
  $lang="EN";
else
  $lang="";
exec ("rm -f /tmp/test.xml");
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
if ($lang <> "") {
$post="onLoad=%5Btype%20Function%5D&sc=undefined&lang=".$lang."&key=".$k;
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
$ttxml ="";
$last_end=0;
$sub_max = 53;
$videos = explode('"s":"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode('"',$video);
 $line=$t1[0];
 $l=explode("<br>",$line);
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
 $t1=explode('"f":',$video);
 $t2=explode(",",$t1[1]);
 $begin=$t2[0];
 $t1=explode('"t":',$video);
 $t2=explode('}',$t1[1]);
 $end=$t2[0];
 if ($begin > $last_end)
 {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
 }
 $last_end=$end;
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
print $link1;
?>
