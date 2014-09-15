#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function mylink($string){
$html = file_get_contents($string);
$l = str_between($html,'value=&quot;','&');
if ($l <> "") {
$file = get_headers($l);
 foreach ($file as $key => $value)
   {
    if (strstr($value,"Location"))
     {
      $url = ltrim($value,"Location: ");
      $link1 = str_between($url,"file=","&");
     } // end if
   } // end foreach
   if ($link1 <> "") {
   return $link1;
}
}
}
//http://assets.sport.ro/assets/protv/2012/07/27/videos/18872/varciu_beta.flv?start=0
//echo urldecode("http%3A%2F%2Fwww.protv.ro%2Fvideo-cop%2Fget-video%2Fvideo_id%2F18872%2Fvideo_player_div%2FminiPlayerVideo%2Fvideo_player%2Fcme%2Fplayer_dimension%2F600X338%2Fvideo_key%2Fhappy-hour%2Fkey_id%2F%2Farticle_category_url_identifier%2Fmultimedia");
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $image = $queryArr[1];
}
$h = file_get_contents("http://protvplus.ro".urldecode($link));
$serv = str_between($h,"rtmp:","'");
//$t1 = str_between($h,'$.ajax(','$f(');
$t1=explode("$.ajax({",$h);
$linkajax=str_between($t1[1],'url: "','"');
//$linkajax="/lbin/ajax/config1.php?site=94000&realSite=94000&subsite=753&section=20720&media=61288956&jsVar=fltfm&mute=0&size=&pWidth=700&pHeight=435";
$h = file_get_contents("http://protvplus.ro/".$linkajax);
$h = str_replace("\\","",$h);
//echo $h;
$id = str_between($h,'url":"','"');
//$id=str_replace("x","_HD",$id);
$title =  str_between($h,'title":"','"');
$y = $id."-HD-1.mp4";
$rtmp = "rtmp:".$serv."/";
     $w="http://d1.a4w.ro/tfm/flowplayer.commercial-3.2.15.swf";
     $p="http://protvplus.ro";
     //rtmp://vod.protv.ro/vod_all/
     $t1=explode("/",$rtmp);
     $a=$t1[3]."/";
     $l="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-W http://d1.a4w.ro/flowplayer/flowplayer.commercial-3.2.18.swf -p http://protvplus.ro -a ".$a;
     $l=$l." -y ".$y.",".$rtmp;
     $video=str_replace(" ","%20",$l);

print $video;

?>
