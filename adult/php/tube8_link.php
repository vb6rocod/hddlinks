#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
//http://cdn1.mobile.tube8.com/201305/02/11204471/240P_400K_11204471.mp4?sr=1200&int=614400b&nvb=20130514040644&nva=20130514060644&hash=065343c54aa2e69212638
//http://cdn1.public.tube8.com/201305/02/11204471/240P_400K_11204471.mp4?sr=3600&int=614400b&nvb=20130514044700&nva=20130514064700&hash=0957c37713cb60c265e24
//http://www.tube8.com/teen/teen-fuck-with-her-father-in-law/11204471/
//http://m.tube8.com/video/show/title/teen_fuck_with_her_father_in_law/id/11204471
//http://www.tube8.com/amateur/hidden-sex-caught-on-tape/11264051/
$t=explode("/",$link);
$a1=$t[4];
$a2=$t[5];
$link="http://m.tube8.com/video/show/title/".$a1."/id/".$a2;
//echo $link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html = curl_exec($ch);
  curl_close($ch);
$t1 = explode('background: url(', $html);
//echo $t1[1];
$t2 = explode('href="', $t1[1]);
$t3=explode('"',$t2[1]);
$link = urldecode($t3[0]);
print $link;
?>
