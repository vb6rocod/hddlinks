#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $html = curl_exec($ch);
  curl_close($ch);
  $t1=explode('property="og:video" content="',$html);
  $t2=explode('"',$t1[2]);
  $link=$t2[0];
  //$link=str_between($html,'property="og:video" content="','"');
//$link = "http://www.sensotv.ro/".str_between($html,"so.addVariable('data','","'");
//echo $link;
//$html = file_get_contents($link);
//echo $html;
//$link = str_between($html,'video="','"');
//$link=str_replace("https","http",$link);
print $link;
?>
