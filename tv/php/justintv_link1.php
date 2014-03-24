#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$id = $_GET["file"];
$link1="http://justin.tv/";
$link2="http://usher.justin.tv/find/".$id.".xml?type=any";
$h=file_get_contents($link1);
$swf=str_between($h,"new SWFObject('","'");
$h=file_get_contents($link2);
$token=trim(str_between($h,"<token>","</token>"));
$token=str_replace('"','\\"',$token);
$app=str_between($h,"<play>","</play>");
$con=str_between($h,"<connect>","</connect>");
$exec = '"'.$con."/".$app.'" --jtv "'.$token.'" --swfUrl "'.$swf.'"';
$exec1="/usr/local/etc/www/cgi-bin/scripts/rtmpdump -b 60000 -q -v -r ".$exec." > /dev/null &";
header ("Content-type: video/mp4");
exec($exec1);
exit();
?>
