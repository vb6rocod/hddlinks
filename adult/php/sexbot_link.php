#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
//http://www.sexbot.com/getcdnurl/
//VideoFile_200158
//cacheBuster=1334807129187&jsonRequest=%7B%22path%22%3A%22VideoFile%5F200158%22%2C%22cb%22%3A%22022312%22%2C%22loaderUrl%22%3A%22http%3A%2F%2Fcdn1%2Estatic%2Eatlasfiles%2Ecom%2Fplayer%2Fmemberplayer%2Eswf%3Fcb%3D022312%22%2C%22returnType%22%3A%22json%22%2C%22file%22%3A%22VideoFile%5F200158%22%2C%22htmlHostDomain%22%3A%22www%2Esexbot%2Ecom%22%2C%22height%22%3A%22491%22%2C%22appdataurl%22%3A%22http%3A%2F%2Fwww%2Esexbot%2Ecom%2Fgetcdnurl%2F%22%2C%22playerOnly%22%3A%22true%22%2C%22request%22%3A%22getAllData%22%2C%22width%22%3A%22620%22%7D
    $html = file_get_contents($link);
    $link = str_between($html, "so.addVariable('file', '", "'");
echo $link;
?>
