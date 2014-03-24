#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$id = $_GET["file"];
$noob=file_get_contents("/tmp/n.txt");
///?imdb.com/title/tt2084342"
//http://37.128.191.193/
//$html=file_get_contents("http://37.128.191.200/?".$id);
//$html=file_get_contents($noob."/?".$id);
$cookie="/tmp/noobroom.txt";
$l=$noob."/?".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t1=explode("?imdb.com",$html);
$t2=explode('"',$t1[1]);
if ($t2[0])
  $link="http://imdb.com".$t2[0];
else
  $link="http://imdb.com".str_between($html,'http://imdb.com','"');
//$link="http://www.imdb.com/title/tt2061712/";
//http://ia.media-imdb.com/images/M/MV5BMTkzMTUwMDAyMl5BMl5BanBnXkFtZTcwMDIwMTQ1OA@@._V1_SY317_CR1,0,214,317_.jpg
//$link="http://www.imdb.com/title/tt0903624/";
$html=file_get_contents($link);
$ttxml="";
exec ("rm -f /tmp/movie.dat");
$t1=explode('id="img_primary">',$html);
$t2=explode('src="',$t1[1]);
$t3=explode('"',$t2[1]);
$img=$t3[0];

$t1=explode('<h1 class="header"',$html);
$t2=explode('>',$t1[1]);
$t3=explode('<',$t2[1]);
$year=str_between($html,'span class="nobr">','</span');
$year=str_replace("(","",$year);
$year=str_replace(")","",$year);
$year=trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$year));
$year="Year: ".$year;
$tit=trim($t3[0]);
$tit=str_replace("&#x27;","'",$tit);
$tit=str_replace("&nbsp;"," ",$tit);
$tit=str_replace("&raquo;",">>",$tit);
$tit=str_replace("&#xE9;","e",$tit);
$tit=str_replace("&#xCE;","I",$tit);
$tit=str_replace("&#xEE;","i",$tit);
$tit=str_replace("&#xE2;","a",$tit);

$imdb="IMDB: ".trim(str_between($html,'span itemprop="ratingValue">','<'));
$gen1=str_between($html,'div class="infobar">','</div>');
$t1=explode('itemprop="duration"',$gen1);
$t2=explode('>',$t1[1]);
$t3=explode('<',$t2[1]);
$durata="Duration: ".trim($t3[0]);
$gen="Genre: ";
//$gen = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$gen));
$videos = explode('href="/genre', $gen1);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('itemprop="genre">',$video);
  $t2=explode("<",$t1[1]);
  $gen .=trim($t2[0])." | ";
}
$gen=substr($gen, 0, -2);
$gen = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$gen));
$gen=str_replace("&nbsp;","",$gen);
$gen=str_replace("\n","",$gen);
$gen=str_replace("\t","",$gen);
$gen=str_replace("  ","",$gen);
//$gen="Gen: ".$gen;
//echo $gen;
$desc=trim(str_between($html,'<p itemprop="description">',"</p>"));
$desc=str_replace("&#x27;","'",$desc);
$desc=str_replace("&nbsp;"," ",$desc);
$desc=str_replace("&raquo;",">>",$desc);
$desc=str_replace("&#xE9;","e",$desc);
$desc=str_replace("&#xCE;","I",$desc);
$desc=str_replace("&#xEE;","i",$desc);
$desc=str_replace("&#xE2;","a",$desc);
$desc = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$desc));
$ttxml .=$tit."\n"; //title
$ttxml .= $year."\n";     //an
$ttxml .=$img."\n"; //image
$ttxml .=$gen."\n"; //gen
$ttxml .=$durata."\n"; //regie
$ttxml .=$imdb."\n"; //imdb
$ttxml .="\n"; //actori
$ttxml .=$desc."\n"; //descriere
//echo $ttxml;
$new_file = "/tmp/movie.dat";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
?>

