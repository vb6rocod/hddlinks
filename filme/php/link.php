#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
$filelink = $_GET["file"];
$filelink=urldecode($filelink);
//echo $filelink;
if (strpos($filelink,"is.gd") !==false) {
 $a = @get_headers($filelink);
 //print_r ($a);
 $l=$a[6];
 $a1=explode("Location:",$l);
 $filelink=trim($a1[1]);
}
if (strpos($filelink,"adf.ly") !==false) {
 $h1=file_get_contents($filelink);
 $temp=$filelink;
 $filelink=str_between($h1,"var eu = '","'");
 if (!$filelink)
   $filelink=str_between($h1,"var zzz = '","'");
 if (!$filelink) {
  $filelink=str_between($h1,"var url = '","'");

  if (strpos($filelink,"adf.ly") === false)
    $filelink = "http://adf.ly".$filelink;
 $a = @get_headers($filelink);
 //print_r ($a);
 $l=$a[9];
 $a1=explode("Location:",$l);
 $filelink=trim($a1[1]);
 if (!$filelink)
  $filelink="http".str_between($h1,"self.location = 'http","'");
 }
}
if (strpos($filelink,"moovie.cc") !== false) {
 $a = @get_headers($filelink);
 $l=$a[10];
 $a1=explode("Location:",$l);
$filelink=trim($a1[1]);
}
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    $text= preg_replace('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    $text= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    return $text;
}
function kodik($html_source) {
$t1=explode("return p}(",$html_source);
$e=explode(".split",$t1[1]);
  $ls=$e[0];
  //echo $ls;
  $a=explode(",",$ls);
  //print_r($a); //for debug only
  $a1=explode("'",$a[count($a)-1]); //char list for replace
  $b1=explode("'",$a1[1]);
  $base_enc=$b1[1];
  //echo $base_enc;
  $w=explode("|",$b1[0]);
  //print_r ($w);
  $ch="0123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
  $ch="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $ch="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $fl="";
  for ($i=0;$i<count($a)-1;$i++) {
    $fl=$fl.$a[$i];
  }
  $r="";
  $x=strlen($fl);
  for ($i=0;$i<strlen($fl);$i++) {
    if (!preg_match('/[A-Za-z0-9]/',$fl[$i])) { //nu e alfanumeric
       $r=$r.$fl[$i];
    } elseif (($i<$x) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i+1]))) {
       $pos=strpos($ch,$fl[$i+1]);
       $pos=$base_enc*$fl[$i] + $pos;
       if ($w[$pos] <> "")
         $r=$r.$w[$pos];
       else
         $r=$r.$fl[$i].$fl[$i+1];
     } elseif (($i>0) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i-1]))) {
       // nothing
     } else {
       $pos=strpos($ch,$fl[$i]);
        if ($w[$pos] <> "")
          $r=$r.$w[$pos];
        else
          $r=$r.$fl[$i];
     }
  }
