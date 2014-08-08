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
$s="http://www.tastez.ro/tv.php?query=voyo&chn=".$link;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $s);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //curl_setopt($ch,CURLOPT_REFERER,"http://www.dolcetv.ro");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  $html=curl_exec($ch);
  curl_close($ch);
$conn1=str_between($html,"connectionArgs&quot;:[","]");
$conn1=str_replace("&quot;","",$conn1);
$t1=explode(",",$conn1);
//print_r($t1);
$c1=" -C O:1";
$c2=" -C NN:0:".$t1[0].".000000";
$c3=" -C NS:1:".$t1[1];
$c4=" -C NN:2:".$t1[2].".000000";
$c5=" -C NS:3:".$t1[3];
$c6=" -C O:0 ";

$rtmp=str_between($html,"host&quot;:&quot;","&quot;");
$w="http://voyo.ro/static/shared/app/flowplayer/13-flowplayer.cluster-3.2.1-01-004.swf";
$y="linear3?".str_between($html,"{0}?","&quot;");
$l="-b ".$buf;
$l="";
$exec=$l.' -q -v -x 15348 -w 2324d94075f150cad1ea0e09b5513924e7cc8b382656a1e38109e41237eb4373 ';
$exec=$exec.'-W "'.$w.'" ';
$exec=$exec.$c1.$c2.$c3.$c4.$c5.$c6;
$exec=$exec.'-y "'.$y.'" -r '.$rtmp;
//$exec=str_replace(" ","%20",$exec);
//echo $exec;

$out="#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /usr/local/etc/www/cgi-bin/scripts/rtmpdump ".$exec;
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/php/justin.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/php/justin.cgi");
sleep(1);

//$l="Rtmp-options:-b ".$buf;
//$l="Rtmp-options:";
//$l=$l." -W ".$w;
//$l=$l.$c1.$c2.$c3.$c4.$c5.$c6;
//$l=$l."-y ".$y;
//$l=$l.",".$rtmp;
//$l=str_replace(" ","%20",$l);
print $exec;

?>
