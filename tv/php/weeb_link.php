#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$ch=$_GET["file"];
$link=urldecode($ch);
$link = str_replace(' ','%20',$link);
$html=file_get_contents($link);
$t1=explode("cid=",$html);
$t2=explode('"',$t1[1]);
$link=$t2[0];
print $link;
?>
