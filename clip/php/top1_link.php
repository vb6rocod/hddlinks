#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://server80.top1.ro/filme/ionutsilviu/22239/film.flv
$link = $_GET["file"];
$html = file_get_contents($link);
$serv=str_between($html,'"nr_server", "','"');
$util=str_between($html,'utilizator0", "','"');
$id=str_between($html,'id_film0", "','"');
$link="http://server".$serv.".top1.ro/filme/".$util."/".$id."/film.flv";
print $link;
?>
