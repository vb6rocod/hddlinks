#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$file = $_GET["file"];
$noob_log="/usr/local/etc/dvdplayer/noob_log.dat";
$exec="rm -f ".$file;
exec ($exec);
?>
