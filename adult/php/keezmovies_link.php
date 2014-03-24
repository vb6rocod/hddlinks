#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
//http://cdn1.public.keezmovies.phncdn.com/201203/28/757904/240p_337k_757904.mp4?sr=6000&int=614400b&nvb=20120419015923&nva=20120419035923&hash=0c1b6c5f0ba6a2380e24f
$link = $_GET["file"];
$html = file_get_contents($link);
$t1=explode('video_url=',$html);
$t2=explode('&',$t1[1]);
$link = urldecode($t2[0]);
print $link;
?>
