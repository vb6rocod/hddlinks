#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://m.hardsextube.com/video/453179
$link = $_GET["file"];
/*
$t=explode("/",$link);
$id=$t[4];
//$link="http://m.hardsextube.com/video/".$id;
$post="data=%7B%22type%22%3A%22playVideoLog%22%2C%22value%22%3A2433485%7D";
$post="data=%7B%22type%22%3A%22getVideoInnerAds%22%2C%22filter%22%3A%22straight%22%2C%22device%22%3A%22pc%22%7D";
echo urldecode($post);
$link1="http://www.hardsextube.com/api.php";
  $html = file_get_contents($link);
  $ch = curl_init($link1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $link);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17');
  $html = curl_exec($ch);
  curl_close($ch);
  echo $html;
$t1=explode("playVideoBtnWrap",$html);
$t2=explode('href="',$t1[1]);
$t3=explode('"',$t2[1]);
/*
$link=$t3[0];
/*
$id=str_between($html,'sharevidArgs: "','"');
$l1="http://vidii.hardsextube.com/video/".$id."/confige.xml";
$html = file_get_contents($l1);
//http://vidii.hardsextube.com/video/1055862/confige.xml
$l2=str_between($html,'FLV" Value="','"');
$l3=str_between($html,'FLVServer" Value="','"');
$link=$l3.$l2;
*/
//http://vs14.hardsextube.com/content/d2e8031848923fe0355c75067cf48948/5313357c/2013/11/21/2013-11-21-HardSexTube-FakeAgentUK_Inexperienced_ebony_amateur.mov.mp4?mp4mod=1&start=0
//http://vs14.hardsextube.com/content/f037BonA8cerN3a9d21dc1C7fcc187nBd8uCaa3aefeb0/531335c5/2013/11/21/2013-11-21-HardSexTube-FakeAgentUK_Inexperienced_ebony_amateur.mov.mp4?ZZhzfWd_pl_lml/pJlweXBzZpVzfmR_pl_mGV/ppxwfGdzaJZzgGZ_pl_mWh/
//$html=file_get_contents($link);
  $html = file_get_contents($link);
  $ch = curl_init($link);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17');
  $html = curl_exec($ch);
  curl_close($ch);
  //echo $html;
$server=str_between($html,'flvserver: "','"');
$file1=str_between($html,'flv: "/','"');
$t1=explode("?",$file1);
$file=$t1[0]."?mp4mod=1&start=0";
$link=$server."/".$file;
print $link;
?>