return $r;
}
function unpack_DivXBrowserPlugin($n_func,$html_cod,$sub=false) {
  $f=explode("return p}",$html_cod);
  $e=explode("'.split",$f[$n_func]);
  $ls=$e[0];
  //echo $ls;
  $a=explode(";",$ls);
  //print_r($a); //for debug only
  $a1=explode("'",$a[count($a)-1]); //char list for replace
  $b1=explode(",",$a1[1]);
  $base_enc=$b1[1];
  //echo $base_enc;
  $w=explode("|",$a1[2]);
  //print_r ($w);
  $ch="0123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
  $ch="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $ch="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $fl="";
  for ($i=0;$i<count($a)-1;$i++) {
    $fl=$fl.$a[$i];
  }
  $r="";
  $x=strlen($fl);
  for ($i=0;$i<strlen($fl);$i++) {
    if (!preg_match('/[A-Za-z0-9]/',$fl[$i])) { //nu e alfanumeric
       $r=$r.$fl[$i];
    } elseif (($i<$x) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i+1]))) {
       $pos=strpos($ch,$fl[$i+1]);
       $pos=$base_enc*$fl[$i] + $pos;
       if ($w[$pos] <> "")
         $r=$r.$w[$pos];
       else
         $r=$r.$fl[$i].$fl[$i+1];
     } elseif (($i>0) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i-1]))) {
       // nothing
     } else {
       $pos=strpos($ch,$fl[$i]);
        if ($w[$pos] <> "")
          $r=$r.$w[$pos];
        else
          $r=$r.$fl[$i];
     }
  }
  $r=str_replace("\\","",$r);
  //echo $r;
  $ret_val=str_between($r,'param name="src"value="','"');
  if ($ret_val == "")
    $ret_val = str_between($r,"file','","'");
  if ($ret_val == "")
    $ret_val = str_between($r,"playlist=","&");  //nosvideo
  if ($ret_val == "")
    $ret_val=str_between($r,'file:"','"');
  if ($sub==true) {
    $srt=str_between($r,"captions.file','","'");
    $srt = str_replace(" ","%20",$srt);
    $ret_val=$ret_val.",".$srt;
  }
  return $ret_val;
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
//peteava
function r() {
$i=mt_rand(4096,0xffff);
$j=mt_rand(4096,0xffff);
return  dechex($i).dechex($j);
}
function zeroFill($a,$b) {
    if ($a >= 0) {
        return bindec(decbin($a>>$b)); //simply right shift for positive number
    }
    $bin = decbin($a>>$b);
    $bin = substr($bin, $b); // zero fill on the left side
    $o = bindec($bin);
    return $o;
}
function crunch($arg1,$arg2) {
  $local4 = strlen($arg2);
  while ($local5 < $local4) {
   $local3 = ord(substr($arg2,$local5));
   $arg1=$arg1^$local3;
   $local3=$local3%32;
   $arg1 = ((($arg1 << $local3) & 0xFFFFFFFF) | zeroFill($arg1,(32 - $local3)));
   $local5++;
  }
  return $arg1;
}
function peteava($movie) {
  $seedfile=file_get_contents("http://content.peteava.ro/seed/seed.txt");
  $t1=explode("=",$seedfile);
  $seed=$t1[1];
  if ($seed == "") {
     return "";
  }
  $r=r();
  $s = hexdec($seed);
  $local3 = crunch($s,$movie);
  $local3 = crunch($local3,"0");
  $local3 = crunch($local3,$r);
  return strtolower(dechex($local3)).$r;
}
/** end peteava **/
function rapidmov($string) {
  //http://www1-45-37.rapidmov.net/cgi-bin/dl.cgi/xqawnjsw4l2yogppfwyu7nysssq6s62b7ee3v6crve/video.flv
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
//if (!preg_match_all('/\{"d":(false|true),"l":"([^"]+)","u":"([^"]+)"/i', $page, $st))
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
  //preg_match_all('/\{"d":(false|true),"l":"([^"]+)","u":"([^"]+)"\}/i', $page, $st);
  preg_match_all('/\{"d":(false|true),"l":"([^"]+)","u":"([^"]+)"/i', $page, $st);
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
//http://cs527520.userapi.com/u178356934/videos/94eb44cb8f.360.mp4
//http://cs533423.userapi.com/u164308929/video/a90195bdb0.360.mp4
function vk($string) {
  if (strpos($string,"video_ext.php") === false) {
  //echo $string;
	$h = file_get_contents($string);
	$t1=explode("nvar vars",$h);
	$l=$t1[1];
	$uid=str_between($l,'\"uid\":\"','\"');
	$host=str_between($l,'"host\":\"','\"');
	$host=str_replace("\\/","/",$host);
	$host=str_replace("\\/","/",$host);
	$host=str_replace("\/","/",$host);
	$vtag=str_between($l,'"vtag\":\"','\"');
	$r=$host."u".$uid."/videos/".$vtag.".360.mp4";
 } else {
    $baza = file_get_contents($string);
    //echo $string."<BR>";
    preg_match("/hd=\d{1}/",$string,$m);
    //print_r ($m);
    $host = str_between($baza,"var video_host = '","'");
    $uid = str_between($baza,"var video_uid = '","'");
    $vtag = str_between($baza,"var video_vtag = '","'");
    //$hd = str_between($baza,"var video_max_hd = '","'");
    $t1=explode("hd=",$m[0]);
    $hd=trim($t1[1]);
    //echo $hd;
    if ($hd == "0") {
      $r = $host."u".$uid."/videos/".$vtag.".240.mp4";
    } elseif ($hd=="3") {
      $r = $host."u".$uid."/videos/".$vtag.".720.mp4";
    } elseif ($hd=="2") {
      $r = $host."u".$uid."/videos/".$vtag.".480.mp4";
      $test = $host."u".$uid."/videos/".$vtag.".480.mp4";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $test);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 1);
      $h1 = curl_exec($ch);
      curl_close($ch);
      if (strpos($h1,"200 OK") === false)
       $r= $host."u".$uid."/videos/".$vtag.".360.mp4";
    } elseif ($hd=="1") {
      $r = $host."u".$uid."/videos/".$vtag.".360.mp4";
    } else {
      $r = $host."u".$uid."/videos/".$vtag.".360.mp4";
      $test = $host."u".$uid."/videos/".$vtag.".480.mp4";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $test);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 1);
      $h1 = curl_exec($ch);
      curl_close($ch);
      if (strpos($h1,"200 OK") !== false)
       $r=$test;
    }
 }
  return $r;
}
function youtube($file) {
if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $file, $match)) {
    $l ="http://www.youtube.com/watch?v=".$match[1];
    //echo $l;
    $r=file_get_contents("http://127.0.0.1/cgi-bin/scripts/util/yt.php?file=".urlencode($l));
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
     //http://www.putlocker.com/embed/067DF715716F10C5
     //http://www.putlocker.com/file/067DF715716F10C5
     $string=str_replace("file","embed",$string);
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
     $post="fuck_you=".$hash."&confirm=Close+Ad+and+Watch+as+Free+User";
     //echo $post;
     //hash=fe41ab2306be4d45&confirm=Close+Ad+and+Watch+as+Free+User
     //hash=0f44a928fe962fd2&confirm=Continue+as+Free+User
     //fuck_you=9ccabf34d9a6928e&confirm=Close+Ad+and+Watch+as+Free+User
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $string);
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $h = curl_exec($ch);
     curl_close($ch);
     $id=str_between($h,"playlist: '","'");
     //$url="http://www.putlocker.com/get_file.php?embed_stream=".$id;
     ///get_file.php?embed_stream=MDY3REY3MTU3MTZGMTBDNStlNTY1Y2EwNDcyZjYwZjUy
     if (strpos($string,"putlocker") !==false) {
       $url="http://www.putlocker.com".$id;
     } elseif (strpos($string,"sockshare") !== false) {
       $url="http://www.sockshare.com".$id;
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
function uploadc($string) {
$ch = curl_init($string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$h = curl_exec($ch);
$ipcount_val=str_between($h,'"ipcount_val" value="','"');
$id=str_between($h,'"id" value="','"');
$fname=str_between($h,'"fname" value="','"');
$post="ipcount_val=".$ipcount_val."&op=download2&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Slow+access";
//ipcount_val=10&op=download2&usr_login=&id=a2baprw26l3m&fname=np-prophezeiung-xvid.avi&referer=&method_free=Slow+access
//ipcount_val=10&op=download2&usr_login=&id=pia0ng8rrzqk&fname=om-die.geschichte.vom.goldenen.taler-xvid.avi&referer=&method_free=Slow+access
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
$h = curl_exec($ch);
$r=unpack_DivXBrowserPlugin(2,$h);
return $r;
}
//***************Here we start**************************************
$filelink=str_prep($filelink);
if ((strpos($filelink,"vidxden") !==false) || (strpos($filelink,"divxden") !==false)) {

  if (strpos($filelink,"embed") !== false) {
    //http://www.vidxden.com/embed-ob69210omp0y-width-653-height-362.html
    $t=explode("embed-",$filelink);
    $t1=explode("-",$t[1]);
    $id= $t1[0];
    $filelink="http://www.vidxden.com/".$id;
  }

   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" type="hidden" value="','"');
   $fname=str_between($h,'fname" type="hidden" value="','"');
   //$rand=str_between($h,'name="rand" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Continue+to+Video";
   //$post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //sleep(7);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,"vidbux") !==false) {
  /*
  if (strpos($filelink,"embed") === false) {
    $t=explode("/",$filelink);
    $id= $t[3];
    $filelink=$t[0]."/".$t[1]."/".$t[2]."/"."embed-".$id."-width-653-height-362.html";
  }
  echo $filelink;
  */
  //op=download1&usr_login=&id=9e889zt1l1ba&fname=Rush.Hour.3.2007i.flv&referer=&method_free=Continue+to+Video
  $ch = curl_init($filelink);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  $h = curl_exec($ch);
  $id=str_between($h,'"id" type="hidden" value="','"');
  $fname=str_between($h,'"fname" type="hidden" value="','"');
  $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Continue+to+Video";
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  $h = curl_exec($ch);
  curl_close($ch);
  $link=unpack_DivXBrowserPlugin(1,$h);
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
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'flashvars.filekey="','"');
  $l="http://www.videoweed.es/api/player.api.php?user=undefined&codes=undefined&pass=undefined&file=".$f."&key=".$k;
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,'novamov') !==false) {
  if (strpos($filelink,"embed") !== false) {
    preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
    $id=$m[2];
    $s=explode("/",$filelink);
    //http://embed.novamov.com/embed.php?width=728&height=400&v=yi18gc4a62gsu&px=1
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
    if (strpos($filelink,"?") !==false) {
    $a=explode("?",$filelink);
    $rest = substr($a[0], 0, -1);
    $id= substr(strrchr($rest,"/"),1);
    } else {
    $id = substr(strrchr($filelink,"/"),1);
    }
  }
  $filelink = "http://embed.movshare.net/embed.php?v=".$id;
  $baza = file_get_contents($filelink);
  $key=str_between($baza,'flashvars.filekey="','"');
  if ($key <> "") {
     $l="http://www.movshare.net/api/player.api.php?user=undefined&codes=undefined&key=";
     $l=$l.urlencode($key)."&pass=undefined&file=".$id;
     $b=file_get_contents($l);
     $link=str_between($b,"url=","&");
  } else {
  $link = str_between($baza,'file="','"');
  if ($link == "") {
    $link=str_between($baza,'name="src" value="','"');
  }
  if ($link == "") {
    $link=str_between($baza,'src" value="','"');
  }
  }
} elseif (strpos($filelink, 'youtu') !== false){
   //https://www.youtube-nocookie.com/embed/kfQTqjvaezM?rel=0
    $filelink=str_replace("https","http",$filelink);
    $filelink=str_replace("youtube-nocookie","youtube",$filelink);
    $link=youtube($filelink);
} elseif (strpos($filelink, 'flvz.com') !== false){
    $link=flvz($filelink);
} elseif (strpos($filelink, 'rapidmov.net') !== false){
  //$link=rapidmov($filelink);
  $h = file_get_contents($filelink);
  $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink, 'putlocker.com') !== false){
  $link=putlocker($filelink);
} elseif (strpos($filelink, 'sockshare.com') !== false){
  $link=putlocker($filelink);
} elseif (strpos($filelink, 'peteava.ro/embed') !== false) {
  preg_match('/(video\/)([A-Za-z0-9_]+)/', $filelink, $m);
  $id=$m[2];
  $filelink = "http://www.peteava.ro/embed/video/".$id;
  $h = file_get_contents($filelink);
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($h,"stream.php&file=","&");
  }
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    $link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    //$link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif (strpos($filelink, 'peteava.ro/id') !== false) {
  $h = file_get_contents($filelink);
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($h,"stream.php&file=","&");
  }
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    $link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    //$link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif (strpos($filelink, 'content.peteava.ro') !== false) {
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($filelink,"stream.php&file=","&");
  }
  $p=strpos($id,".");  //cinemaxx.ro
  $id1= substr($id,0, $p);
  $id2=substr($id,$p,4);
  $id= $id1.$id2;
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    $link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    //$link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif (strpos($filelink,'vimeo.com') !==false){
  //http://player.vimeo.com/video/16275866
  ///cgi-bin/translate?info,,http://vimeo.com/16275866
  if (strpos($filelink,"player.vimeo.com") !==false) {
     $t1=explode("?",$filelink);
     $filelink=$t1[0];
     $t1=explode("/",$filelink);
     $id=$t1[4];
  } else {
     $t1=explode("/",$filelink);
     $id=$t1[3];
  }
  $cookie="/tmp/cookie.txt";
  $l="https://vimeo.com/".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $html = curl_exec($ch);
  curl_close($ch);
  $l1=str_between($html,'data-config-url="','"');
  $l1=str_replace("&amp;","&",$l1);
  $l1=str_replace("https","http",$l1);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h1 = curl_exec($ch);
  curl_close($ch);
  //echo $h1;
  if (strpos($h1,'hd":') !== false) {
    $t1=explode('hd":',$h1);
    $link=str_between($t1[1],'url":"','"');
  } else {
    $t1=explode('sd":',$h1);
    $link=str_between($t1[1],'url":"','"');
  }
