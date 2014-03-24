#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
    $html = file_get_contents($link);
    $link = urldecode(str_between($html, 'file:"', '"'));
    if ($link=="") {
    $link=str_between($html,'"settings=','"');
    $html = file_get_contents($link);
    $link = str_between($html,"defaultVideo:",";");
    $link=urldecode($link);
    }
    //echo $link;
    if (strpos($link,"media2") === false) {
    $link=str_replace("http://:","http://media.myjizztube.com:8080",$link);
    $link=urldecode($link);
    $link=str_replace("&media.myjizztube.com&8080","",$link)."&start=0";
    } else {
    $link=str_replace("http://:","http://media2.myjizztube.com:8080",$link);
    $link=urldecode($link);
    $link=str_replace("&media2.myjizztube.com&8080","",$link)."&start=0";
    }
print $link;
?>
