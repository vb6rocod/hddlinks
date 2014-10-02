#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function search_arr($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search_arr($subarray, $key, $value));
        }
    }

    return $results;
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
   $id = urldecode($queryArr[0]);
   $pg_id = urldecode($queryArr[1]);
   $buf = $queryArr[1];
}
$l="http://www.seenow.ro/smarttv/placeholder/list/id/".$pg_id."/start/0/limit/999";
$h=file_get_contents($l);
$p=json_decode($h,1);
$items=$p['items'];
$items = array_values($items);
$willStartPlayingUrl = "http://www.seenow.ro/smarttv/historylist/add/id/".$id;
$h=json_encode(search_arr($items, 'willStartPlayingUrl', $willStartPlayingUrl));

$h=str_replace("\\","",$h);
$t1=explode('high quality stream name":"',$h);
$t2=explode('"',$t1[1]);
$str=$t2[0];
$t1=explode('token=',$h);
$t2=explode('|',$t1[1]);
$token=$t2[0];
$l1=str_between($h,'streamUrl":"','|');
$s=str_between($h,'indexUrl":"','"');
$h = file_get_contents($s);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms111.mediadirect.ro";
}
//$serv="fms11".mt_rand(2,3).".mediadirect.ro";
$app="live3";
//$buf="60000";
$rtmp="rtmp://".$serv."/".$app."/_definst_";
$l="Rtmp-options:-b ".$buf;
$l=$l." -a ".$app."/_definst_?&token=".$token." -W http://static1.mediadirect.ro/mediaplayer/players/0027/player.swf";
$l=$l." -p http://www.seenow.ro/ ";
$l=$l."-y ".$str;
$l=$l.",".$rtmp;
$l=str_replace(" ","%20",$l);
if ($token) print $l;
?>
