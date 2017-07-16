#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
header('Content-type: video/mp4');
//header('Content-type: application/vnd.apple.mpegURL');
error_reporting(0);
set_time_limit(0);
$file = urldecode($_GET["file"]);
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {
  $id = $match[2];
  $l1 = "https://www.youtube.com/watch?v=".$id;
  //$html   = file_get_contents($link);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $html = curl_exec($ch);
  curl_close($ch);
  $html = str_between($html,'ytplayer.config = ',';ytplayer.load');
  $parts = json_decode($html,1);
$l=$parts['args']['hlsvp'];
$ua="Mozilla/5.0 (iPhone; CPU iPhone OS 5_0_1 like Mac OS X)";
//$l="https://5845e42425cc9.streamlock.net/live/rictv/playlist.m3u8";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function getSiteHost($siteLink) {
		// parse url and get different components
		$siteParts = parse_url($siteLink);
		$port=$siteParts['port'];
		if (!$port || $port==80)
          $port="";
        else
          $port=":".$port;
		// extract full host components and return host
		return $siteParts['scheme'].'://'.$siteParts['host'].$port;
}
$base1=str_replace(strrchr($l, "/"),"/",$l);
$base2=getSiteHost($l);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
//curl_setopt($ch, CURLOPT_HEADER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$h = curl_exec($ch);
curl_close($ch);
//echo $h."\n";
//die();
if (preg_match("/\.m3u8/",$h)) { // get secondary playlist)
$a1=explode("\n",$h);
for ($k=0;$k<count($a1);$k++) {
  if ($a1[$k][0] !="#" && $a1[$k]) $pl[]=trim($a1[$k]);
}
if ($pl[0][0] == "/")
  $base=$base2;
elseif (preg_match("/http(s)?:/",$pl[0]))
  $base="";
else
  $base=$base1;
//print_r ($pl);
// Rezolution
if (count($pl) > 1) {
  preg_match_all("/RESOLUTION\=(\d+)/i",$h,$m);
  //print_r ($m);
  $max_res=max($m[1]);
  //echo $max_res."\n";
  $arr_max=array_keys($m[1], $max_res);
  $key_max=$arr_max[0];
  //$key_max=0;
  $l=$base.$pl[$key_max];
} else {
  $l=$base.$pl[0];
}
} // end secondary playlist
$base1=str_replace(strrchr($l, "/"),"/",$l);
$base2=getSiteHost($l);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$h = curl_exec($ch);
curl_close($ch);
$base3="";
$x=explode("?",$l);
if ($x[1]) $base3="?".$x[1]; // antena play
$base3="";
$a1=explode("\n",$h);
for ($k=0;$k<count($a1);$k++) {
  if ($a1[$k][0] !="#" && $a1[$k]) $ts[]=trim($a1[$k]);
}
if ($ts[0][0] == "/")
  $base=$base2;
elseif (preg_match("/http(s)?:/",$ts[0]))
  $base="";
else
  $base=$base1;
// $l playlist with ts segments
// $base base url for ts
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$link = curl_init();
curl_setopt($link, CURLOPT_USERAGENT, $ua);
curl_setopt($link, CURLOPT_HEADER, false);
curl_setopt($link, CURLOPT_SSL_VERIFYPEER, false);
$l_ts=array();
$ts=array();
while (true) {
  $h = curl_exec($ch);
  if (!preg_match("/#EXTINF/i",$h)) break;
  $a1=explode("\n",$h);
  $l_ts=$ts;
  $ts=array();
  for ($k=0;$k<count($a1);$k++) {
      if ($a1[$k][0] !="#" && $a1[$k]) $ts[]=trim($a1[$k]);
  }
  $c=count($ts);
  for ($n=0;$n<$c;$n++) {
    if (!in_array($ts[$n], $l_ts)) {
      curl_setopt($link, CURLOPT_URL, $base.$ts[$n].$base3);
      curl_exec($link);
    }
  }
}
curl_close($ch);
curl_close($link);
?>