/*
  $l1="http://player.vimeo.com/config/".$id."?type=moogaloop&referrer=vimeo.com&cdn_server=a.vimeocdn.com&player_server=player.vimeo.com&clip_id=".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h1 = curl_exec($ch);
  curl_close($ch);

  $sig_param=str_between($h1,'signature":"','"');
  $player_url=str_between($h1,'player_url":"','"');
  $time_param=str_between($h1,'"timestamp":',',');
  if (strpos($h1,'hd":0') !== false)
    $hd="sd";
  else
    $hd="hd";
  $stream_url="http://".$player_url."/play_redirect?clip_id=".$id."&sig=".$sig_param."&time=".$time_param."&quality=".$hd."&codecs=H264,VP8,VP6&type=moogaloop&embed_location=&seek=0";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $stream_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://a.vimeocdn.com/p/flash/moogaloop/5.2.49/moogaloop.swf?v=1.0.0");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_HEADER  ,1);
  $html = curl_exec($ch);
  curl_close($ch);
  $t1=explode("Location:",$html);
  $t2=explode("\n",$t1[1]);
  $link=trim($t2[0]);
*/
} elseif (strpos($filelink, 'googleplayer.swf') !== false) {
  $t1 = explode("docid=", $filelink);
  $t2 = explode("&",$t1[1]);
  $link = "http://127.0.0.1/cgi-bin/translate?stream,,http://video.google.com/videoplay?docid=".$t2[0];
} elseif (strpos($filelink, 'filebox.ro/get_video') !== false) {
   $s = str_between($filelink,"videoserver",".");
   $f = str_between($filelink,"key=","&");
   $link = "http://static.filebox.ro/filme/".$s."/".$f.".flv";
} elseif (strpos($filelink, 'megavideo.com') !== false) {
   $link="http://127.0.0.1/cgi-bin/scripts/php1/mv.cgi?v=".megavideo($filelink);
} elseif (strpos($filelink, 'videobam.com/widget') !== false) {
   //http://videobam.com/widget/Xykqy/3"
   $h = file_get_contents($filelink);
   $link=str_between($h,',"url":"','"');
   $link=str_replace("\\","",$link);
} elseif (strpos($filelink, 'video.rol.ro') !== false) {
   //http://video.rol.ro/embed/js/55307.js
   //http://video.rol.ro/embed/iframe/56071
   //http://video.rol.ro/trollhunter-2010-www-onlinemoca-com-55307.htm
   if (strpos($filelink,"embed") !==false) {
     $r1 = substr(strrchr($filelink, "/"), 1);
     $l= "http://video.rol.ro/embed/js/".$r1.".js";
   } else {
     $r1 = substr(strrchr($filelink, "-"), 1);
     $r2=explode(".",$r1);
     $l= "http://video.rol.ro/embed/js/".$r2[0].".js";
   }
   $h = file_get_contents($l);
   $link=str_between($h,"file': '","'");
} elseif (strpos($filelink, 'divxstage.net') !== false) {
   //divxstage.net/video/canc73f7kgvbt
   $h = file_get_contents($filelink);
   $link=str_between($h,'param name="src" value="','"');
   if ($link == "") {
     $link=str_between($h,'addVariable("file","','"');
   }
} elseif (strpos($filelink, 'divxstage.eu') !== false) {
   //http://www.divxstage.eu/video/oisekelygcrnb
   //http://www.divxstage.eu/api/player.api.php?key=78%2E96%2E189%2E71%2D0158d8005886f55b17aa976b4b596404&user=undefined&codes=undefined&pass=undefined&file=0nm6yadbatt77
   $h = file_get_contents($filelink);
   $p1=str_between($h,'flashvars.filekey="','"');
   $p2=str_between($h,'flashvars.file="','"');
   if ($p1 == "") {
   $link=str_between($h,'param name="src" value="','"');
   if ($link == "") {
     $link=str_between($h,'addVariable("file","','"');
   }
   } else {
     $l1="http://www.divxstage.eu/api/player.api.php?key=".urlencode($p1)."&user=undefined&codes=undefined&pass=undefined&file=".$p2;
     $h = file_get_contents($l1);
     $link=str_between($h,"url=","&");
   }
} elseif ((strpos($filelink, 'fastupload.rol.ro') !== false)  || (strpos($filelink, 'fastupload.ro') !== false) || (strpos($filelink, 'superweb') !== false)) {
   $h = file_get_contents($filelink);
   $link=str_between($h,"file': '","'");
   $t1=explode("tracks':",$h);
   $t2=explode("'file': ",$t1[1]);
   $t3=explode('"',$t2[1]);
   $mysrt=$t3[1];
   $l_srt="http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file=".urlencode($mysrt);
   $h=file_get_contents($l_srt);
} elseif (strpos($filelink, 'zetshare.net') !== false) {
   $h = file_get_contents($filelink);
   $link=str_between($h,"'file', '","'");
} elseif (strpos($filelink, 'ufliq.com') !== false) {
  $h = file_get_contents($filelink);
  $link=str_between($h,"url: '","'");
  if ($link == "") {
    $link=unpack_DivXBrowserPlugin(1,$h);
  }
} elseif (strpos($filelink, 'stagero.eu') !== false) {
   //http://www.stagero.eu/api/player.api.php?codes=1&key=78%2E96%2E189%2E71%2D43400f4737713449ec249d9baf1e16f9&pass=undefined&user=undefined&file=pq34kgvq7gn26
   $h = file_get_contents($filelink);
   $p1=str_between($h,'flashvars.filekey="','"');
   $p2=str_between($h,'flashvars.file="','"');
   $l1="http://www.stagero.eu/api/player.api.php?codes=1&key=".urlencode($p1)."&pass=undefined&user=undefined&file=".$p2;
   $h = file_get_contents($l1);
   $link=str_between($h,"url=","&");
} elseif (strpos($filelink, 'mixturevideo.com') !== false) {
  $h = file_get_contents($filelink);
  $p1=str_between($h,"file=","&");
  $p2=str_between($h,"streamer=",'"');
  $link=$p2."&file=".$p1;
} elseif (strpos($filelink, 'ovfile.com') !== false) {
  if (strpos($filelink,"embed") === false) {
   $t1=explode("/",$filelink);
   $id=$t1[3];
   $filelink="http://ovfile.com/embed-".$id."-728x340.html";
  }
  $h = file_get_contents($filelink);
  $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'trilulilu') !== false) {
  $h = file_get_contents($filelink);
  if (strpos($filelink,"embed") === false) {
  $userid = str_between($h, 'userid":"', '"');
  $hash = str_between($h, 'hash":"', '"');
  $server = str_between($h, 'server":"', '"');
  } else {
  $userid = str_between($h, 'userid=', '&');
  $hash = str_between($h, 'hash=', '&');
  $server = str_between($h, 'server=', '"');
  }
  $link1="http://fs".$server.".trilulilu.ro/stream.php?type=video&amp;source=site&amp;hash=".$hash."&amp;username=".$userid."&amp;key=ministhebest";
  $link = $link1."&amp;format=mp4-720p";
  $AgetHeaders = @get_headers($link);
  if (!preg_match("|200|", $AgetHeaders[0])) {
   $link = $link1."&amp;format=mp4-360p";
   $AgetHeaders = @get_headers($link);
   if (!preg_match("|200|", $AgetHeaders[0])) {
     $link = $link1."&amp;format=flv-vp6";
     $AgetHeaders = @get_headers($link);
     if (!preg_match("|200|", $AgetHeaders[0])) {
       $link="";
     }
   }
  }
} elseif (strpos($filelink, 'filmedocumentare.com') !==false) {
   $h = file_get_contents($filelink);
   $link=trim(str_between($h,"<location>","</location>"));
} elseif (strpos($filelink, 'xvidstage.com') !== false) {
   //http://xvidstage.com/zwvh3et6vugo
   //http://xvidstage.com/embed-26kpbe5apbem.html
   if (strpos($filelink,"embed") !== false) {
    $h = file_get_contents($filelink);
   } else {
    $id = substr(strrchr($filelink, "/"), 1);
    $filelink = "http://xvidstage.com/embed-".$id.".html";
    $h = file_get_contents($filelink);
    }
    $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'viki.com') !==false) {
   //http://www.viki.com/player/1027154v
   preg_match('/(viki\.com\/player\/medias\/)([\w\-]+)/', $filelink, $match);
   $viki_id = $match[2];
   $l1="http://www.viki.com/player/medias/".$viki_id."/info.json?rtmp=true&source=embed&embedding_uri=www.viki.com";
   //echo $l1;
   $l1="http://www.viki.com/player/medias/1027154v/info.json?rtmp=true&source=embed&embedding_uri=www.viki.com";
   $h=file_get_contents($l1);
   //echo $h;
   if (strpos($h,"rtmp") === false) {
      $new_file="D://dolce.gz";
      $new_file="/tmp/dolce.gz";
      $fh = fopen($new_file, 'w');
      fwrite($fh, $html);
      fclose($fh);
      $zd = gzopen($new_file, "r");
      $h = gzread($zd, filesize($new_file));
      gzclose($zd);
  }
  $rtmp=str_between($h,'"uri":"','"');
  //rtmp://fms.354a.edgecastcdn.net/00354A/videos/encoded/Heartstrings/mp4:131448_Heartstrings_001_480p.mp4"
  $t1=explode("/",$rtmp);
  $y=$t1[7];
  $a=$t1[3]."/".$t1[4]."/".$t1[5]."/".$t1[6];
  $rtmp=$t1[0]."//".$t1[2]."/".$a;
  $link = "http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream,Rtmp-options:-a%20".$a."%20-y%20".$y."%20-W%20http://a3.vikiassets.com/swfs/vikiplayer.swf%20-p%20http://www.viki.com,".$rtmp;
} elseif (strpos($filelink, 'modovideo.com') !==false) {
  //http://www.modovideo.com/video.php?v=fx8jyb4o9g9yhl37xqnm7idchw67q7zb
  //http://www.modovideo.com/frame.php?v=fx8jyb4o9g9yhl37xqnm7idchw67q7zb
  //http://www.modovideo.com/video?v=xa8xysu73n6h2djewvhwsox2e736y0cb
  $t=explode("v=",$filelink);
  $id=$t[1];
  $filelink = "http://www.modovideo.com/frame.php?v=".$id;
  $h = file_get_contents($filelink);
  $link = str_between($h,"plugin.video=","&");
} elseif (strpos($filelink, 'roshare.info') !==false ) {
   //http://roshare.info/embedx-huwehn7cr7tx.html#
  //op=download2&id=g74g97qqkzz1&rand=nopnu7b7og43gtuzyh73eofno6odcr66cjkugrq&referer=&method_free=&method_premium=&down_direct=1
  $referer=$filelink;
  //$filelink=str_replace("rosharing.com","roshare.info",$filelink);
  if (strpos($filelink,"embed") !== false) {
   //http://roshare.info/embed-24nyrscgvuai-600x390.html
   $id=str_between($filelink,"embed-","-");;
   $filelink="http://roshare.info/".$id;
  }
  $cookie="/tmp/rosh.txt";
  $dat="/usr/local/etc/dvdplayer/roshare.dat";
  //http://roshare.info/embedx-1nm87mvkp84o.html#
   if (!file_exists($dat)) {
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $rand=str_between($h,'rand" value="','"');
   sleep(31);
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //echo $post;
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   curl_close ($ch);
   //echo $h;
   //$h=file_get_contents($filelink);
   //$link=unpack_DivXBrowserPlugin(2,$h);
   //$ret=unpack_DivXBrowserPlugin(2,$h,true);
   //$ret1=explode(",",$ret);
   //$link=$ret1[0];
   //$link="http://127.0.0.1/cgi-bin/scripts/util/wget.cgi?link=".$link.";referer=".$referer.";";
   //$mysrt=$ret1[1];
   $link=trim(str_between($h,'downlpl" href="','"'));
   $mysrt=trim(str_between($h,'downlsub1" href="','"'));
   } else {
   if (!file_exists($cookie)) {
    $handle = fopen($dat, "r");
    $c = fread($handle, filesize($dat));
    fclose($handle);
    $a=explode("|",$c);
    $a1=str_replace("?","@",$a[0]);
    $user=urlencode($a1);
    $user=str_replace("@","%40",$user);
    $pass=trim($a[1]);
    $post="op=login&redirect=http%3A%2F%2Froshare.info%2F&login=".$user."&password=".$pass;
    $l="http://roshare.info";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $l);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_REFERER, "http://roshare.info/login.html");
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    $h1 = curl_exec($ch);
    curl_close($ch);
   }
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $rand=str_between($h,'rand" value="','"');
   sleep(16);
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //echo $post;
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   curl_close ($ch);
   $link=trim(str_between($h,'downlpl" href="','"'));
   $mysrt=trim(str_between($h,'downlsub1" href="','"'));
   }
   $link=str_replace(" ","%20",$link);

