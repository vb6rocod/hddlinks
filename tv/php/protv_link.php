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
if (strpos($image,"web3.protv.ro") !== false) {
       $video=mylink($link);
print $video;
} elseif (strpos($image,"assets.sport.ro") !== false) {
   $h=file_get_contents($link);
   $link1=urldecode(str_between($h,'config=','"'));
   //echo $link1;
   $h1=file_get_contents($link1);
   if (strpos($h1,"rtmp") === false) {
     $video=str_between($h1,'url": "','"');
     if (!$video) {
       $video=str_between($h1,'var image_file = "','"');
       $video=str_replace("jpg","mp4",$video);
     }
   } else {
     //$y=str_between($h1,'url": "','"');
     $y="mp4:".str_between($h1,"vod#|#","#");
     //$rtmp=str_between($h1,'netConnectionUrl": "','"');
     $rtmp="rtmp://vod.protv.ro/vod_ro/";
     $w="http://d1.a4w.ro/tfm/flowplayer.commercial-3.2.15.swf";
     $p="http://www.protv.ro";
     //rtmp://vod.protv.ro/vod_all/
     $t1=explode("/",$rtmp);
     $a=$t1[3]."/";
     $l="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream,Rtmp-options:-W http://d1.a4w.ro/player/flowplayer.cluster-3.2.1.swf -p http://www.protv.ro -a ".$a;
     $l=$l." -y ".$y.",".$rtmp;
     $video=str_replace(" ","%20",$l);
   }
print $video;
}
?>
