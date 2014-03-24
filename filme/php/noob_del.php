#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$noob_log="/usr/local/etc/dvdplayer/noob_log.dat";
$exec="rm -f /usr/local/etc/dvdplayer/noob_log.dat";
exec ($exec);
$exec="rm -f /tmp/noobroom.txt";
exec ($exec);
?>
