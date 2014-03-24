#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$pass = $_GET["pass"];
$l="http://hdforall.uphero.com/reg.php?pass=".$pass;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Realtek');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
  $t1=explode("\n",$h);
  $post=trim($t1[0]);
print $post;
?>
