#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
clearstatcache();
if (file_exists("/usr/local/etc/dvdplayer/thestreamDB.dat")) {
   $dir = "/usr/local/etc/dvdplayer/thestreamDB.dat";
} else {
     $dir = "";
}
$query = $_GET["mod"];
if($query) {
   $queryArr = explode('*', $query);
   $mod = $queryArr[0];
   $link = $queryArr[1];
   $title = $queryArr[2];
   $img = $queryArr[3];
}
if ($mod == "add") {
if ($dir <> "") {
$html=file_get_contents($dir);
$html=$html."<item><link>".$link."</link><title>".$title."</title><image>".$img."</image></item>";
} else {
$dir = "/usr/local/etc/dvdplayer/thestreamDB.dat";
$html="<item><link>".$link."</link><title>".$title."</title><image>".$img."</image></item>";
}
exec('rm -f  /usr/local/etc/dvdplayer/thestreamDB.dat');
file_put_contents($dir,$html);
} else if ($mod="delete") {
if ($dir <> "") {
$html=file_get_contents("/usr/local/etc/dvdplayer/thestreamDB.dat");
$out="";
$videos=explode("<item>",$html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $l=str_between($video,"<link>","</link>");
  $t=str_between($video,"<title>","</title>");
  $i=str_between($video,"<image>","</image>");
  if ($l <> $link) {
    $out=$out."<item><link>".$l."</link><title>".$t."</title><image>".$i."</image></item>";
  }
}
}
if ($out <> "") {
exec('rm -f  /usr/local/etc/dvdplayer/thestreamDB.dat');
file_put_contents("/usr/local/etc/dvdplayer/thestreamDB.dat",$out);
} else {
exec('rm -f  /usr/local/etc/dvdplayer/thestreamDB.dat');
}
}

