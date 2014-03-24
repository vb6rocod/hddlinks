#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
$html = file_get_contents($link);
$t1=explode("var yt_url=",$html);
$t2=explode('input type="text',$t1[1]);
$t3=explode('value="',$t2[1]);
$t4=explode('"',$t3[1]);
$q=urlencode($t4[0]);
$q=str_replace("+","%20",$q);
$l1="http://gdata.youtube.com/feeds/api/videos?q=".$q."&format=5&max-results=1&v=2&alt=jsonc";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $l1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
      $h1 = curl_exec($ch);
      curl_close($ch);
//echo $h1;
$l2 = str_between($h1, 'player":{"default":"', '"');
if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $l2, $match)) {
$link1=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/yt.php?file=".urlencode($l2));
} else {
$link1="";
}
print $link1;
?>
