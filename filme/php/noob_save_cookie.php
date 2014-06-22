#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$ff="/tmp/n.txt";
$cookie="/tmp/noobroom.txt";
$cookie_s="/usr/local/etc/dvdplayer/noob_save.txt";
  $handle = fopen($cookie, "r");
  $c = fread($handle, filesize($cookie));
  fclose($handle);
  $fh = fopen($cookie_s, 'w');
  fwrite($fh, $c);
  fclose($fh);
?>
