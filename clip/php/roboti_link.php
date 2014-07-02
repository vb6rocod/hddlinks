#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$link = $_GET["file"];
$link=urldecode($link);
//echo $link."<BR>";
$html = file_get_contents($link);
if(preg_match_all("/(\/\/.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
//print_r ($links);
}
$s="/youtube|player\.vimeo\.com/i";
for ($i=0;$i<count($links);$i++) {
  $cur_link="http:".$links[$i];
  //echo $cur_link."<BR>";
  if (strpos($cur_link,"player.vimeo.com") !== false) {
      if (strpos($cur_link,"?") !== false) {
      $id=str_between($cur_link,"video/","?");
      $cur_link="http://player.vimeo.com/video/".$id;
      }
      break;
  } else if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $cur_link)) {
     $link1=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/yt.php?file=".$cur_link);
     print $link1;
     break;
  }
}
if (strpos($cur_link,"player.vimeo.com") !== false) {
//$link= "http://127.0.0.1/cgi-bin/scripts/util/vimeo.cgi?stream,,".urlencode($cur_link);
  if (strpos($filelink,"player.vimeo.com") !==false) {
     $t1=explode("?",$filelink);
     $filelink=$t1[0];
     $t1=explode("/",$filelink);
     $id=$t1[4];
  } else {
     $t1=explode("/",$filelink);
     $id=$t1[3];
  }
  $cookie="/tmp/cookie.txt";
  $l="http://vimeo.com/".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $l1=str_between($html,'data-config-url="','"');
  $l1=str_replace("&amp;","&",$l1);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h1 = curl_exec($ch);
  curl_close($ch);
  //echo $h1;
  if (strpos($h1,'hd":') !== false) {
    $t1=explode('hd":',$h1);
    $link1=str_between($t1[1],'url":"','"');
  } else {
    $t1=explode('sd":',$h1);
    $link1=str_between($t1[1],'url":"','"');
  }
print $link1;
}
?> 
