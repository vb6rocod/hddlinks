#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$c="pidof rtmpdump";
$ret = exec($c);
if ($ret)
  print "downloading...";
else
  print "finish!";
?>
