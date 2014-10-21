#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function enc($string) {
  $local3="";
  $arg1=strlen($string);
  $arg2="mediadirect";
  $l_arg2=strlen($arg2);
  $local4=0;
  while ($local4 < $arg1) {
    $m1=ord($string[$local4]);
    $m2=ord($arg2[$local4 % $l_arg2]);
    $local3=$local3.chr($m1 ^ $m2);
    $local4++;
  }
  return $local3;
}
//http://www.dolcetv.ro/tv-live-Mooz-RO-115?ajaxrequest=1
//$link = $_GET["file"];
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $buf = $queryArr[1];
}
$cookie="/tmp/tvrplus_show.dat";
if (!file_exists($cookie)) {
$l="http://www.tvrplus.ro/androidphone/show/";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
}
$id = substr(strrchr($link, "-"), 1);
//echo $id;
$link="http://www.tvrplus.ro/androidphone/show/editie/id/".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$html=str_replace("\\","",$html);
$t1=explode('high quality stream name":"',$html);
$t2=explode('"',$t1[1]);
$str=$t2[0];

$t1=explode('application name":"',$html);
$t2=explode('"',$t1[1]);
$app=$t2[0];
if (!$app) $app="live3";

$t1=explode('token-high":"',$html);
$t2=explode('"',$t1[1]);
$token=$t2[0];

$t1=explode('server port":',$html);
$t2=explode(',',$t1[1]);
$port=$t2[0];

$s="http://index.mediadirect.ro/getUrl?publisher=68";
$s="http://index.mediadirect.ro/getUrl?file=".$str."&app=seenow&inst=_definst_&publisher=68";
$h = file_get_contents($s);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms61.mediadirect.ro";
}
$l = "http://".$serv.":".$port."/".$app."/".$str."?user_id=0&transaction_id=0&device_id=0&publisher=68&p_item_id=".$id."&token=".$token;
if ($token) print $l;
?>
