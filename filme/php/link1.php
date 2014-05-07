#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$filelink = $_GET["file"];
$filelink=urldecode($filelink);
//echo $filelink;
if (strpos($filelink,"adf.ly") !==false) {
  $t1=explode("http",$filelink);
  $filelink1="http".$t1[2];
  if ($filelink1 == "http") {
  $h1=file_get_contents($filelink);
  $filelink=str_between($h1,"var url = '","'");
  if (!$filelink) $filelink=str_between($h1,"var zzz = '","'");
  /*
  if (strpos($filelink,"adf.ly") === false)
    $filelink = "http://adf.ly".$filelink;
  } else {
  $filelink=$filelink1;
  */
  }
}
//echo $filelink;
if (strpos($filelink,"moovie.cc") !== false) {
 $a = @get_headers($filelink);
 //print_r($a);
 $l=$a[10];
 $a1=explode("Location:",$l);
$filelink=trim($a1[1])."&player=flowplayer";
$h=file_get_contents($filelink);
}
if (strpos($filelink,"filmbazis.org") !==false) {
  //http://www.filmbazis.org/229512
  $id=substr(strrchr($filelink, "/"), 1);
  $l="http://www.filmbazis.org/embed.php";
  $post="id=".$id;
  //echo $post;
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $l);
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt ($ch, CURL_REFERER,$filelink);
     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $html = curl_exec($ch);
     //echo $html;
     curl_close($ch);
     if (preg_match("/frame/i",$html)) {
     $t1=explode("href='",$html);
     $t2=explode("'",$t1[1]);
     $l1=$t2[0];
     if ($l1) {
      if (strpos($l1,"url") !== false) {
        $t1=explode("url/",$l1);
        $filelink=$t1[1];
      } else {
        $filelink=$l1;
      }
     }
     } else {
       $t1=explode('href="',$html);
       $t2=explode('"',$t1[1]);
       $l1=$t2[0];
      if (strpos($l1,"url") !== false) {
        $t1=explode("url/",$l1);
        $filelink=$t1[1];
      } else {
        $filelink=$l1;
      }
   }
   //echo $filelink;
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
    $ret_val = str_between($r,"clip:{url:'","'"); //putme.org
  if ($ret_val == "")
    $ret_val=str_between($r,'file:"','"');
  if ($sub==true) {
    $srt=str_between($r,"captions.file','","'");
    $srt = str_replace(" ","%20",$srt);
    $ret_val=$ret_val.",".$srt;
  }
  return $ret_val;
}
//http://d3468.allmyvideos.net:182/d/3cmksyx4yq5dh6lndxgzhy66fanu5czdtvdawzog2ues3us6al5xob45/video.mp4?start=0
function unpack_allmyvideos($n_func,$html_cod) {
  $f=explode("return p;",$html_cod);
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
  if (!$ret_val)
    $ret_val = str_between($r,"file' : '","'");
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
function s2g($string) {
$ch = curl_init($string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$h = curl_exec($ch);
$sid=str_between($h,'"sid" value="','"');
$post="sid=".$sid."&submit=Click+Here+To+Continue";
sleep(2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
$h = curl_exec($ch);
$url=unpack_DivXBrowserPlugin(1,$h);
return $url;
}
function uploadville($string) {
$ch = curl_init($string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$h = curl_exec($ch);
$id=str_between($h,'"id" value="','"');
$fname=str_between($h,'"fname" value="','"');
$post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=LOAD_HERE";
//op=download1&usr_login=&id=z5g2on7obv7j&fname=Shark.Night.2011.TS.XviD-TaRiQ786.avi&referer=&method_free=LOAD_HERE
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
$h = curl_exec($ch);
$r=unpack_DivXBrowserPlugin(2,$h);
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
function rapidload($string) {
$ch = curl_init($string);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
$h = curl_exec($ch);

$method_premium=str_between($h,'"method_premium" value="','"');
$method_free=str_between($h,'"method_free" value="','"');
$id=str_between($h,'"id" value="','"');
$fname=str_between($h,'"fname" value="','"');
$post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=".$method_free;
sleep(2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
$h = curl_exec($ch);
//Enter code below:
if (strpos($h,"Enter code below:") !==false) {
  $t1=explode('Enter code below:',$h);
} else {
  $t1=explode('Bitte Code eingeben:',$h);
}
$t2=explode('</table>',$t1[1]);
$p=$t2[0];
$t1=explode('position:absolute',$p);
$a1=explode('padding-left:',$t1[1]);
$p1=explode('px',$a1[1]);
$pos1=trim($p1[0]);
$v1=explode('>&#',$a1[1]);
$v2=explode(';',$v1[1]);
$val1=chr($v2[0]);
//
   $a1=explode('padding-left:',$t1[2]);
   $p1=explode('px',$a1[1]);
   $pos2=trim($p1[0]);
   $v1=explode('>&#',$a1[1]);
   $v2=explode(';',$v1[1]);
   $val2=chr($v2[0]);
//
   $a1=explode('padding-left:',$t1[3]);
   $p1=explode('px',$a1[1]);
   $pos3=trim($p1[0]);
   $v1=explode('>&#',$a1[1]);
   $v2=explode(';',$v1[1]);
   $val3=chr($v2[0]);
//
   $a1=explode('padding-left:',$t1[4]);
   $p1=explode('px',$a1[1]);
   $pos4=trim($p1[0]);
   $v1=explode('>&#',$a1[1]);
   $v2=explode(';',$v1[1]);
   $val4=chr($v2[0]);
//
   $my = array(
   $pos1 => $val1,
   $pos2 => $val2,
   $pos3 => $val3,
   $pos4 => $val4);
   ksort($my);
   $v = array_values($my);
   $p=$v[0].$v[1].$v[2].$v[3];
//
   $id=str_between($h,'name="id" value="','"');
   $rand=str_between($h,'name="rand" value="','"');
   sleep(10);
   $post="op=download2&id=".$id."&rand=".$rand."&referer=".urlencode($string)."&method_free=".$method_free."&method_premium=&code=".$p."&down_script=1";
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,0);
curl_setopt($ch, CURLOPT_REFERER, $string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
$h = curl_exec($ch);
curl_close ($ch);
$url=unpack_DivXBrowserPlugin(2,$h);
return $url;
}
function dimshare($k,$char_rep,$pos_link,$h,$fn) {
  $r=unpack_DivXBrowserPlugin($k,$h);
  return $r;
}
function movdivx($k,$char_rep,$pos_link,$h,$fn) {
  $r=unpack_DivXBrowserPlugin($k,$h);
  return $r;
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
  $h = file_get_contents($string);
  $r=unpack_DivXBrowserPlugin(1,$h);
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
	$r=$host."u".$uid."/videos/".$vtag.".360.mp4";
 } else {
    $baza = file_get_contents($string);
    $host = str_between($baza,"var video_host = '","'");
    $uid = str_between($baza,"var video_uid = '","'");
    $vtag = str_between($baza,"var video_vtag = '","'");
    $hd = str_between($baza,"var video_max_hd = '","'");
    $r = $host."u".$uid."/videos/".$vtag.".360.mp4";
    if ($hd == "0") {
      $r = $host."u".$uid."/videos/".$vtag.".240.mp4";
    }
 }
  return $r;
}
function youtube($file) {
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {
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
     //http://www.putlocker.com/embed/067DF715716F10C5
     //http://www.putlocker.com/file/067DF715716F10C5
     //http://www.putlocker.com/embed/88EE985C2352B26A
     $cookie="/tmp/cookie.txt";
     //$cookie="D://cookie.txt";
     $string=str_replace("file","embed",$string);
     $id=substr(strrchr($string,"/"),1);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $string);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
     $h = curl_exec($ch);
     curl_close($ch);
     $t1=explode('form method="post"',$h);
     $t2=explode('value="',$t1[1]);
     $t3=explode('"',$t2[1]);
     $hash=$t3[0];
     $post="hash=".$hash."&confirm=Close+Ad+and+Watch+as+Free+User";
     $post="fuck_you=".$hash."&confirm=Close+Ad+and+Watch+as+Free+User";
     //hash=fe41ab2306be4d45&confirm=Close+Ad+and+Watch+as+Free+User
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $string);
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $h = curl_exec($ch);
     curl_close($ch);
     //echo $h;
     $id=str_between($h,"playlist: '","'");
     //$id=str_between($h,"playlist: '","'");
     //$url="http://www.putlocker.com/get_file.php?embed_stream=".$id;
     ///get_file.php?embed_stream=MDY3REY3MTU3MTZGMTBDNStlNTY1Y2EwNDcyZjYwZjUy
     if (strpos($string,"putlocker") !==false) {
       $url="http://www.putlocker.com".$id;
     } elseif (strpos($string,"sockshare") !== false) {
       $url="http://www.sockshare.com".$id;
     }
     //echo "<BR>".$url."<BR>";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $h = curl_exec($ch);
     curl_close($ch);
     //echo $h;
     $t1=explode('media:content url="',$h);
     $t2=explode('"',$t1[2]);
     $r = $t2[0];
     $r=str_replace("&amp;","&",$r);
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
    $filelink="http://".$s[2]."/embed.php?v=".$id."&amp;width=600&amp;height=480";
  }
  $h=file_get_contents($filelink);
  $file=str_between($h,'flashvars.file="','"');
  $filekey=str_between($h,'flashvars.filekey="','"');
  $l="http://www.novamov.com/api/player.api.php?user=undefined&file=".$file."&pass=undefined&key=".urlencode($filekey);
  $h=file_get_contents($l);
  $link=str_between($h,"url=","&");
} elseif (strpos($filelink, 'videobb') !== false) {
  if (strpos($filelink,'videobb.com') !==false) {
     $id=substr(strrchr($filelink,"/"),1);
  } else {   // filmenet.ro
     $a1=explode("videoid=",$filelink);
     $a2=explode("&",$a1[1]);
     $id=$a2[0];
  }
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
  }
} elseif (strpos($filelink,'vimeo.com') !==false){
  //http://player.vimeo.com/video/16275866
  if (strpos($filelink,"player.vimeo.com") !==false) {
     $id=substr(strrchr($filelink,"/"),1);
     $link="http://127.0.0.1/cgi-bin/translate?stream,,http://vimeo.com/".$id;
  } else {
     $link="http://127.0.0.1/cgi-bin/translate?stream,,".$filelink;
  }
} elseif (strpos($filelink, 'googleplayer.swf') !== false) {
  $t1 = explode("docid=", $filelink);
  $t2 = explode("&",$t1[1]);
  $link = "http://127.0.0.1/cgi-bin/translate?stream,,http://video.google.com/videoplay?docid=".$t2[0];
} elseif (strpos($filelink, 'filebox.ro/get_video') !== false) {
   $s = str_between($filelink,"videoserver",".");
   $f = str_between($filelink,"key=","&");
   $link = "http://static.filebox.ro/filme/".$s."/".$f.".flv";
} elseif (strpos($filelink, 'videobam.com') !== false) {
   //http://videobam.com/widget/Xykqy/3"
   //http://videobam.com/Uogry
   $h = file_get_contents($filelink);
   $link=str_between($h,',"url":"','"');
   $link=str_replace("\\","",$link);
} elseif (strpos($filelink, 'divxstage.net') !== false) {
   //divxstage.net/video/canc73f7kgvbt
   $h = file_get_contents($filelink);
   $link=str_between($h,'param name="src" value="','"');
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
} elseif (strpos($filelink, 'stagero.eu') !== false) {
   //http://www.stagero.eu/api/player.api.php?codes=1&key=78%2E96%2E189%2E71%2D43400f4737713449ec249d9baf1e16f9&pass=undefined&user=undefined&file=pq34kgvq7gn26
   $h = file_get_contents($filelink);
   $p1=str_between($h,'flashvars.filekey="','"');
   $p2=str_between($h,'flashvars.file="','"');
   $l1="http://www.stagero.eu/api/player.api.php?codes=1&key=".urlencode($p1)."&pass=undefined&user=undefined&file=".$p2;
   $h = file_get_contents($l1);
   $link=str_between($h,"url=","&");
} elseif (strpos($filelink, 'stream2k.com/playerjw/vConfig') !== false) {
   $h = file_get_contents($filelink);
   $link=trim(str_between($h,'<file>','</file>'));
} elseif (strpos($filelink, 'embed.stream2k.com') !== false) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, $filelink);
  $h = curl_exec($ch);
  curl_close($ch);
  $link=urldecode(trim(str_between($h,"file=",'&')));
} elseif (strpos($filelink, 'xvidstage.com') !== false) {
   //http://xvidstage.com/zwvh3et6vugo
   //http://xvidstage.com/cgi-bin/dl.cgi/igribijb5hnkqetnfyplgdzywdxney3aiufdbxrwn4/video.avi
   //op=download1&usr_login=&id=shb0yb2muu9g&fname=xf-captiva.avi&referer=http%3A%2F%2Fwww.movie2k.to%2FVilla-Captive-online-film-1234382.html&method_free=Free+Download
   if (strpos($filelink,"embed") !== false) {
    $h = file_get_contents($filelink);
   } else {
    $id = substr(strrchr($filelink, "/"), 1);
    $filelink = "http://xvidstage.com/embed-".$id.".html";
    $h = file_get_contents($filelink);
    }
    $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'nolimitvideo.com') !== false) {
   //http://www.nolimitvideo.com/embed/17ea366031f87f3aa009/new-kids-turbo
   $h = file_get_contents($filelink);
   $link=str_between($h,"file': '","'");
} elseif (strpos($filelink, 'stage666.net') !== false) {
   //http://stage666.net/rfl5qcrxsb3a.html
   //http://stage666.net/cgi-bin/dl.cgi/kylgrtsmovb2rbldug23w3o45jkdpr23gv4cxbsdjq/video.avi
   $h = file_get_contents($filelink);
   preg_match("/(\|)([a-z0-9]{42})\|/",$h,$m);
   $hash=$m[2];
   $link="http://stage666.net/cgi-bin/dl.cgi/".$hash."/video.avi";
} elseif (strpos($filelink, 'rapidload.org') !== false) {
   $link=rapidload($filelink);
} elseif (strpos($filelink, 'vidstream.us') !== false) {
   $h=file_get_contents($filelink);
   $link=str_between($h,"'file', '","'");
   if ($link =="") {
   $l=str_between($h,'settingsFile: "','&');
   $h=file_get_contents($l);
   $link=str_between($h,'videoPath value="','"');
   }
} elseif (strpos($filelink, '2gb-hosting.com') !== false) {
   $link=s2g($filelink);
} elseif (strpos($filelink, 'dimshare.com') !== false) {
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=LOAD_HERE";
   sleep(2);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=dimshare(1,12,9,$h,$fname);
} elseif (strpos($filelink, 'movdivx.com') !== false) {
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=&method_free=Please+wait+for+0+seconds";
   sleep(5);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'sharevideo22.com') !== false) {
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $rand=str_between($h,'name="rand" value="','"');
   $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
   sleep(2);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink, 'dr9000.com') !== false) {
   $h=file_get_contents($filelink);  //account suspend
   $link=str_between($h,'name="src" value="','"');
} elseif (strpos($filelink, 'altervideo.net') !== false) {
   $string=$filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $rand=str_between($h,'name="rand" value="','"');
   $c=str_between($h,'type="hidden" value="','"');
   $post="c=".$c."&choice=Watch+Online";
   sleep(2);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink, 'royalvids.eu') !== false) {
   $h=file_get_contents($filelink);
   $link=str_between($h,'"flashvars" value="file=','&');
} elseif (strpos($filelink,'skyload.net') !== false) {
   //http://skyload.net/File/11f90e69ce45ef43e55650a871ae85df.flv
   //http://www.skyload.net/File/335c00e46e57e17ef690de605239c9dd.avi
   $h=file_get_contents($filelink);
   $link=str_between($h,"addVariable('file','","'");
   if ($link=="") {
     $link=str_between($h,"param name='src' value='","'");
   }
} elseif (strpos($filelink,'rapidvideo.com') !==false) {
  //http://rapidvideo.com/view/tl9gewcl
  $h=file_get_contents($filelink);
  $link=str_between($h,"addVariable('file','","'");
} elseif (strpos($filelink, 'uploadc.com') !== false) {
   //http://www.uploadc.com/a2baprw26l3m/np-prophezeiung-xvid.avi.htm
   $link=uploadc($filelink);
} elseif (strpos($filelink, 'uploadville.com') !== false) {
   //http://uploadville.com/z5g2on7obv7j
   $link=uploadville($filelink);
} elseif (strpos($filelink, 'zurvid.com') !== false) {
   //http://www.zurvid.com/embed.php?id=635
  $h=file_get_contents($filelink);
  $link=str_between($h,"file=","&");
} elseif (strpos($filelink, 'flashx.tv') !== false) {
   //http://flashx.tv/player/embed_player.php?vid=1394
   //http://flashx.tv/player/embed_player.php?vid=2174&
   //http://flashx.tv/player/embed_player.php?vid=DOUB43487X33
   //http://flashx.tv/video/DOUB43487X33/xf-captiva
   //http://flashx.tv/video/D1OY7UBGNW4B/gefaehrtndvdscr-pwnd
   //http://flashx.tv/player/embed_player.php?vid=6724&width=661&height=400&autoplay=no
   //http://flashx.tv/fxplayer/fxtv.php?hash=D1OY7UBGNW4B&width=661&height=400&autoplay=yes
   //http://flashx.tv/video/5KA3ONU881WN/White
   //http://play.flashx.tv/nuevo/player/enc.php?str=4MfrzrW9yrmvtay5rLHGtMs=
   if (preg_match("/flashx.tv\/video\/([\w\-]+)/",$filelink,$match)) {
     $id=$match[1];
     //echo base64_decode("4MfrzrW9yrmvtay5rLHGtMs=");
     //http://play.flashx.tv/nuevo/player/fx.php?str=4MfrzrWbw6ertca7sJ6pvcY=
     $filelink="http://play.flashx.tv/nuevo/player/cst.php?hash=".$id;
     $h=file_get_contents($filelink);
     //echo $filelink;
     $link=trim(str_between($h,"<file>","</file>"));
   }
  /*
  if (strpos($filelink,"player.php") === false) {
    $a1=explode("/",$filelink);
    $id=$a1[4];
  } else {
    $h=file_get_contents($filelink);
    $id = str_between($h,"hash=","&");
  }

  $filelink="http://flashx.tv/fxplayer/fxtv.php?hash=".$id."&width=661&height=400&autoplay=yes";
  $h=file_get_contents($filelink);
  if (strpos($h,"href") === false) {
    $new_file="D://dolce.gz";
    $new_file="/tmp/dolce.gz";
    exec ("rm -f /tmp/dolce");
    $fh = fopen($new_file, 'w');
    fwrite($fh, $h);
    fclose($fh);
    exec("/usr/local/etc/www/cgi-bin/scripts/funzip /tmp/dolce.gz > /tmp/dolce");
    sleep(1);
    $h=file_get_contents("/tmp/dolce");
 }
  $link=str_between($h,'href="','"');
  */
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
} elseif (strpos($filelink, 'ovfile.com') !== false) {
  $h = file_get_contents($filelink);
  $link=get_unpack4(2,12,5,$h);
  if (strpos($link,"http") === false) {
  $link=unpack_DivXBrowserPlugin(2,$h);
  }
} elseif (strpos($filelink, 'filebox.com') !==false) {
  //http://www.filebox.com/embed-mxw6nxj1blfs-970x543.html
  //http://www.filebox.com/mxw6nxj1blfs
  if (strpos($filelink,"embed") === false) {
    $id=substr(strrchr($filelink,"/"),1);
    $filelink="http://www.filebox.com/embed-".$id."-970x543.html";
  }
  $h=file_get_contents($filelink);
  $link=str_between($h,"{url: '","'");
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
} elseif (strpos($filelink, 'ginbig.com') !==false) {
   //http://ginbig.com/dxzttydrg36s.html
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
   //op=download1&usr_login=&id=dxzttydrg36s&fname=nedivx-extremlyloud-a.avi.mp4&referer=http%3A%2F%2Fwww.movie2k.to%2FExtremely-Loud-Incredibly-Close-watch-movie-1235291.html&method_free=Free+Download
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"divxbase.com") !==false) {
  //http://www.divxbase.com/7oesw7h5u80r
  $h=file_get_contents($filelink);
  $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"allmyvideos.net") !==false) {
  //op=download1&usr_login=&id=klz15k85haa6&fname=Extremely+Loud+Incredibly+Close+2012+DVDSCR+AC3+READNFO+XViD+-+INSPiRAL.mp4&referer=http%3A%2F%2Fwww.movie2k.to%2FExtremely-Loud-Incredibly-Close-watch-movie-1204442.html&method_free=Watch+Now%21
   //http://allmyvideos.net/klz15k85haa6
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   //$h = curl_exec($ch);
   //$id=str_between($h,'"id" value="','"');
   //$fname=str_between($h,'"fname" value="','"');
   //$reff=str_between($h,'referer" value="','"');
   ////$post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&method_free=Watch+Now%21";
   //curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   //curl_setopt($ch, CURLOPT_REFERER, $string);
   //curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   //curl_setopt ($ch, CURLOPT_POST, 1);
   //curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $h=file_get_contents($filelink);
   //echo $h;
   $link=unpack_allmyvideos(2,$h);
} elseif (strpos($filelink,"gorillavid.in") !==false) {
  //op=download1&usr_login=&id=apthqam53xtu&fname=Extremely+Loud+And+Incredibly+Close+%282012%29+DVDSCR+XviD+BBnRG.avi&referer=http%3A%2F%2Fwww.movie2k.to%2FExtremely-Loud-Incredibly-Close-watch-movie-1209674.html&channel=&method_free=Free+Download
   //http://gorillavid.in/apthqam53xtu
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&channel=&method_free=Free+Download";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=str_between($h,'file:"','"');
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
} elseif (strpos($filelink,"zalaa.com") !==false) {
   //http://www.zalaa.com/4qkcjgb868wy
   //http://www.zalaa.com/o337wb48sc5t/gefaehrtn.dvdscr-pwnd.avi.htm
   //ipcount_val=10&op=download2&usr_login=&id=4qkcjgb868wy&fname=Made.In.Romania.2010.DVDRIP.XviD-QP.flv&referer=www.movie2k.to%2FMade-in-Romania-watch-movie-1235493.html&method_free=Slow+access
   $string = $filelink;
   $ch = curl_init($string);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   $h = curl_exec($ch);
   $id=str_between($h,'"id" value="','"');
   $fname=str_between($h,'"fname" value="','"');
   $reff=str_between($h,'referer" value="','"');
   $ipcount_val=str_between($h,'ipcount_val" value="','"');
   $post="ipcount_val=".$ipcount_val."&op=download2&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($reff)."&method_free=Slow+access";
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   $h = curl_exec($ch);
   $link=str_between($h,"file','","'");
   if ($link == "")
     $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"vreer.com") !==false) {
   //http://vreer.com/q1kqxyhutswf
   //op=download1&usr_login=&id=q1kqxyhutswf&fname=_Dark.Tide.2012.HDRiP.AC3-5.1.XviD-SiC.avi&referer=http%3A%2F%2Fwww.movie2k.to%2FDark-Tide-watch-movie-1235718.html&hash=iqjrsjrwkl5ie4h2w35cp7znbuemna3r&method_free=Free+Download
   //http://vreer.com/embed-uwh8s53ma7ae-728x481.html
   if (strpos($filelink,"embed") !==false) {
     $id=str_between($filelink,"embed-","-");
     $filelink= "http://vreer.com/".$id;
   }
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
} elseif (strpos($filelink, 'veervid.com') !==false) {
   //http://www.veervid.com/video/756/d8e9bcf694bd.flv
   //http://www.veervid.com/video.php?file=d8e9bcf694bd.flv&position=0&bw=mid
   $id=substr(strrchr($filelink,"/"),1);
   $link="http://www.veervid.com/video.php?file=".$id;
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
} elseif (strpos($filelink,"ufliq.com") !==false) {
  //http://www.ufliq.com/embed-021l07r13j3a.html#
  $h=file_get_contents($filelink);
  $link=str_between($h,"url: '","'");
} elseif (strpos($filelink,"muchshare.net") !==false) {
  //http://muchshare.net/kmtllns0vdzk
  //http://muchshare.net/embed-kmtllns0vdzk.html
  if (strpos($filelink,"embed") === false) {
    $t1=explode("/",$filelink);
    $filelink = "http://muchshare.net/embed-".$t1[3].".html";
    echo $filelink;
  }
  $h=file_get_contents($filelink);
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
} elseif (strpos($filelink,"dailymotion.com") !==false) {
  //http://www.dailymotion.com/video/xsg0qa
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
} elseif (strpos($filelink, 'modovideo.com') !==false) {
  //http://www.modovideo.com/video.php?v=fx8jyb4o9g9yhl37xqnm7idchw67q7zb
  //http://www.modovideo.com/frame.php?v=fx8jyb4o9g9yhl37xqnm7idchw67q7zb
  //http://www.modovideo.com/video?v=xa8xysu73n6h2djewvhwsox2e736y0cb
  //http://www.modovideo.com/video?v=rtb95xgy5sk81t032t3mt0wkp9kjcvz4
  $t=explode("v=",$filelink);
  $id=$t[1];
  $filelink = "http://www.modovideo.com/frame.php?v=".$id;
  $h = file_get_contents($filelink);
  $link = str_between($h,"plugin.video=","&");
} elseif (strpos($filelink,"180upload.com") !==false) {
  //http://180upload.com/embed-iyoqowagoivm-728x360.html
  //http://180upload.com/iyoqowagoivm
  //http://180upload.com/095esb3kw747
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
} elseif (strpos($filelink,"vidto.me") !==false) {
  //http://vidto.me/2roeh1a5q83u.html
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   //curl_setopt($ch, CURLOPT_REFERER, $filelink);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   $id=str_between($h,'id" value="','"');
   $referer=str_between($h,'referer" value="','"');
   $fname=str_between($h,'fname" value="','"');
   $hash=str_between($h,'hash" value="','"');
   if ($fname) {
   //op=download1&usr_login=&id=2roeh1a5q83u&fname=Masterchef.The.Professionals.AU.s01e21.WS.PDTV.XviD.BF1.avi&referer=http%3A%2F%2Fwww.awesomedl.com%2F2013%2F03%2Fmasterchef-professionals-au-season-1.html&hash=yoazemi3t5a4xxhyrlqu7l5b76id6iqf&imhuman=Proceed+to+video
   $post="op=download1&usr_login=&id=".$id."&fname=".$fname."&referer=".urlencode($referer)."&hash=".$hash."&imhuman=Proceed+to+video";
   //echo $post;
   sleep(10);
     //$ch = curl_init();
     //curl_setopt($ch, CURLOPT_URL, $filelink);
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     curl_setopt($ch, CURLOPT_REFERER, $filelink);
     $h = curl_exec($ch);
     curl_close($ch);
     //echo $h;
     $link=str_between($h,"var file_link = '","'");
   }
} elseif (strpos($filelink,"played.to") !==false) {
  //http://played.to/hfsjjt5gbmm4
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
} elseif (strpos($filelink,"primeshare.tv") !==false) {
  //http://primeshare.tv/download/7679248EB7
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   //curl_setopt($ch, CURLOPT_REFERER, $filelink);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
   $h = curl_exec($ch);
   $hash=str_between($h,'hash" value="','"');
   $post="hash=".$hash;
   sleep(11);
     //$ch = curl_init();
     //curl_setopt($ch, CURLOPT_URL, $filelink);
     curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     curl_setopt($ch, CURLOPT_REFERER, $filelink);
     $h = curl_exec($ch);
     curl_close($ch);
     $t1=explode("clip:",$h);
     $link=str_between($t1[1],"url: '","'");
} elseif (strpos($filelink,"putme.org") !==false) {
  //http://www.putme.org/tu7m7nvv268j
  $h=file_get_contents($filelink);
   $id=str_between($h,'id" value="','"');
   $referer=str_between($h,'referer" value="','"');
   //$fname=str_between($h,'fname" value="','"');
   $rand=str_between($h,'rand" value="','"');
   //op=download2&id=tu7m7nvv268j&rand=mer7ukwuszjvgo3ilst2snemjj6swtm5umhwshi&referer=&method_free=&method_premium=&down_direct=1
   //op=download2&id=tu7m7nvv268j&rand=hc53bstci6oyvyonaz5s7duolirbt2ioiycpjda&referer=&method_free=&method_premium=&down_direct=1
   $post="op=download2&id=".$id."&rand=".$rand."&referer=".urlencode($referer)."&method_free=&method_premium=&down_direct=1";
   //echo $post;
   $ch = curl_init($filelink);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
   curl_setopt ($ch, CURLOPT_POST, 1);
   curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_REFERER, $filelink);
   $h = curl_exec($ch);
   curl_close($ch);
   //echo $h;
   $link=unpack_DivXBrowserPlugin(2,$h);
} elseif (strpos($filelink,"gorillavid.in") !==false) {
  //http://gorillavid.in/embed-f0sbhwq2kk30-600x480.html
  $h=file_get_contents($filelink);
  $link=str_between($h,'file: "','"');
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
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink, 'youwatch.org') !== false) {
//echo $filelink;
   if (!preg_match("/embed/",$filelink)) {
     $id=substr(strrchr($filelink, "/"), 1);
     $filelink="http://youwatch.org/embed-".$id."-620x350.html";
   }
   //http://youwatch.org/embed-t9d055slghmu-620x350.html
   $h=file_get_contents($filelink);
   //$link=str_between($h,'file: "','"');
   $link=unpack_DivXBrowserPlugin(1,$h);
} elseif (strpos($filelink, 'zixshare.com') !== false) {
  $l=$filelink;
  $cookie="/tmp/zix.txt";
  //$cookie="D://zix.txt";
  //echo $l;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  //curl_setopt($ch, CURLOPT_REFERER,$url1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
  $l1=str_between($h,"goNewWin('","'");

  $l2="http://adf.ly/1431126/int/";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l2.$l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,$l);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,$l2.$l);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
  $l1=str_between($h,"goNewWin('","'");
  //echo $l1;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,$l);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);

  $t1=explode("clip:",$h);
  $movie=str_between($t1[1],"url: '","'");
  $link=urldecode($movie);
} elseif (strpos($filelink,"mooshare.biz") !==false || strpos($filelink,"streamin.to") !==false) {
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
}

print $link;
?>
