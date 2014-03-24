#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html=file_get_contents($link);
$t1=explode('id="psimg" src="',$html);
$t2=explode('"',$t1[2]);
//$url=str_between($html,'id="psimg" src="','"');
$url=$t2[0];
$post="sc2pu=".urlencode($url);
   $ch = curl_init("http://www.soccerclips.net/jwpgento.php");
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, "http://www.pink-unicorns.com/static/swf/player5.swf");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
$link=$url."&".$h;
print $link;
?>
