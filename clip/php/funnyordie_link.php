#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$link=str_replace("videos","embed",$link);
$html = file_get_contents($link);
//$link1=str_between($html,"video_tag.attr('src', '","'");
$t1=explode('source src="',$html);
$t2=explode('"',$t1[2]);
$link1=$t2[0];
//if ($link1 == "") {
//$link1=str_between($html,'src: "','"');
//}
print $link1;
?>