$l="/usr/local/etc/dvdplayer/update.txt";
if (file_exists($l)) {
$h=file_get_contents($l);
$t=explode("\n",$h);
$player_tip=trim($t[0]);
} else {
$player_tip=0;
}
$f = "/usr/local/bin/home_menu";
if (file_exists($f) && $player_tip==0) {
  $out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl  -s "'.$link.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/util/m.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/util/m.cgi");
$link="http://127.0.0.1/cgi-bin/scripts/util/m.cgi?".mt_rand();
}
   $l_srt="http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file=".urlencode($mysrt);
   $h=file_get_contents($l_srt);
} elseif (strpos($filelink, 'rosharing') !==false ) {
   //http://roshare.info/embedx-huwehn7cr7tx.html#
  //op=download2&id=g74g97qqkzz1&rand=nopnu7b7og43gtuzyh73eofno6odcr66cjkugrq&referer=&method_free=&method_premium=&down_direct=1
  $referer=$filelink;
  //$filelink=str_replace("rosharing.com","roshare.info",$filelink);
  if (strpos($filelink,"embed") !== false) {
   //http://roshare.info/embed-24nyrscgvuai-600x390.html
   $id=str_between($filelink,"embed-","-");;
   $filelink="http://rosharing.com/".$id;
  }
  $cookie="/tmp/rosharing.txt";
  $dat="/usr/local/etc/dvdplayer/roshare.dat";
  //http://roshare.info/embedx-1nm87mvkp84o.html#
   if (!file_exists($dat)) {
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $rand=str_between($h,'rand" value="','"');
   sleep(31);
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //echo $post;
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   curl_close ($ch);
   //echo $h;
   //$h=file_get_contents($filelink);
   //$link=unpack_DivXBrowserPlugin(2,$h);
   //$ret=unpack_DivXBrowserPlugin(2,$h,true);
   //$ret1=explode(",",$ret);
   //$link=$ret1[0];
   //$link="http://127.0.0.1/cgi-bin/scripts/util/wget.cgi?link=".$link.";referer=".$referer.";";
   //$mysrt=$ret1[1];
   $link=trim(str_between($h,'downlpl" href="','"'));
   $mysrt=trim(str_between($h,'downlsub1" href="','"'));
   } else {
   if (!file_exists($cookie)) {
    $handle = fopen($dat, "r");
    $c = fread($handle, filesize($dat));
    fclose($handle);
    $a=explode("|",$c);
    $a1=str_replace("?","@",$a[0]);
    $user=urlencode($a1);
    $user=str_replace("@","%40",$user);
    $pass=trim($a[1]);
    $post="op=login&redirect=http%3A%2F%2Frosharing.com%2F&login=".$user."&password=".$pass;
    $l="http://rosharing.com";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $l);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_REFERER, "http://rosharing.com/login.html");
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    $h1 = curl_exec($ch);
    curl_close($ch);
   }
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $rand=str_between($h,'rand" value="','"');
   sleep(16);
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //echo $post;
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   curl_close ($ch);
   $link=trim(str_between($h,'downlpl" href="','"'));
   $mysrt=trim(str_between($h,'downlsub1" href="','"'));
   }
   $link=str_replace(" ","%20",$link);
