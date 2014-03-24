#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $server = $queryArr[1];
}
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$cookie="/tmp/futubox_c.txt";
//$cookie="D://futubox_c.txt";
$serv="s01";
$link=urldecode($link);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $sid = str_between($html,'url_key:encodeURIComponent("', '"');
  //$y=str_between($html,'setChannel("','"');
  $h1=explode("this.setChannel",$html);
  preg_match_all("/z\d{6}/",$h1[1],$m);
  $ch=$m[0];
  if ($ch[1]) {
  if ($server=="HD")
     $y=$ch[0];
  else
     $y=$ch[1];
  } else {
     $y=$ch[0];
  }
  $y=$y.".stream".$sid;
  $rtmp="rtmp://".$serv.".webport.tv:1935/live";
  $a="live".$sid;
  $w="http://futubox.to/donottouch/fpv3.39.swf";
  $p=$link;
/*
$exec = "rm -f /tmp/test.mp4";
$ret=exec($exec);
$exec = "rm -f /tmp/log.txt";
$ret=exec($exec);
$exec = "/usr/local/etc/www/cgi-bin/scripts/rtmpdump -V -v -B 0.1 -b 0 -r rtmp://s01.webport.tv:1935/live -a ".$a." -y ".$y." -W http://futubox.to/donottouch/fpv3.39.swf -p ".$p."  -o /tmp/test.mp4 2>/tmp/log.txt";
$ret=exec($exec,$a1);
$h=file_get_contents("/tmp/log.txt");
$t1=explode("NetStream.Play.PublishNotify",$h);
$t2=explode("rtmp://",$t1[1]);
$t3=explode(".",$t2[1]);
$trtmp="rtmp://".$t3[0].".futubox.com:1935";
//$t1=explode("redirect, STRING:",$h);
//$t2=explode("?",$t1[1]);
//$rtmp=trim($t2[0]);
*/
$l="Rtmp-options:-a ".$a." -W ".$w." -p ".$p." -y ".$y.",".$rtmp;
$l=str_replace(" ","%20",$l);
print $l;
?>
