#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//rtmp://ro.privesc.eu/storage/
$link = $_GET["file"];
//$html = file_get_contents($link);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17');

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $html = curl_exec($ch);
  curl_close($ch);
//echo $html;
$id=str_between($html,"widget/live/",'"');
$l="http://www.privesc.eu/api/live/".$id;
//echo $l;
$h=file_get_contents($l);
//echo $h;
$link_mp4=trim(str_between($h,'mp4":"','"'));
//$t1=explode("'file': '",$html);
//$t2=explode("'",$t1[1]);
//$y="mp4:".$t2[0];
$rtmp=str_between($html,"streamer': '","'");
//$rtmp="rtmp://ro.privesc.eu/storage/";
$opt="Rtmp-options:-W http://storage.privesc.eu/flashplayer/player.swf -p http://www.privesc.eu";
$opt=$opt." -y ".$y.",".$rtmp;
$opt=str_replace(" ","%20",$opt);
//print $opt;
print $link_mp4;
?>
