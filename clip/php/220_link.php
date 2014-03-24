#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";
$link = $_GET["file"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.220.ro/video/");
  //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
//http://194.88.148.105/1f/66/f4/51/b95a6.bute_a_facut_show.mp4?c=a0eed61bd645e1793daec475a649e866

$t1 = explode('firstVideoURL=videoURL&videoURL=', $html);

$t2 = explode('&preview', $t1[3]);
$link1 = urldecode($t2[0]);
if (!$link1) {
$t2 = explode('&preview', $t1[1]);
$link1 = urldecode($t2[0]);
}
/*
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://st.220.t1.ro/_files/players/video/MPlayer_r53.swf");
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  $html = curl_exec($ch);
  curl_close($ch);
*/
/*
if (!preg_match("/replace_content/",$html)) {
$t2 = explode('&preview', $t1[1]);
$link1 = urldecode($t2[0]);
}
*/
  //echo $html;
/*
$h=get_headers($link2);
$l=$h[3];
$t1=explode("Location:",$l);
$link1=trim($t1[1]);
*/
print $link1;
?>
