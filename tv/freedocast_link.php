#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
$queryArr = explode(',', $query);
$link = $queryArr[0];
$tit = urldecode($queryArr[1]);
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  //http://www.freedocast.com/MatureContent.aspx?redirect=http%3a%2f%2fwww.freedocast.com%2fexdtrimento
  //__VIEWSTATE=%2FwEPDwUKLTE5NTUxMDU0Nw9kFgJmD2QWAgIDD2QWAgIBD2QWBgIBDw8WAh4EVGV4dAW6ATxhIGhyZWY9ICdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJyBjbGFzcz0neF9icm9hZGNhc3RfYnV0JyA%2BPC9hPmRkAgMPDxYCHwAFqAE8YSBocmVmPSdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJz5SZWdpc3RlcjwvYT5kZAIFDw8WAh8ABakBPGEgICBocmVmPSdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJz5TaWduIEluPC9hPmRkZA%3D%3D&__EVENTVALIDATION=%2FwEWAgLaioXMAgL%2B7KS2Bw%3D%3D&=Search&ctl00%24freedocastCPHolder%24btn_Iagree=
  //__VIEWSTATE=%2FwEPDwUKLTE5NTUxMDU0Nw9kFgJmD2QWAgIDD2QWAgIBD2QWBgIBDw8WAh4EVGV4dAW6ATxhIGhyZWY9ICdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJyBjbGFzcz0neF9icm9hZGNhc3RfYnV0JyA%2BPC9hPmRkAgMPDxYCHwAFqAE8YSBocmVmPSdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJz5SZWdpc3RlcjwvYT5kZAIFDw8WAh8ABakBPGEgICBocmVmPSdodHRwOi8vd3d3LmZyZWVkb2Nhc3QuY29tL3JlZ2xvZ2luLmFzcHg%2FdXJsPWh0dHAlM2ElMmYlMmZ3d3cuZnJlZWRvY2FzdC5jb20lMmY0MDQuYXNweCUzZnJlZGlyZWN0JTNkaHR0cCUzYSUyZiUyZnd3dy5mcmVlZG9jYXN0LmNvbSUyZmV4ZHRyaW1lbnRvJz5TaWduIEluPC9hPmRkZA%3D%3D&=Search&ctl00%24freedocastCPHolder%24btn_Iagree=
  if (strpos($html,"MatureContent.aspx") !==false) {
  $t1=explode('id="__VIEWSTATE" value="',$html);
  $t2=explode('"',$t1[1]);
  $t3=explode('EVENTVALIDATION" value="',$html);
  $t4=explode('"',$t3[1]);
  $post="__VIEWSTATE=".urlencode($t2[0])."&__EVENTVALIDATION=".urlencode($t4[0])."&=Search&ctl00%24freedocastCPHolder%24btn_Iagree=";
  $link1="http://www.freedocast.com/MatureContent.aspx?redirect=".urlencode($link);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  }
  $a=str_between($html,'id="player" src="','"');
  if (strpos($a,"http") === false) {
  $link="http://www.freedocast.com/".$a;
  } else {
  $link=$a;
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  //stream: '
$t1=explode("stream: '",$html);
$t2=explode("'",$t1[2]);
$link1=$t2[0];
if ($link1=="") {
  $t1=explode("stream: '",$html);
  $t2=explode("'",$t1[1]);
  $link1=$t2[0];
}
if ($link1=="") {
 $s=str_between($html,"streamer=","&");
 $f=str_between($html,"file=","&");
 $rest = substr($s, -1);
 if ($rest == "/") {
 $link1=$s.$f;
 } else {
 $link1=$s."/".$f;
 }
}
if (strlen($link1) < 3) {
 $link1=str_between($html,"flashvars.Stream='","'");
}
print $link1;
?>