$l="/usr/local/etc/dvdplayer/update.txt";
if (file_exists($l)) {
$h=file_get_contents($l);
$t=explode("\n",$h);
$player_tip=trim($t[0]);
} else {
$player_tip=0;
}
$f = "/usr/local/bin/home_menu";
if (file_exists($f) && $player_tip==0) {
  $out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl  -s "'.$link.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/util/m.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/util/m.cgi");
$link="http://127.0.0.1/cgi-bin/scripts/util/m.cgi?".mt_rand();
}
   $l_srt="http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file=".urlencode($mysrt);
   $h=file_get_contents($l_srt);
} elseif (strpos($filelink, 'filebox.com') !==false) {
  //http://www.filebox.com/embed-mxw6nxj1blfs-970x543.html
  //http://www.filebox.com/mxw6nxj1blfs
  if (strpos($filelink,"embed") === false) {
    $id=substr(strrchr($filelink,"/"),1);
    $filelink="http://www.filebox.com/embed-".$id."-970x543.html";
  }
  $h=file_get_contents($filelink);
  $link=str_between($h,"{url: '","'");
} elseif (strpos($filelink, 'zixshare.com') !==false) {
  //http://www.zixshare.com/files/Olsjbm1k1331045051.html
  $h=file_get_contents($filelink);
  $l=str_between($h,"goNewWin('","'");
  $h=file_get_contents($l);
  $t1=explode("clip: {",$h);
  $link=urldecode(str_between($t1[1],"url: '","'"));
} elseif (strpos($filelink,"glumbouploads.com") !== false) {
  $h=file_get_contents($filelink);
  $id=str_between($h,'"id" value="','"');
  $fname=str_between($h,'"fname" value="','"');
  $referer=str_between($h,'"referer" value="','"');
  $post="op=download1&usr_login=&id=".$id."&fname".$fname."&referer=".urlencode($referer)."&method_free=Slow+Download";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  $h = curl_exec($ch);
  curl_close($ch);
  $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'uploadc.com') !== false) {
   //http://www.uploadc.com/a2baprw26l3m/np-prophezeiung-xvid.avi.htm
   //http://www.uploadc.com/3yr7ppb79797/Rush.Hour.3.2007i.flv.htm
   //http://www.uploadc.com/embed-3yr7ppb79797.html
   if (strpos($filelink,".flv") !== false) {
     $t1=explode("/",$filelink);
     $id=$t1[3];
     $filelink="http://www.uploadc.com/embed-".$id.".html";
     $h=file_get_contents($filelink);
     $link=str_between($h,"addVariable('file','","'");
   } elseif (strpos($filelink,"embed") !== false) {
     $h=file_get_contents($filelink);
     $link=str_between($h,"addVariable('file','","'");
   } else {
   $link=uploadc($filelink);
   }
   $link=str_replace(" ","%20",$link);
} elseif (strpos($filelink,"nosvideo.com") !== false) {
   //http://nosvideo.com/?v=vl4w98yheol7
   $h=file_get_contents($filelink);
   $id=str_between($h,'name="id" value="','"');
   $referer=str_between($h,'referer" value="','"');
   $fname=str_between($h,'fname" value="','"');
   if ($fname) {
   $post="op=download1&id=".$id."&rand=&referer=".urlencode($referer)."&usr_login=&fname=".$fname."&method_free=&method_premium=&down_script=1&method_free=Continue+to+Video";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $filelink);
     //curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $h = curl_exec($ch);
     curl_close($ch);
   }
   //http://nosvideo.com/xml/tqpiilpwsfkbmb8v61280.xml
   $l1=unpack_DivXBrowserPlugin(1,$h);
   $h=file_get_contents($l1);
   $link=trim(str_between($h,"<file>","</file>"));
} elseif (strpos($filelink, 'sharefiles4u.com') !== false) {
   //http://www.sharefiles4u.com/cwfqw29ylesp/nrx-ausgewechselt.avi
   //http://stage666.net/cgi-bin/dl.cgi/kylgrtsmovb2rbldug23w3o45jkdpr23gv4cxbsdjq/video.avi
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   //op=download1&usr_login=&id=qbk4ipxvxfir&fname=mortal-legende.schlange.avi&referer=http%3A%2F%2Fwww.movie2k.to%2FDie-Legende-der-weissen-Schlange-online-film-1236209.html&method_free=Free+Download
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&method_free=Free+Download";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"uploadboost.com") !==false) {
  //op=download1&usr_login=&id=u9bzgynmlbyb&fname=John.Carter.2012.CAM.XviD.HUN-BEOWULF.flv&referer=http%3A%2F%2Fwww.moovie.cc%2Fonline-filmek%2Fjohn-carte-online-2012&method_free=Free+Download
   //http://www.uploadboost.com/u9bzgynmlbyb/John.Carter.2012.CAM.XviD.HUN-BEOWULF.flv
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&method_free=Free+Download";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,'nowvideo.eu') !==false) {
  //http://www.nowvideo.eu/video/t88lo38nphkhu
  //http://embed.nowvideo.eu/embed.php?v=t88lo38nphkhu
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'flashvars.filekey="','"');
  $l="http://www.nowvideo.eu/api/player.api.php?key=".urlencode($k)."&codes=1&pass=undefined&file=".$f."&user=undefined";
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,'nowvideo.eu') !==false) {
  //http://www.nowvideo.eu/video/t88lo38nphkhu
  //http://embed.nowvideo.eu/embed.php?v=t88lo38nphkhu
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'flashvars.filekey="','"');
  $l="http://www.nowvideo.eu/api/player.api.php?key=".urlencode($k)."&codes=1&pass=undefined&file=".$f."&user=undefined";
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,'nowvideo.co') !==false) {
  //http://www.nowvideo.co/video/a4n8bfgif6cou
  //http://www.nowvideo.co/api/player.api.php?cid=1&file=a4n8bfgif6cou&pass=undefined&key=78%2E96%2E189%2E71%2D1e5529be1f9ecd8d5ff01ce3583a43dd&user=undefined&cid2=undefined&cid3=undefined&numOfErrors=0
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'var fkzd="','"');
  $l="http://www.nowvideo.co/api/player.api.php?cid=1&file=".$f."&pass=undefined&key=".urlencode($k)."&user=undefined&cid2=undefined&cid3=undefined&numOfErrors=0";
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,"vreer.com") !==false) {
   //http://vreer.com/q1kqxyhutswf
   //op=download1&usr_login=&id=q1kqxyhutswf&fname=_Dark.Tide.2012.HDRiP.AC3-5.1.XviD-SiC.avi&referer=http%3A%2F%2Fwww.movie2k.to%2FDark-Tide-watch-movie-1235718.html&hash=iqjrsjrwkl5ie4h2w35cp7znbuemna3r&method_free=Free+Download
   if (strpos($filelink,"embed") !==false) {
     $id=str_between($filelink,"embed-","-");
     $h=file_get_contents($filelink);
     //$filelink= "http://vreer.com/".$id;
     $link=str_between($h,'file: "','"');
   } else {
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   $hash=str_between($h,'hash" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&hash=".$hash."&method_free=Free+Download";
   sleep(10);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=str_between($h,'file: "','"');
   }
} elseif (strpos($filelink,"180upload.com") !==false) {
  //http://180upload.com/embed-iyoqowagoivm-728x360.html
  //http://180upload.com/iyoqowagoivm
  //op=download2&id=iyoqowagoivm&rand=ae62ucsw5oduor27myoerr7ggt65omxrjujcqby&referer=http%3A%2F%2Fhqkings.com%2F2012%2Fred-lights-2012-bluray-720p-700mb%2F&method_free=&method_premium=&down_direct=1
  if (strpos($filelink,"embed") !== false) {
   $h=file_get_contents($filelink);
  } else {
     $t1=explode("/",$filelink);
     $id=$t1[3];
     $filelink="http://180upload.com/embed-".$id."-728x360.html";
     $h=file_get_contents($filelink);
  }
  $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"4shared.com") !==false) {
  //http://www.4shared.com/embed/1614172549/858b64a9
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_REFERER, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_HEADER  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookie.txt');
  $page = curl_exec($ch);
  curl_close($ch);
  //nu merge.....
} elseif (strpos($filelink,"dailymotion.com") !==false) {
  if (strpos($filelink,"embed") !== false) {
    $h=file_get_contents($filelink);
    //echo $h;
    $l=str_between($h,'stream_h264_url":"','"');
    $link=str_replace("\\","",$l);
  } else {
    $html = file_get_contents($filelink);
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
} elseif (strpos($filelink, 'vidbull.com') !== false) {
   //http://vidbull.com/4oasotfxmxb3.html
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   //$fname=str_between($h,'"fname" value="','"');
   $rand=str_between($h,'name="rand" value="','"');
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   sleep(7);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,'videos.sapo.pt') !==false){
      //http://rd3.videos.sapo.pt/play?file=http://rd3.videos.sapo.pt/HMFMZuGlZ3DMa4Waupzq/mov/1
      if (strpos($filelink,"file=") === false) {
      $v_id = substr(strrchr($filelink, "/"), 1);
      $link = "http://rd3.videos.sapo.pt/".$v_id."/mov/1" ;
      } else {
      $t1=explode("file=",$filelink);
      $link=$t1[1];
      }
} elseif (strpos($filelink,'sporxtv.com') !==false) {
      $html = file_get_contents($filelink);
      $link = str_between($html,"file: '","'");
} elseif (strpos($filelink,'videakid.hu') !==false){
      preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
      $id=$m[2];
      //http://videakid.hu/flvplayer_get_video_xml.php?v=UybVGzBIdoaQEtos&start=0&enablesnapshot=0&r=668048
      $l1="http://videakid.hu/flvplayer_get_video_xml.php?v=".$id."&m=0";
      $h1=file_get_contents($l1);
      $link=str_between($h1,'video_url="','"');
} elseif (strpos($filelink,'videa.hu') !==false){
      preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
      $id=$m[2];
      $l1="http://videa.hu/flvplayer_get_video_xml.php?v=".$id."&m=0";
      $h1=file_get_contents($l1);
      $link=str_between($h1,'video_url="','"');
      /*
      if ($id <> "") {
         $filelink="http://videa.hu/videok/sport/".$id;
         $html = file_get_contents($cur_link);
         $id=str_between($html,"flvplayer.swf?f=",".0&");
         $link="http://videa.hu/static/video/".$id;
      } else {
         $html = file_get_contents($filelink);
         $id=str_between($html,"flvplayer.swf?f=",".0&");
         $link="http://videa.hu/static/video/".$id;
      }
      */
} elseif (strpos($filelink,"purevid.com") !==false) {
   //http://www.purevid.com/v/881OPvv332wmou24943/
   //http://www.purevid.com/?m=embed&id=881OPvv332wmou24943
  if(preg_match('/(v\/|\?v=|id=)([\w\-]+)/', $filelink, $match))
   $id = $match[2];
   //http://www.purevid.com/?m=video_info_embed_flv&id=881OPvv332wmou24943
   $filelink="http://www.purevid.com/?m=video_info_embed_flv&id=".$id;
   $h=file_get_contents($filelink);
   $link=str_between($h,'"url":"','"');
   $link=str_replace("\\","",$link);
} elseif (strpos($filelink, 'videobam.com') !== false) {
   //http://videobam.com/widget/Xykqy/3"
   //http://videobam.com/Uogry
   $h = file_get_contents($filelink);
   $link=str_between($h,',"url":"','"');
   $link=str_replace("\\","",$link);
} elseif (strpos($filelink,"streamcloud.eu") !==false) {
   //op=download1&usr_login=&id=zo88qnclmj5z&fname=666_-_Best_Of_Piss_Nr_2_German.avi&referer=http%3A%2F%2Fstreamcloud.eu%2Fzo88qnclmj5z%2F666_-_Best_Of_Piss_Nr_2_German.avi.html&hash=&imhuman=Weiter+zum+Video
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   $hash=str_between($h,'hash" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&hash=".$hash."&imhuman=Weiter+zum+Video";
   sleep(11);
   //echo $post;
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   //echo $h;
   $link=str_between($h,'file: "','"');
   //file: "
} elseif (strpos($filelink, 'donevideo.com') !== false) {
   //http://www.donevideo.com/egs3rveocgf8
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $fname=str_between($h,'fname" value="','"');
   //$rand=str_between($h,'name="rand" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Continue+to+Video";
   //$post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   sleep(20);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $referer=urlencode(str_between($h,'referer" value="','"'));
   $rand=str_between($h,'rand" value="','"');
$post="op=download2&id=".$id."&rand=".$rand."&referer=".$referer."&method_free=Continue+to+Video&method_premium=&down_direct=1";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   echo $h;
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,"played.to") !==false) {
  //http://played.to/hfsjjt5gbmm4
  if (strpos($filelink,"embed") !==false) {
   //http://played.to/embed-8vxbu3ihjnwg-608x360.html
   $id=str_between($filelink,"embed-","-");
   $filelink="http://played.to/".$id;
  }
  $h=file_get_contents($filelink);
   $id=str_between($h,'id" value="','"');
   $referer=str_between($h,'referer" value="','"');
   $fname=str_between($h,'fname" value="','"');
   $hash=str_between($h,'hash" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($referer)."&hash=".$hash."&imhuman=Continue+to+Video";
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_REFERER, $filelink);
   $h = curl_exec($ch);
   curl_close($ch);
   $link=str_between($h,'file: "','"');
} elseif (strpos($filelink,"mail.ru") !==false) {
   //$filelink="http://api.video.mail.ru/videos/mail/alex.costantin/_myvideo/162.json";
   //http://api.video.mail.ru/videos/embed/mail/alex.costantin/_myvideo/1029.html
   //http://my.mail.ru/video/mail/best_movies/_myvideo/4412.html
   // echo $filelink;
   if (strpos($filelink,"json") === false && strpos($filelink,"embed") !== false) {
     $filelink=str_replace("/embed","",$filelink);
     $filelink=str_replace("html","json",$filelink);
   }
   if (strpos($filelink,"videoapi.my.mail.ru") === false)
   $filelink=str_replace("my.mail.ru/video","api.video.mail.ru/videos/",$filelink);
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_REFERER, "http://my9.imgsmail.ru/r/video2/uvpv3.swf?3");
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   curl_close($ch);
  $t1=explode('720p","url":"',$h);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  if (!$link) {
  $t1=explode('480p","url":"',$h);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  }
  if (!$link) {
  $t1=explode('360p","url":"',$h);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  }
   $link=urldecode($link);
   $link=str_replace("[","\[",$link);
   $link=str_replace("]","\]",$link);
   //$link="http://127.0.0.1/cgi-bin/scripts/util/mail.cgi?".$link;
