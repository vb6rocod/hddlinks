#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
$html = file_get_contents($link);
$t1 = explode("'file','", $html);
$t2 = explode("'", $t1[1]);
$link = $t2[0];
print $link;
?>
