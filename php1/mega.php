#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$id = $_GET["id"];
$post ="url=http://www.megavideo.com/?v=".$id;
if (function_exists('curl_init')) {
  $Curl_Session = curl_init('http://www.megavideonotimelimit.com/Streamer/');
  curl_setopt ($Curl_Session, CURLOPT_POST, 1);
  curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, $post);
  curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($Curl_Session, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS
  curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  $Rec_Data = curl_exec ($Curl_Session);
  curl_close ($Curl_Session);
} else {  // pseudo curl
  exec ("rm -f /tmp/mega.txt");
  $ua='"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ro; rv:1.9.1) Gecko/20090624 Firefox/3.5 GTB7.1"';
  $post='"'.$post.'"';
  $ref='"Referer: http://www.megavideonotimelimit.com/Streamer/"';
  $app='"Content-Type: application/x-www-form-urlencoded"';
  $exec = "/sbin/wget -q --header ".$ua." --header ".$ref." --header ".$app." --post-data ".$post." -O /tmp/mega.txt http://www.megavideonotimelimit.com/Streamer/";
  exec ($exec);
  $Rec_Data = file_get_contents("/tmp/mega.txt");
}
$url = urldecode(str_between($Rec_Data,'flashvars="file=','&'));
$url = str_replace("%2F","/",$url);
$url = str_replace("%3A",":",$url);
$url = str_replace("%3F","?",$url);
$url = str_replace("%3D","=",$url);
$link = str_replace("%26","&",$url);
print $link;
?>
