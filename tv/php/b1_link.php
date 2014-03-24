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
//rtmpdump -r "rtmpe://big02.mediadirect.ro:1935/recb1" -a "recb1?id=10668839" -f "WIN 10,2,152,32" -W "http://static1.mediadirect.ro/player-preload/swf/b1_1_1002/player.swf" -p "http://inregistrari.b1.ro/view-stiri_ora_14-101.html" -C O:1 -C O:0 -y "2012/02/29/mp4:ora_14_2012-02-29_14-00-00_low.mp4"
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $buf = $queryArr[1];
}
$link=urldecode($link);
$html = file_get_contents($link);
$t1=explode('flashvars.str="',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$link=enc($t1);
//http://index.mediadirect.ro/getUrl?file=2012/03/01/mp4:ora_8_2012-03-01_07-59-00_low.mp4&app=recb1&publisher=0
$l="http://index.mediadirect.ro/getUrl?file=".$link."&app=recb1&publisher=0";
$h = file_get_contents($l);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="big02.mediadirect.ro";
}
//2012/02/29/mp4:stiri_ora_18_2012-02-29_18-00-00_low.mp4
$rtmp="rtmpe://".$serv."/recb1";
$l="http://127.0.0.1/cgi-bin/scripts/util/translate2.cgi?stream,Rtmp-options:-b ".$buf;
$l=$l." -a recb1?id=10668839 -W http://static1.mediadirect.ro/player-preload/swf/b1_1_1002/player.swf";
$l=$l." -p http://inregistrari.b1.ro -C O:1 -C O:0 ";
$l=$l."-y ".$link;
$l=$l.",".$rtmp;
$l=str_replace(" ","%20",$l);
print $l;
?>
