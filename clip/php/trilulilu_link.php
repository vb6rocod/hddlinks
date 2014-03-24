#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//$link="http://www.trilulilu.ro/alonewolf/0e5a2288cca024";
$link = $_GET["file"];
//http://fs69.trilulilu.ro/stream.php?type=video&source=site&hash=0e5a2288cca024&username=alonewolf&key=ministhebest&format=flv-vp6&start=
$h = file_get_contents($link);
$userid = str_between($h, 'userid":"', '"');
$hash = str_between($h, 'hash":"', '"');
$server = str_between($h, 'server":"', '"');
$link1="http://fs".$server.".trilulilu.ro/stream.php?type=video&amp;source=site&amp;hash=".$hash."&amp;username=".$userid."&amp;key=ministhebest";
$link = $link1."&amp;format=mp4-720p";
$AgetHeaders = @get_headers($link);
if (!preg_match("|200|", $AgetHeaders[0])) {
   $link = $link1."&amp;format=mp4-360p";
   $AgetHeaders = @get_headers($link);
   if (!preg_match("|200|", $AgetHeaders[0])) {
     $link = $link1."&amp;format=flv-vp6";
     $AgetHeaders = @get_headers($link);
     if (!preg_match("|200|", $AgetHeaders[0])) {
       $link="";
     }
   }
}
print $link;
?>
