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
  if (strpos($cur_link,"player.vimeo.com") !==false) {
     $t1=explode("?",$cur_link);
     $filelink=$t1[0];
     $t1=explode("/",$cur_link);
     $id=$t1[4];
  } else {
     $t1=explode("/",$cur_link);
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
  $l1="http://player.vimeo.com/config/".$id."?type=moogaloop&referrer=vimeo.com&cdn_server=a.vimeocdn.com&player_server=player.vimeo.com&clip_id=".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h1 = curl_exec($ch);
  curl_close($ch);

  $sig_param=str_between($h1,'signature":"','"');
  $player_url=str_between($h1,'player_url":"','"');
  $time_param=str_between($h1,'"timestamp":',',');
  if (strpos($h1,'hd":0') !== false)
    $hd="sd";
  else
    $hd="hd";
  $stream_url="http://".$player_url."/play_redirect?clip_id=".$id."&sig=".$sig_param."&time=".$time_param."&quality=".$hd."&codecs=H264,VP8,VP6&type=moogaloop&embed_location=&seek=0";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $stream_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://a.vimeocdn.com/p/flash/moogaloop/5.2.49/moogaloop.swf?v=1.0.0");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_HEADER  ,1);
  $html = curl_exec($ch);
  curl_close($ch);
  $t1=explode("Location:",$html);
  $t2=explode("\n",$t1[1]);
  $link1=trim($t2[0]);
print $link1;
}
?> 
