#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$host = 'http://'.$_SERVER['HTTP_HOST'];
$query = $_GET["file"];
$html = file_get_contents("http://www.nrj.fr/radio-510/webradios-nrj-513/webradio/");
$videos = explode('<div class="hit-thumb">', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
    $t1=explode("openRadio('",$video);
    $t2 = explode("'", $t1[1]);
    $link = trim($t2[0]);
    $t1 = explode('title="', $video);
    $t2 = explode('"', $t1[1]);
    $title = $t2[0];
    $title = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$title);
    $t1=explode('src="',$video);
    $t2=explode('"',$t1[1]);
    $image=$t2[0];
    if (($link == $query) && ($title <> "")) {
echo $image;
break;
}
}
?>
