#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function rand_string( $length ) {
	$str = "";
	$characters = array_merge(range('a','f'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
 return $str;
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
function objectToArray($d) {

	if (is_object($d)) {
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	}
	else {
		return $d;
	}
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
exec ("rm -f /tmp/test.xml");
$cookie="/tmp/seenow.dat";
$filename="/usr/local/etc/dvdplayer/seenow_cont.dat";
if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a2=explode("|",$c);
  $a1=str_replace("?","@",$a2[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a2[1]);
if (!file_exists($cookie)) {
  $l="http://www.seenow.ro/login";
  $post="email=".$user."&password=".$pass."&submit=Login";
  //echo $post;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,$l);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
}
}
$p=array();
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $id = urldecode($queryArr[0]);
   $pg_id = urldecode($queryArr[1]);
   $buf = $queryArr[3];
   $title= urldecode($queryArr[2]);
}
//http://127.0.0.1/mobile/scripts/tv/tvrplus_e_link.php?file=96656&pg_id=3298&title=01+oct.+2014
//http://www.seenow.ro/smarttv/placeholder/list/id/
if ( is_numeric($id)) {
$l="http://www.seenow.ro/smarttv/placeholder/list/id/".$pg_id."/start/0/limit/999";
//$h=file_get_contents($l);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,"http://www.seenow.ro/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
//echo $h;
$t1=json_decode($h,1);
//print_r ($t1);
if ($t1) if (array_key_exists("items",$t1)) {
$items=$t1['items'];
//print_r ($items);
$items = array_values($items);

$willStartPlayingUrl = "http://www.seenow.ro/smarttv/historylist/add/id/".$id;
$h=search_arr($items, 'willStartPlayingUrl', $willStartPlayingUrl);
if (!$h) $h=search_arr($items, 'title', $title);
//echo $h[0];
//print $title;
//print_r ($h);
if (sizeof($h)>0 && $pg_id!=22) {
//$t2=file_get_contents($h[0]["playURL"]);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $h[0]["playURL"]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_REFERER,"http://www.seenow.ro/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $t2 = curl_exec($ch);
  curl_close($ch);


$h=json_decode($t2);
$p=objectToArray($h);
}  elseif ($pg_id==22) {
  $p=$h[0];
//echo $p;
}
}
if (array_key_exists("streamUrl",$p)) {
$l=$p["streamUrl"];
$t1=explode("token=",$l);
if (sizeof($t1)>1) {
$t2=explode('|',$t1[1]);
$token=$t2[0];
}
$t1=explode('|',$l);
$l=$t1[0];
}
if (!$p) {
$l="http://www.seenow.ro/smarttv/placeholder/view/id/".$id;
//$h=file_get_contents($l);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_REFERER,"http://www.seenow.ro/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);

$p=json_decode($h,1);
}
//print_r($p);
//die();
if ($p) if (array_key_exists("high quality stream name",$p)) {
$t1="";
if (array_key_exists("streamUrl",$p)) $t1=$p["streamUrl"];
if (!$t1) {
//$t2=file_get_contents($p["playURL"]);
if (array_key_exists("playURL",$p)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $p["playURL"]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_REFERER,"http://www.seenow.ro/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $t2 = curl_exec($ch);
  curl_close($ch);



$h=json_decode($t2);
$p=objectToArray($h);
}
}
$str_name=$p["high quality stream name"];
if (array_key_exists("streamUrl",$p)) {
$l=$p["streamUrl"];
$t1=explode("token=",$l);
if (sizeof($t1)>1) {
$t2=explode('|',$t1[1]);
$token=$t2[0];
}
$t1=explode('|',$l);
$l=$t1[0];
}
}
if (strpos($l,"radio") !== false) {
$audio=$p["audio stream name"];
$img=$p["thumbnail"];
}
if (!$token) {
$token=rand_string(48);
//print_r($token);
//$o=$p["other params"];
//$u=str_replace("&publisher=","&device_id=0&publisher=24",$o);
$u="user_id=0&transaction_id=0&p_item_id=".$id."&device_id=0&publisher=24";
if ($pg_id!=22) $l="http://[%server_name%]:1937/seenow/_definst_/mp4:".$str_name."/playlist.m3u8?".$u."&token=".$token;
//if (strpos($l,"radio") !== false) $l=str_replace("?user_id=0&p_item_id=","/playlist.m3u8?user_id=0&p_item_id=",$l);
}

if ($p) if (array_key_exists("subtitles",$p)) {
$t1=$p["subtitles"];
if (sizeof($t1) > 1) {
   $t2 = search_arr($t1, 'code', 'RO');
   $t3 = $t2[0];
   $sub=$t3["srt"];
}
else
   $sub = $t1;
if ($sub) {
   $t1 = '{"file": "'.$sub.'", "default": true}';
   $subtracks='"tracks": ['.$t1.']';
   }
}
//echo $sub;
if ($p) if (array_key_exists("indexUrl",$p)) $svr=$p["indexUrl"];
if ($svr) {
$h=file_get_contents($svr);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms60.mediadirect.ro";
}
}
//echo $l;
/*
$out=str_replace("[%server_name%]",$serv,$l);
$out=str_replace("playlist",$title,$out);
//$out=str_replace("|COMPONENT=HLS","",$out);
$out=str_replace("seenow-smart/_definst_/","seenow/_definst_/mp4:",$out);
*/
$out=str_replace("[%server_name%]",$serv,$l);
$out=str_replace("playlist",$title,$out);
$out=str_replace("seenow-smart/_definst_/","seenow/_definst_/mp4:",$out);
$t1=explode('?',$out);
$out=$t1[0]."?user_id=0&transaction_id=0&publisher=24&p_item_id=".$id."&token=".$token;
} else {
/**
$l="http://index.mediadirect.ro:80/getUrl?app=radio&file=".$id.".stream&publisher=17";
$h=file_get_contents($l);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0]; **/
$serv="178.21.120.26";
//rtmp://178.21.120.26:1935/radio/_definst_/r3n.stream
$out="rtmp://".$serv.":1935/radio/_definst_/".$id.".stream";
}
//$l=str_replace(" ","%20",$l);
if ($sub) {
   $x=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/xml_xml.php?file=".urlencode($sub));
}
if (strpos($out,"mp4") !== false && strpos($out,"radio") === false)
print $out;
elseif (strpos($out,"radio") === false) {
$app="live3";
$serv="fms11".mt_rand(2,3).".mediadirect.ro";
$rtmp="rtmp://".$serv."/".$app."/_definst_";
$rtmp="rtmpe://".$serv."/".$app."/_definst_?token=".$token;
$l="Rtmp-options:-b ".$buf;
$l=$l." -a ".$app."/_definst_?&token=".$token." -W http://static1.mediadirect.ro/mediaplayer/players/0027/player.swf";
$l=$l." -p http://www.seenow.ro/ ";
$l=$l."-y ".$str_name;
$l=$l.",".$rtmp;
$l="http://127.0.0.1/cgi-bin/scripts/util/translate2.cgi?stream,".str_replace(" ","%20",$l);
print $l;
} else {

$serv="178.21.120.26:1935";
$app="radio";
$rtmp="rtmp://".$serv."/".$app."/_definst_";
$l="Rtmp-options:-b ".$buf;
$l=$l." -a ".$app."/_definst_ -W http://static1.mediadirect.ro/mediaplayer/players/0027/player.swf";
$l=$l." -p http://www.seenow.ro/ ";
$l=$l."-y ".$audio;
$l=$l.",".$rtmp;
$l=$out;
//$l="http://127.0.0.1/cgi-bin/scripts/util/translate2.cgi?stream,".str_replace(" ","%20",$l);
print $l;
}
?>
