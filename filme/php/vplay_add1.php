#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
clearstatcache();
if (file_exists("/data"))
  $f= "/data/vplay.dat";
else
  $f="/usr/local/etc/vplay.dat";
if (file_exists($f)) {
   $dir = $f;
} else {
     $dir = "";
}
$query = $_GET["mod"];
if($query) {
   $queryArr = explode('*', $query);
   $mod = $queryArr[0];
   $link = $queryArr[1];
   $title = $queryArr[2];
}

if ($mod == "add") {
/*
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
  $ch = curl_init();
  $link1=urldecode($link);
  curl_setopt($ch, CURLOPT_URL, $link1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
$t1=explode('li class="crumb"',$h);
$t2=explode('href="',$t1[2]);
$t3=explode('"',$t2[1]);
$l1=$t3[0];
$t4=explode(">",$t2[1]);
$t5=explode("<",$t4[1]);
$title=$t5[0];
if (strpos($l1,"/c/") !== false)
 $link = "http://vplay.ro".$l1;
else
 $link="";
*/
if ($dir <> "") {
$html=file_get_contents($dir);
//if (strpos($html,$title) === false)
if (!preg_match("/".$title."/i",$html))
  $html=$html."<item><link>".$link."</link><title>".$title."</title></item>";
} else {
$dir = $f;
$html="<item><link>".$link."</link><title>".$title."</title></item>";
}
$exec = "rm -f ".$f;
if ($link) file_put_contents($dir,$html);
} else if ($mod="delete") {
if ($dir <> "") {
$html=file_get_contents($f);
$out="";
$videos=explode("<item>",$html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $l=str_between($video,"<link>","</link>");
  $t=str_between($video,"<title>","</title>");
  if ($l <> $link) {
    $out=$out."<item><link>".$l."</link><title>".$t."</title></item>";
  }
}
}
if ($out <> "") {
$exec = "rm -f ".$f;
file_put_contents($f,$out);
} else {
$exec = "rm -f ".$f;
}
}

