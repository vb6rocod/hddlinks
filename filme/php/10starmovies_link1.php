#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
$filelink = $_GET["file"];
$filelink=urldecode($filelink);
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
function cv($s) {
  $g=ord("g");
  $c=ord($s);
  if ($c < 58) {
    $c=$s;
  } else {
    $c=$c-$g + 16;
  }
return $c;
}
function vix($k,$char_rep,$pos_link,$h,$fn) {
  $f=explode("return p}",$h);
  $e=explode("'.split",$f[$k]);
  $ls=$e[0];
  preg_match("/(\|)((s|w)\d{2})\|/",$ls,$m);
  $server=$m[2];
  preg_match("/(\|)([a-z0-9]{45})\|/",$ls,$m);
  $hash=$m[2];
  preg_match("/(\|)(182|384|364)\|/",$ls,$m);
  $port=$m[2];
  preg_match("/(\|)(divxden|vidxden)\|/",$ls,$m);
  $serv_name=$m[2];
  $r="http://".$server.".".$serv_name.".com:".$port."/d/".$hash."/".$fn;
  return $r;
}
function get_unpack($k,$char_rep,$pos_link,$h) {
  $g=ord("g");
  $f=explode("return p}",$h);
  $e=explode("'.split",$f[$k]);
  $t=$e[0];
  $a=explode(";",$t);
  //print_r($a); //for debug only
  $w=explode("|",$a[$char_rep]); //char list for replace
  $t1=explode("'",$a[$pos_link]); // where is final link
  $fl= $t1[3];
  $s1=explode("/",$fl);
  $r="";
  for ($i=0;$i<strlen($fl)-1;$i++) {
      if (preg_match("/[A-Za-z0-9_]/",$fl[$i])) {
         $m=$w[cv($fl[$i])];
         if ($m=="") $m=$fl[$i];
         $r=$r.$m;
      } else {
        $r=$r.$fl[$i];
      }
  }
  return $r;
}
function rapidmov($string) {
  $h = file_get_contents($string);
  $g=ord("g");
  $f=explode("return p}",$h);
  $e=explode("'.split",$f[1]);
  $t=$e[0];
  $a=explode(";",$t);
  $w=explode("|",$a[9]);
  $t1=explode("'",$a[4]);
  $fl= $t1[3];
  $s1=explode("/",$fl);
  $r="";
  for ($i=0;$i<strlen($fl)-1;$i++) {
      if (preg_match("/[A-Za-z0-9_]/",$fl[$i])) {
         $r=$r.$w[cv($fl[$i])];
      } else {
        $r=$r.$fl[$i];
      }
  }
return $r;
}
function videobb($l) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $page = curl_exec($ch);
  curl_close($ch);
  preg_match_all('/\{"d":(false|true),"l":"([^"]+)","u":"([^"]+)"\}/i', $page, $st);
  $stream = array();
  for ($i = 0; $i < count($st[0]); $i++) {
    $stream[$st[2][$i]] = array(($st[1][$i] == "true" ? true : false), base64_decode($st[3][$i]));
  }
  if (count($stream) > 1) {
    foreach ($stream as $st => $da) {
      if ($da[0] == true) {
        $fl=$da[1];
      } else {
        $fl=$da[1]; // ?????
      }
    }
  } else {
    $qs = array_rand($stream);
    $fl = $stream[$qs][1];
  }
  return $fl;
}
function vk($string) {
  if (strpos($string,"video_ext.php") === false) {
	$h = file_get_contents($string);
	$t1=explode("nvar vars",$h);
	$l=$t1[1];
	$uid=str_between($l,'\"uid\":\"','\"');
	$host=str_between($l,'"host\":\"','\"');
	$host=str_replace("\\/","/",$host);
	$host=str_replace("\\/","/",$host);
	$host=str_replace("\/","/",$host);
	$vtag=str_between($l,'"vtag\":\"','\"');
	$r=$host."u".$uid."/video/".$vtag.".360.mp4";
 } else {
    $baza = file_get_contents($string);
    $host = str_between($baza,"var video_host = '","'");
    $uid = str_between($baza,"var video_uid = '","'");
    $vtag = str_between($baza,"var video_vtag = '","'");
    $hd = str_between($baza,"var video_max_hd = '","'");
    $r = $host."u".$uid."/video/".$vtag.".360.mp4";
    if ($hd == "0") {
      $r = $host."u".$uid."/video/".$vtag.".240.mp4";
    }
 }
  return $r;
}
function youtube($file) {
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {;
  $l ="http://www.youtube.com/watch?v=".$match[2];
  $r=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/yt.php?file=".$l);
}
return $r;
}
function flvz($string) {
if (strpos($string,"embed") === false) {
  $string=str_replace("video","embed",$string);
}
$h = file_get_contents($string);
$r = str_between($h,'"url": "','"');
return $r;
}
function putlocker($string) {
     $id=substr(strrchr($string,"/"),1);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $string);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     $h = curl_exec($ch);
     curl_close($ch);
     $t1=explode('form method="post"',$h);
     $t2=explode('value="',$t1[1]);
     $t3=explode('"',$t2[1]);
     $hash=$t3[0];
     $post="hash=".$hash."&confirm=Close+Ad+and+Watch+as+Free+User";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $string);
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $h = curl_exec($ch);
     curl_close($ch);
     if (strpos($string,"putlocker") !==false) {
        $url="http://www.putlocker.com/get_file.php?embed_stream=".$id;
     } elseif (strpos($string,"sockshare") !==false) {
        $url="http://www.sockshare.com/get_file.php?embed_stream=".$id;
     }
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $h = curl_exec($ch);
     curl_close($ch);
     $t1=explode('media:content url="',$h);
     $t2=explode('"',$t1[2]);
     $r = $t2[0];
     return $r;
}
function megavideo($string) {
  if (preg_match('/(v=)([A-Za-z0-9_]+)/', $string, $m)) {
    $id=$m[2];
  } elseif (preg_match('/(v\/)([A-Za-z0-9_]+)/', $string, $m)) {
    $file = get_headers($string);
 	foreach ($file as $key => $value) {
      if (strstr($value,"location")) {
        $url = ltrim($value,"location: ");
        $id = substr(strrchr($url, '='),1);
      } // end if
    } // end foreach
  } elseif (preg_match('/(d=)([A-Za-z0-9_]+)/', $string, $m)) {
    $h=file_get_contents($string);
    $id=str_between($h,'flashvars.v = "','"');
  }
  return $id;
}
function megavideo_premium($megavideo_id) {
        if ($MEGA_COOKIE <> "") {
        //Get megavideo original link download
        $link = "http://www.megavideo.com/xml/player_login.php?u=". $MEGA_COOKIE . "&v=" . $megavideo_id;
        $content = file_get_contents($link);
        //Check for premium account
        if( strstr($content, 'type="premium"') ) {
            //Get direct download link
            $downloadurl = strstr($content, "downloadurl=");
            $downloadurl = substr($downloadurl, 13, strpos($downloadurl,'" ')-13 );
            if($downloadurl) {
                $downloadurl = urldecode($downloadurl);
                $downloadurl = html_entity_decode($downloadurl);
                return $downloadurl ;
            }
        }
      }
}
//***************Here we start**************************************
$filelink=str_prep($filelink);
$h1=file_get_contents($filelink);
$t1=explode('href="',$h1);
$t2=explode('"',$t1[1]);
$filelink=$t2[0];
if ((strpos($filelink,"vidxden") !==false) || (strpos($filelink,"divxden") !==false)) {
  $fname=substr(strrchr($filelink,"/"),1);
  $fname=str_replace(".html","",$fname);
  $t=explode("/",$filelink);
  $id= $t[3];
     $post= "op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Continue+to+Video";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $filelink);
     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
     curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_REFERER, $filelink);
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $h = curl_exec($ch);
     curl_close($ch);
  if (strpos($h,"DivXBrowserPlugin") === false) {
     $link=get_unpack(1,11,5,$h);
  } else {
    $link=vix(1,12,9,$h,$fname);
  }
} elseif (strpos($filelink,"vidbux") !==false) {
  if (strpos($filelink,"embed") === false) {
    $t=explode("/",$filelink);
    $id= $t[3];
    $filelink=$t[0]."/".$t[1]."/".$t[2]."/"."embed-".$id."-width-653-height-362.html";
  }
  $h = file_get_contents($filelink);
  $link=get_unpack(1,8,4,$h);
} elseif (strpos($filelink,'movreel') !==false) {
  preg_match('/movreel\.com\/(embed\/)?+([\w\-]+)/', $filelink, $m);
  $id=$m[2];
  $filelink = "http://movreel.com/embed/".$id;
  $h = file_get_contents($filelink);
  $link=str_between($h,'<param name="src" value="','"');
} elseif (strpos($filelink,'videoweed') !==false) {
  if (strpos($filelink,"embed") !== false) {
    preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
    $id=$m[2];
    $s=explode("/",$filelink);
    $filelink="http://".$s[2]."/embed.php?v=".$id."&amp;width=900&amp;height=600";
  }
  $h = file_get_contents($filelink);
  $link = str_between($h,'file="','"');
} elseif (strpos($filelink,'novamov') !==false) {
  if (strpos($filelink,"embed") !== false) {
    preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
    $id=$m[2];
    $s=explode("/",$filelink);
    $filelink="http://".$s[2]."/embed.php?v=".$id."&amp;width=600&amp;height=480";
  }
  $h=file_get_contents($filelink);
  $file=str_between($h,'flashvars.file="','"');
  $filekey=str_between($h,'flashvars.filekey="','"');
  $l="http://www.novamov.com/api/player.api.php?user=undefined&file=".$file."&pass=undefined&key=".urlencode($filekey);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink, 'videobb.com') !== false) {
  $id=substr(strrchr($filelink,"/"),1);
  $l="http://www.sheepser.com/vb23.php?s1=".$id;
  $h=file_get_contents($l);
  $t1=explode('url="',$h);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  if (strpos($link,"videobb") === false) {
    $filelink="http://www.videobb.com/player_control/settings.php?v=".$id;
    $link=videobb($filelink);
  }
} elseif (strpos($filelink, 'videozer.com') !== false) {
  $id=substr(strrchr($filelink,"/"),1);
  $l="http://www.sheepser.com/vz23.php?s1=".$id;
  $h=file_get_contents($l);
  $t1=explode('url="',$h);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  if (strpos($link,"videozer") === false) {
    $filelink="http://www.videozer.com/player_control/settings.php?v=".$id;
    $link=videobb($filelink);
  }
} elseif ((strpos($filelink, 'vk.com') !== false) || (strpos($filelink, 'vkontakte.ru') !== false)) {
  $link=vk($filelink);
} elseif (strpos($filelink, 'movshare') !== false){
  preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
  $id=$m[2];
  if ($id == "") {
    $a=explode("?",$filelink);
    $rest = substr($a[0], 0, -1);
    $id= substr(strrchr($rest,"/"),1);
  }
  $filelink = "http://embed.movshare.net/embed.php?v=".$id;
  $baza = file_get_contents($filelink);
  $link = str_between($baza,'file="','"');
  if ($link == "") {
    $link=str_between($baza,'name="src" value="','"');
  }
} elseif (strpos($filelink, 'youtube') !== false){
  $link=youtube($filelink);
} elseif (strpos($filelink, 'flvz.com') !== false){
  $link=flvz($filelink);
} elseif (strpos($filelink, 'rapidmov.net') !== false){
  $link=rapidmov($filelink);
} elseif (strpos($filelink, 'putlocker.com') !== false){
  $link=putlocker($filelink);
} elseif (strpos($filelink, 'sockshare.com') !== false){
  $link=putlocker($filelink);
} elseif (strpos($filelink,'vimeo.com') !==false){
  //http://player.vimeo.com/video/16275866
  if (strpos($filelink,"player.vimeo.com") !==false) {
     $id=substr(strrchr($filelink,"/"),1);
     $link="http://127.0.0.1/cgi-bin/translate?stream,,http://vimeo.com/".$id;
  } else {
     $link="http://127.0.0.1/cgi-bin/translate?stream,,".$filelink;
  }
} elseif (strpos($filelink, 'megavideo.com') !== false) {
   $f="/usr/local/etc//usr/local/etc/dvdplayer/megavideo.dat";
   if (file_exists($f)) {
      $h=file_get_contents($f);
      $MEGA_COOKIE=trim($h);
   } else {
      $MEGA_COOKIE="";
   }
   $id=megavideo($filelink);
   if ($MEGA_COOKIE <> "") {
      $link=megavideo_premium($id);
   } else {
      $link="http://127.0.0.1/cgi-bin/scripts/php1/mv.cgi?v=".$id;
   }
}
print $link;
?>
