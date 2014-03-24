#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$query = $_GET["file"];
$queryArr = explode(',', $query);
$id = urldecode($queryArr[0]);
$page = urldecode($queryArr[1]);
$tip = urldecode($queryArr[2]);
$ttxml="";
exec ("rm -f /tmp/movie.dat");
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";
if ($tip=="0") //recente
  $link="http://videobox.iplay.ro/movies/cartoons/index/sort/created/dir/desc/page/".$page;
else if ($tip=="1") // top rating
  $link="http://videobox.iplay.ro/movies/cartoons/index/sort/rating/dir/desc/page/".$page;
else if ($tip=="2") //alfabetic
  $link="http://videobox.iplay.ro/movies/cartoons/index/sort/title/dir/asc/page/".$page;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
//$t=explode('id="movie/'.$id,$html);
//$img="http://videobox.iplay.ro".str_between($t[1],'src="','"');
$t=explode($id.".jpg",$html);
$find="/\/movie\/cover\/(.*)\/".$id.".jpg/i";
preg_match($find,$html,$m);
$img="http://static.videobox.iplay.ro".$m[0];
$tit=trim(str_between($t[1],'movieCellTitle">','<'));
$tit=str_replace("&#x27;","'",$tit);
$tit=str_replace("&nbsp;"," ",$tit);
$tit=str_replace("&raquo;",">>",$tit);
$tit=str_replace("&#xE9;","e",$tit);
$imdb="IMDB: ".trim(str_between($t[1],'movieCellRating">','<'));
$t2=explode('Genuri:',$t[1]);
$gen=str_between($t2[1],"<span>","</span>");
$gen = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$gen));
$gen="Gen: ".$gen;
$t3=explode("Descriere:",$t[1]);
$desc=trim(str_between($t3[1],"<span>","</span>"));
$desc=str_replace("&#x27;","'",$desc);
$desc=str_replace("&nbsp;"," ",$desc);
$desc=str_replace("&raquo;",">>",$desc);
$desc=str_replace("&#xE9;","e",$desc);
$desc = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$desc));
$ttxml .=$tit."\n"; //title
$ttxml .= "\n";     //an
$ttxml .=$img."\n"; //image
$ttxml .=$gen."\n"; //gen
$ttxml .="\n"; //regie
$ttxml .=$imdb."\n"; //imdb
$ttxml .="\n"; //actori
$ttxml .=$desc."\n"; //descriere
$new_file = "/tmp/movie.dat";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
?>

