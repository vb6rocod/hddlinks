#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function sec2hms ($sec, $padHours = false)
  {
    $hms = "";
    $hours = intval(intval($sec) / 3600);
    $hms .= ($padHours)
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";
    $minutes = intval(($sec / 60) % 60);
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";
    $seconds = intval($sec % 60);
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
    $hms .= ",000";
    return $hms;
}
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/";
   $dir_log = "/tmp/usbmounts/sda1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/";
   $dir_log = "/tmp/usbmounts/sdb1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/";
   $dir_log = "/tmp/usbmounts/sdc1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/";
   $dir_log = "/tmp/usbmounts/sda2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/";
   $dir_log = "/tmp/usbmounts/sdb2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc2/download/";
   $dir = "/tmp/usbmounts/sdc2/download/log/";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/";
   $dir_log = "/tmp/hdd/root/log/";
} else {
     $dir = "";
     $dir_log = "";
}
$link = $_GET["file"];
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
$t1=explode(",",$link);
$link = $t1[0];
$name = urldecode($t1[1]).".srt";
$new_file = $dir.$name;
$k=str_between($link,"watch/","/");
$l="http://www.vplay.ro/play/dinosaur.do";
$l="http://vplus.ro/play/player_config.do";
$l="http://vplus.ro/play/dinosaur.do";
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
$post="onLoad=%5Btype%20Function%5D&key=".$k;
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
//Referer: http://i.vplus.ro//f/embed.swf?v=2.5&key=eey8skva
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch,CURLOPT_REFERER,"http://i.vplus.ro//f/embed.swf?v=2.5&key=".$k);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $page = curl_exec($ch);

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
$post="key=".$k;
$l="http://www.vplay.ro/play/subs.do";
$l="http://vplus.ro/play/subs.do";
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
  //echo $html;
  //$h=json_decode($html,true);
  //var_dump($h);
  //$html=dec($html);
  //echo $html;
  $html=str_replace("\\","",$html);
$n=1;
$ttxml = "";
$videos = explode('"s":"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode('"',$video);
 $line=$t1[0];
 $line=str_replace("u0163","þ",$line);
 $line=str_replace("u021B","þ",$line);
 $line=str_replace("u00e2","â",$line);
 $line=str_replace("u0103","ã",$line);
 $line=str_replace("u015f","º",$line);
 $line=str_replace("u0219","º",$line);
 $line=str_replace("u00ee","î",$line);

 $line=str_replace("u015e","ª",$line);
 $line=str_replace("u0218","ª",$line);
 $line=str_replace("u00ce","Î",$line);
 $line=str_replace("u0162","Þ",$line);
 $line=str_replace("u021A","Þ",$line);
 $line=str_replace("u0102","Ã",$line);
 $line=str_replace("u00C2","Â",$line);
 $line=str_replace("u00CE","Î",$line);
 $line=str_replace("<br>","\r\n",$line);
 $line = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$line));
 $t1=explode('"f":',$video);
 $t2=explode(",",$t1[1]);
 $begin=sec2hms($t2[0]);
 $t1=explode('"t":',$video);
 $t2=explode('}',$t1[1]);
 $end=sec2hms($t2[0]);
 $ttxml .=$n."\r\n".$begin." --> ".$end."\r\n".$line."\r\n"."\r\n";
 $n++;
}
if ($n > 2) {
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
}
print $link1;
?>
