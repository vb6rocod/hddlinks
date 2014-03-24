#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  //echo $html;
    //$t0 = explode('<iframe width="', $html);
    $t0=explode('loadIframe.defer',$html);
    //$t1 = explode('src="',$t0[1]);
    $t1=explode('src":"',$t0[1]);
    $t2 = explode('"', $t1[1]);
    $link1 = $t2[0];
    $link1=str_replace("\/","/",$link1);
    //echo $link1;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  $t1=explode("hd.file=",$html);
  $t2=explode("&",$t1[1]);
  $link2=urldecode($t2[0]);
  if (!$link2) {
    $t1=explode("file=",$html);
    $t2=explode("&",$t1[1]);
    $link2=urldecode($t2[0]);
  }
print $link2;
?>
