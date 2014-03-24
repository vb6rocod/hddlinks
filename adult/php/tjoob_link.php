#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
    $html = file_get_contents("http://www.tjoob.com/emb.php?id=".$link);
    $h1 = str_between($html,"config.stream{","}");
    $url = trim(str_between($h1,"URL:",";"));
    $filekey = trim(str_between($h1,"fileKey:",";"));
    $h2 = str_between($html,"config.content{","}");
    $video = trim(str_between($h2,"video:",";"));
    $link = $url.$filekey.$video;
print $link;
?>
