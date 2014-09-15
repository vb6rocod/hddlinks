#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$cookie="/tmp/cookie.txt";
    //$html = file_get_contents($link);
//$link=str_replace("www","touch",$link);
//$link="http://www.dailymotion.com/video/x25zfxd_does-size-matter-not-where-you-think_news";
//$link="http://touch.dailymotion.com/#/video/x24u7kf";
//echo $link;
$t1=explode("_",$link);
$link=$t1[0];
//echo $link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  //curl_setopt($ch,CURLOPT_REFERER,$search);
  //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
    $html= urldecode($html);
    //echo $html;
    $l1=urldecode(str_between($html,'video_url":"','"'));

    if (!$l1) {
    $l2=urldecode(str_between($html,'autoURL":"','"'));
    $l2=str_replace("\/","/",$l2);
    $h=file_get_contents($l2);

    //echo $h;
    $l1=str_between($h,'"template":"','"');

    $t1=explode('template":"',$h);
    $n=count($t1);
    $t2=explode("mnft",$t1[$n-1]);
    $l1=str_replace("\/","/",$t2[0])."flv";

    }
    //$l="http:\/\/www.dailymotion.com\/cdn\/manifest\/video\/x10mktb.mnft?auth=1373519236-aa7d608692b88ba128f72f5225a77bb0";
    //$l1=str_replace("\/","/",$l1);
    //echo $l;
    //echo $h;
    //$t1=explode("mnft",$l1);
    //$l1=$t1[0]."flv";
    //$l1=urlencode($l1);
    //$l1=str_replace("%3A",":",$l1);
    //$l1=str_replace("%2F","/",$l1);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $l1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
      $h1 = curl_exec($ch);
      curl_close($ch);

print $l1;
?>