$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl --cookie "/tmp/cookies.txt"  "'.$link.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/util/m.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/util/m.cgi");
sleep (2);
$link="http://127.0.0.1/cgi-bin/scripts/util/m.cgi?".mt_rand();
//$link="http://api.video.mail.ru/file/video/hv/mail/vladimir_aleksei/_myvideo/275";
} elseif (strpos($filelink,"videomega.tv") !==false) {
  //http://videomega.tv/iframe.php?ref=IHcNODXJUC&width=660&height=360
  //echo $filelink;
  //http://videomega.tv/validatehash.php?hashkey=072077082085098097079074089065065089074079097098085082077072
  //http://videomega.tv/?ref=P155K0FF0550FF0K551P
  $filelink=str_replace("http://videomega.tv/?ref=","http://videomega.tv/cdn.php?ref=",$filelink);
  if (strpos($filelink,"validatehash") !== false) {
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_REFERER, "http://filmehd.net");
   //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
   //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
   $h1 = curl_exec($ch);
   curl_close($ch);
    $h1=str_replace("scri","",$h1);
    //echo $h1;
    $hash=str_between($h1,'var ref="','"');
    $filelink="http://videomega.tv/cdn.php?ref=".$hash;
    $hash=str_between($h1,'var ref="','"');
    $filelink="http://videomega.tv/cdn.php?ref=".$hash;
  }
  //echo $filelink;
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_REFERER, "http://filmehd.net");
   $h = curl_exec($ch);
   curl_close($ch);
   $h=urldecode($h);
   $h=str_replace("scri","",$h);
   //echo $h;
   $t1=explode('tracks : [{file: "',$h);

   $t2=explode('"',$t1[1]);
   $srt=$t2[0];
   $t1=explode('onReady(function(){jwplayer()',$h);
   $t2=explode('file:"',$t1[1]);
   $t3=explode('"',$t2[1]);
   $link=$t3[0];
   exec ("rm -f /tmp/test.xml");
   if ($srt) {
   $l_srt="http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file=".urlencode($srt);
   $h=file_get_contents($l_srt);
   }
} elseif (strpos($filelink,"ok.ru") !==false) {
  $h1=file_get_contents($filelink);
  $id=str_between($h1,'data-player-id="embed_video_','"');
  $l="http://ok.ru/dk?cmd=videoPlayerMetadata&mid=".$id;
  $h2=file_get_contents($l);
  $p=json_decode($h2,1);
  $link=$p["videos"][4]["url"];
  if (!$link) $link= $p["videos"][3]["url"];
} elseif (strpos($filelink,"upafile.com") !==false) {
  $h=file_get_contents($filelink);
  $link=unpack_DivXBrowserPlugin(1,$h,false);
} elseif (strpos($filelink,"docs.google") !==false) {
  //https://docs.google.com/file/d/0B7VByY6oSYEKMnpPeEpTa1JtTTQ/edit?usp=sharing
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   //curl_setopt($ch, CURLOPT_REFERER, "http://my9.imgsmail.ru/r/video2/uvpv3.swf?3");
   //curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   //curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   curl_close($ch);
   $t1=str_between($h,'fmt_stream_map":"35|',',');
   $t1=str_replace("\/","/",$t1);
   $link=$t1;
   $t2=str_between($h,'itag=35&url=',',');
   $link=urldecode($t2);
   if (!$link) {
   $t2=str_between($h,'itag=34&url=',',');
   $link=urldecode($t2);
   }
$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl "'.$link.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/util/m.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/util/m.cgi");
sleep (2);
$link="http://127.0.0.1/cgi-bin/scripts/util/m.cgi?".mt_rand();
   //echo $h;
   //https://v3.cache3.c.docs.google.com/videoplayback?requiressl=yes&shardbypass=yes&cmbypass=yes&id=45613a82e6b91a09&itag=34&source=webdrive&app=docs&ip=78.96.189.71&ipbits=0&expire=1374561222&sparams=requiressl%2Cshardbypass%2Ccmbypass%2Cid%2Citag%2Csource%2Cip%2Cipbits%2Cexpire&signature=23246722655B644EC186906C0ED2F8BBC99447A7.1D705A0B8C23FFF93A88D824AA1A49FB241530E4&key=ck2&cpn=V2D0mX8uN-jeBN2i
   //https://v7.cache8.c.docs.google.com/videoplayback?requiressl=yes&shardbypass=yes&cmbypass=yes&id=45613a82e6b91a09&itag=35&source=webdrive&app=docs&ip=78.96.189.71&ipbits=0&expire=1374561633&sparams=requiressl%2Cshardbypass%2Ccmbypass%2Cid%2Citag%2Csource%2Cip%2Cipbits%2Cexpire&signature=F7DBB32B0BDB14CC12A2A40536C9E0C2F0A4EEB.20DFCFD78F4122C85E9566B08E8C2CE246974413&key=ck2
} elseif (strpos($filelink,"ishared.eu") !==false) {
  $h=file_get_contents($filelink);
  $link=str_between($h,'path:"','"');
} elseif (strpos($filelink,"videofox.net") !==false) {
   //http://videofox.net/s3w9weus4k7y
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $fname=str_between($h,'fname" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Watch+Video";
   sleep(1);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $referer=urlencode(str_between($h,'referer" value="','"'));
   $rand=str_between($h,'rand" value="','"');
   $post="op=download2&id=".$id."&rand=".$rand."&referer=".$referer."&method_free=Watch+Video&down_direct=1";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,"moviki.ru") !==false) {
   //http://www.moviki.ru/embed/29236/0/0/
   $h=file_get_contents($filelink);
   $l1=str_between($h,"video_url: '","'");
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $filelink);
   curl_setopt($ch, CURLOPT_HEADER, true);
   curl_setopt($ch, CURLOPT_NOBODY, 1);
   $h = curl_exec($ch);
   curl_close($ch);
   $t1=explode("Location:",$h);
   $t2=explode("\n",$t1[1]);
   $link=trim($t2[0]);
} elseif (strpos($filelink,"entervideos.com") !==false) {
   //http://entervideos.com/embed-luex1rbugf7m-590x360.html
   //http://entervideos.com/vidembed-wlsuh0mcoe0d
   if (strpos($filelink,"vidembed") !== false) {
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $filelink);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $filelink);
   curl_setopt($ch, CURLOPT_HEADER, true);
   curl_setopt($ch, CURLOPT_NOBODY, 1);
   $h = curl_exec($ch);
   curl_close($ch);
   $t1=explode("Location:",$h);
   $t2=explode("\n",$t1[1]);
   $link=trim($t2[0]);
   } else {
   $h=file_get_contents($filelink);
   $link=str_between($h,'file: "','"');
   }
} elseif (strpos($filelink,"redfly.us") !==false) {
  $link=$filelink;
} elseif (strpos($filelink,"mooshare.biz") !==false || strpos($filelink,"streamin.to") !==false) {
  //http://streamin.to/embed-giepc5gb5yvp-640x360.html
  if (strpos($filelink,"embed") !== false) {
   $id=str_between($filelink,"embed-","-");
   if (preg_match("/stramin/",$filelink))
    $filelink="http://streamin.to/".$id;
  }
  $ch = curl_init($filelink);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17');
  $h = curl_exec($ch);
  $id=str_between($h,'id" value="','"');
  $fname=str_between($h,'fname" value="','"');
  $hash=str_between($h,'hash" value="','"');
  $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&hash=".$hash."&imhuman=Proceed+to+video";
  //echo $post;
  sleep(10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ru-ru; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17');
  $h = curl_exec($ch);
  curl_close($ch);
  //echo $h;
  $link=str_between($h,'file: "','"');
} elseif (strpos($filelink,"kodik.biz") !==false) {
  $h=file_get_contents($filelink);
  //echo $h;
  $p=kodik($h);
  //echo $p;
  $oid=str_between($p,'s1="','"');
  $video_id=str_between($p,'s2="','"');
  $embed_hash=str_between($p,'s3="','"');
  $l="http://api.vk.com/method/video.getEmbed?oid=".$oid."&video_id=".$video_id."&embed_hash=".$embed_hash."&callback=responseWork";
  //echo $l;
  $h1=file_get_contents($l);
  //echo strlen("13daa5fe5a3fe820");
  $t1=explode('url480":"',$h1);
  $t2=explode('"',$t1[1]);
  if (!$t2[0]) {
  $t1=explode('url360":"',$h1);
  $t2=explode('"',$t1[1]);
  }
  $link=str_replace("\/","/",$t2[0]);
}

//////////////////////////////////////////////////////////////////
if (strpos($filelink, 'fsplay.net') !==false) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.fsplay.net");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_HEADER, TRUE);
  $h=curl_exec($ch);
  curl_close($ch);
  //$h= decode_entities($h);
 //$h=file_get_contents($filelink);
 //$h= decode_entities($h);
 //echo $h;
 //playerfs
 if (strpos($filelink,'plmfilmesub') ===false) {
 $srt=str_between($h,'captions.file=','&');
 $srt = str_replace(" ","%20",$srt);
 $filelink=str_between($h,"proxy.link=",'"');
 if (!$filelink) {
 //echo $h;
  preg_match("/(http)(.*)(nowvideo|vk)(.*)(\"|\')+/i",$h,$m);
  //print_r($m);
  $t1 = explode('"', $m[0]);
  $filelink=trim($t1[0]);
 }
 } else {
 //http://roshare.info/embed-6cm2e35qoj42-600x390.html"
 //http://roshare.info/embedx-huwehn7cr7tx.html#
  $t1=explode("roshare",$h);
  $t2=explode('"',$t1[1]);
  $l="http://roshare".$t2[0];
  if (strpos($l,"embed") === false) {
   $t1=explode("/",$l);
   $id=$t1[3];
   $l="http://roshare.info/embedx-".$id.".html#";
  }
  $h=file_get_contents($l);
  $ret1=unpack_DivXBrowserPlugin(2,$h,true);
  $ll=explode(",",$ret1);
  $link=$ll[0];
  $srt=$ll[1]; // cred....
 }
 //peteava
 //http://www.peteava.ro/id-503993
  if (strpos($filelink, 'peteava.ro/embed') !== false) {
  preg_match('/(video\/)([A-Za-z0-9_]+)/', $filelink, $m);
  $id=$m[2];
  $filelink = "http://www.peteava.ro/embed/video/".$id;
  $h = file_get_contents($filelink);
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($h,"stream.php&file=","&");
  }
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    //$link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    $link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif (strpos($filelink, 'peteava.ro/id') !== false) {
  $h = file_get_contents($filelink);
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($h,"stream.php&file=","&");
  }
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    //$link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    $link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif (strpos($filelink, 'content.peteava.ro') !== false) {
  $id = str_between($h,"hd_file=","&");
  if ($id == "") {
    $id = str_between($filelink,"stream.php&file=","&");
  }
  $p=strpos($id,".");  //cinemaxx.ro
  $id1= substr($id,0, $p);
  $id2=substr($id,$p,4);
  $id= $id1.$id2;
  if ($id <> $last_peteava) {
    $last_peteava=$id;
    $token = peteava($id);
    //$link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
    $link="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
  }
} elseif ((strpos($filelink,"vidxden") !==false) || (strpos($filelink,"divxden") !==false)) {
 if (strpos($filelink,"embed") !== false) {
    //http://www.vidxden.com/embed-ob69210omp0y-width-653-height-362.html
    $t=explode("embed-",$filelink);
    $t1=explode("-",$t[1]);
    $id= $t1[0];
    $filelink="http://www.vidxden.com/".$id;
  }
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'id" type="hidden" value="','"');
   $fname=str_between($h,'fname" type="hidden" value="','"');
   //$rand=str_between($h,'name="rand" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Continue+to+Video";
   //$post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   //sleep(7);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,'nowvideo.eu') !==false) {
  //http://www.nowvideo.eu/video/t88lo38nphkhu
  //http://embed.nowvideo.eu/embed.php?v=t88lo38nphkhu
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'flashvars.filekey="','"');
  $l="http://www.nowvideo.eu/api/player.api.php?key=".urlencode($k)."&codes=1&pass=undefined&file=".$f."&user=undefined";
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,'nowvideo.co') !==false) {
  //http://www.nowvideo.co/video/a4n8bfgif6cou
  //http://www.nowvideo.co/api/player.api.php?cid=1&file=a4n8bfgif6cou&pass=undefined&key=78%2E96%2E189%2E71%2D1e5529be1f9ecd8d5ff01ce3583a43dd&user=undefined&cid2=undefined&cid3=undefined&numOfErrors=0
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'var fkzd="','"');
  $l="http://www.nowvideo.co/api/player.api.php?cid=1&file=".$f."&pass=undefined&key=".urlencode($k)."&user=undefined&cid2=undefined&cid3=undefined&numOfErrors=0";
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif ((strpos($filelink, 'vk.com') !== false) || (strpos($filelink, 'vkontakte.ru') !== false)) {
  //echo $filelink;
  $link=vk($filelink);
} elseif (strpos($filelink,"vidbux") !==false) {
  //http://www.vidbux.com/lr0puk6p5xb8
  if (strpos($filelink,"embed") === false) {
    $t=explode("/",$filelink);
    $id= $t[3];
    $filelink=$t[0]."/".$t[1]."/".$t[2]."/"."embed-".$id."-width-653-height-362.html";
  }
  $h = file_get_contents($filelink);
  $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink,'videoweed') !==false) {
  if (strpos($filelink,"embed") !== false) {
    preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
    $id=$m[2];
    $s=explode("/",$filelink);
    $filelink="http://".$s[2]."/embed.php?v=".$id."&amp;width=900&amp;height=600";
  }
  $h = file_get_contents($filelink);
  $f = str_between($h,'flashvars.file="','"');
  $k = str_between($h,'flashvars.filekey="','"');
  $l="http://www.videoweed.es/api/player.api.php?user=undefined&codes=undefined&pass=undefined&file=".$f."&key=".$k;
  //$l=str_replace("&","&amp;",$l);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink,'novamov') !==false) {
  if (strpos($filelink,"embed") !== false) {

    preg_match('/(v=)([A-Za-z0-9_]+)/', $filelink, $m);
    $id=$m[2];
    $s=explode("/",$filelink);
    //http://embed.novamov.com/embed.php?width=728&height=400&v=yi18gc4a62gsu&px=1
    $filelink="http://".$s[2]."/embed.php?v=".$id."&amp;width=600&amp;height=480";
  }
  $h=file_get_contents($filelink);
  $file=str_between($h,'flashvars.file="','"');
  $filekey=str_between($h,'flashvars.filekey="','"');
  $l="http://www.novamov.com/api/player.api.php?user=undefined&file=".$file."&pass=undefined&key=".urlencode($filekey);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
}
exec ("rm -f /tmp/test.xml");
if ($srt <> "") {
$file = $srt;
$file=urldecode($file);
$ttxml     = '';
$full_line = '';
$sub_max = 53;
$last_end=0;
if($file_array = file($file))
{
  foreach($file_array as $line)
  {
    $line = rtrim($line);
    $line = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line);
        if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $line, $match))
        {
          $begin = round(3600 * $match[1] + 60 * $match[2] + $match[3] + $match[4]/1000);
          $end   = round(3600 *$match[5] + 60 * $match[6] + $match[7] + $match[8]/1000);
          $line1 = '';
          $line2 = '';
          $line3 = '';
          if ($begin > $last_end)
          {
           $ttxml .=$last_end."\n";
           $ttxml .=$begin."\n";
           $ttxml .="\n";
           $ttxml .="\n";
          }

          $last_end=$end;
        }
        // if the next line is not blank, get the text
        elseif($line != '')
        {
          if (!$line1)
             $line1=$line;
          else if($line1  && !$line2)
            $line2=$line;
          else if ($line1 && $line2)
            $line3=$line;
        }

        // if the next line is blank, write
        if($line == '')
        {
        if (strlen($line1) >= $sub_max) {
         $newtext = $line1." ".$line2." ".$line3;
         $newtext=trim(str_replace("  "," ",$newtext));
         $newtext = wordwrap($newtext, $sub_max, "<br>");
         $t1=explode("<br>",$newtext);
         $line1=$t1[0];
         $line2=$t1[1];
        } else if ($line3 && strlen($line2) < $sub_max) {
         $line2 = $line2." ".$line3;
         $line2=trim(str_replace("  "," ",$line));
        } else if (strlen($line2) >= $sub_max) {
         $newtext = $line1." ".$line2." ".$line3;
         $newtext=trim(str_replace("  "," ",$newtext));
         $newtext = wordwrap($newtext, $sub_max, "<br>");
         $t1=explode("<br>",$newtext);
         $line1=$t1[0];
         $line2=$t1[1];
        }
        if ($line2=="") {
          $ttxml .=$begin."\n";
          $ttxml .=$end."\n";
          $ttxml .=$line2."\n";
          $ttxml .=$line1."\n";
        } else {
          $ttxml .=$begin."\n";
          $ttxml .=$end."\n";
          $ttxml .=$line1."\n";
          $ttxml .=$line2."\n";
        }
          $line1 = '';
          $line2 = '';
          $line3 = '';
        }
      }
//dummy sub
if ($end > 0) {
   $ttxml .=$end."\n";
$ttxml .="10002"."\n";
$ttxml .="\n";
$ttxml .="\n";
}
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
}
} // end seriale.filmesubtitrate.info
print $link;
?>
