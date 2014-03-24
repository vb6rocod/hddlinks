#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$noob=file_get_contents("/tmp/n.txt");
$cookie="/tmp/noobroom.txt";
$noob_serv="/tmp/noob_serv_load.log";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/index.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/login.php");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
  $h=str_between($h,"Select","</div");
  $out="";
  $videos = explode('href=', $h);
  unset($videos[0]);
  $videos = array_values($videos);
  foreach($videos as $video) {
    $t1=explode(">",$video);
    $t2=explode("<",$t1[4]);
    $serv=$t2[0];
    $t1=explode(">",$video);
    //print_r ($t1);
    $t2=explode("<",$t1[1]);
    $name_serv=$t2[0];
    $out=$out.$name_serv." ".$serv."\n";
  }
//echo $out;
$fh = fopen($noob_serv, 'w');
fwrite($fh, $out);
fclose($fh);
?>

