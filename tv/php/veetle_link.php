#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$ch=$_GET["file"];
$link="http://veetle.com/index.php/channel/ajaxStreamLocation/".$ch."/flash";
//{"success":true,"payload":"http:\/\/213.254.245.197\/flv\/4d456df518882"}
$html=file_get_contents($link);
$t1=explode("http",$html);
$t2=explode('"',$t1[1]);
$link="http".$t2[0];
$link=str_replace("\/","/",$link);
print $link;
?>
