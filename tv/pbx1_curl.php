#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query=$_GET["file"];
$queryArr = explode(',', $query);
$ch_cur = $queryArr[0];
$day = $queryArr[1];
$ch_cur = str_replace(" ","%20",$ch_cur);
$usr="/usr/local/etc/dvdplayer/pbx.dat";
$user=trim(file_get_contents($usr));
$user1=str_replace("|","%5E",$user);
$link="http://romania.smcmobile.ro/list@".$user1."%5E1024%5E001?";
$html=file_get_contents($link);
$ch_last="none";
$link="http://romania.smcmobile.ro/".$user."%5E".$ch_last."%5E".$ch_cur."%5E1024%5E@Random%5E".$day;
$html=trim(file_get_contents($link));
$t1=explode("mms",$html);
$t2=$t1[1];
if ($t2 <> "") {
  $link="http".$t2;
  $link=str_replace(" ","%20",$link);
print $link;
}
?>
