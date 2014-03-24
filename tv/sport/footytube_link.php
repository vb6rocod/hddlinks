#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function str_prep($string){
  $string = str_replace(' ','%20',$string);
  $string = str_replace('[','%5B',$string);
  $string = str_replace(']','%5D',$string);
  $string = str_replace('%3A',':',$string);
  $string = str_replace('%2F','/',$string);
  $string = str_replace('#038;','',$string);
  $string = str_replace('&amp;','&',$string);
  return $string;
}
function youtube($file) {
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {;
  $l ="http://www.youtube.com/watch?v=".$match[2];
  $r=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/yt.php?file=".$l);
}
return $r;
}
$l = $_GET["file"];
$l=urldecode($l);
$l=str_prep($l);
$html = file_get_contents($l);
if(preg_match_all("/(http\b.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
}
$s="/youtube\.c|videa\.hu\/flvplayer|kiwi\.kz|sapo\.pt|dailymotion|dai\.ly|sporxtv\.com|cdn\.playwire\.com/i";
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
  if (preg_match($s,$cur_link)) {
   if ((strpos($cur_link, 'youtube.com/watch') !== false) || (strpos($cur_link,'youtube.com/embed') !== false)){
     //echo $cur_link;
     $link=youtube($cur_link);
   } elseif (strpos($cur_link,'kiwi.kz') !==false){
     $file = get_headers($cur_link);
     foreach ($file as $key => $value) {
       if (strstr($value,"Location")) {
         $link = urldecode(ltrim($value,"Location:"));
         $link = str_between($link,"file=","&");
       } // end if
     } // end foreach
  } elseif (strpos($cur_link,'videa.hu') !==false){
      preg_match('/(v=)([A-Za-z0-9_]+)/', $cur_link, $m);
      $id=$m[2];
      if ($id <> "") {
         $cur_link="http://videa.hu/videok/sport/".$id;
         $html = file_get_contents($cur_link);
         $id=str_between($html,"flvplayer.swf?f=",".0&");
         $link="http://videa.hu/static/video/".$id;
      } else {
         $html = file_get_contents($cur_link);
         $id=str_between($html,"flvplayer.swf?f=",".0&");
         $link="http://videa.hu/static/video/".$id;
      }
  } elseif (strpos($cur_link,'cdn.playwire.com') !==false){
     $t1=explode("config=",$cur_link);
     $cur_link=$t1[1];
     $html=file_get_contents($cur_link);
     $link=str_between($html,'src":"','"');
     $link="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream,,".$link;
  } elseif (strpos($cur_link,'videos.sapo.pt') !==false){
      //http://rd3.videos.sapo.pt/play?file=http://rd3.videos.sapo.pt/HMFMZuGlZ3DMa4Waupzq/mov/1
      if (strpos($cur_link,"file=") === false) {
      $v_id = substr(strrchr($cur_link, "/"), 1);
      $link = "http://rd3.videos.sapo.pt/".$v_id."/mov/1" ;
      } else {
      $t1=explode("file=",$cur_link);
      $link=$t1[1];
      }
  } elseif (strpos($cur_link,'sporxtv.com') !==false) {
      $html = file_get_contents($cur_link);
      $link = str_between($html,"file: '","'");
  } elseif ((strpos($cur_link, "dailymotion") !== false) || (strpos($cur_link, "dai.ly") !== false)){
  if (strpos($cur_link,"embed") !== false) {
    $h=file_get_contents($cur_link);
    //echo $h;
    $l=str_between($h,'stream_h264_url":"','"');
    $link=str_replace("\\","",$l);
  } else {
    $html = file_get_contents($cur_link);
    $h=urldecode($html);
    $link=urldecode(str_between($h,'video_url":"','"'));
    if (!$link) {
    $t1 = explode('sdURL', $html);
    $sd=urldecode($t1[1]);
    $t1=explode('"',$sd);
    $sd=$t1[2];
    $sd=str_replace("\\","",$sd);
    $n=explode("?",$sd);
    $nameSD=$n[0];
    $nameSD=substr(strrchr($nameSD,"/"),1);
    $t1 = explode('hqURL', $html);
    $hd=urldecode($t1[1]);
    $t1=explode('"',$hd);
    $hd=$t1[2];
    $hd=str_replace("\\","",$hd);
    $n=explode("?",$hd);
    $nameHD=$n[0];
    $nameHD=substr(strrchr($nameHD,"/"),1);
    if ($hd <> "") {
     $link = $hd;
    }
    if (($sd <> "") && ($hd=="")) {
     $link = $sd;
    }
    }
  }
}
}
}
print $link;
?>
