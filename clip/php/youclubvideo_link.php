#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link = str_replace(' ','%20',$link);
$link = str_replace('[','%5B',$link);
$link = str_replace(']','%5D',$link);
$html = file_get_contents($link);
$link=str_between($html,'url: "','"');
//$html='a href="http://video.ycv-servers.com/media/video/4000/217578.mp4" style="';
//preg_match("'@^(?:http://)?([^/]+)@i'",$html,$matches);
//print_r ($matches);
//$link= $matches[0];
//$html=str_replace("\\","",$html);
preg_match('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)\.mp4@',$html,$m);
//$link= $m[0];
print $link;
?>
