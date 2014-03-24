#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$filelink = $_GET["file"];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $filelink);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$html = curl_exec($ch);
curl_close($ch);
$t1=explode("Location:",$html);
$t2=explode("Referer",$t1[1]);
$link=trim($t2[0]);
$link=str_replace("feed:","http:",$link);
$link=$link."?format=xml";
print $link;
?>
