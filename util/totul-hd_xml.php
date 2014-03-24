#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
set_time_limit(60);
error_reporting(0);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function cut_string_using_last($character, $string, $side, $keep_character=true) {
    $offset = ($keep_character ? 1 : 0);
    $whole_length = strlen($string);
    $right_length = (strlen(strrchr($string, $character)) - 1);
    $left_length = ($whole_length - $right_length - 1);
    switch($side) {
        case 'left':
            $piece = substr($string, 0, ($left_length + $offset));
            break;
        case 'right':
            $start = (0 - ($right_length + $offset));
            $piece = substr($string, $start);
            break;
        default:
            $piece = false;
            break;
    }
    return($piece);
}
$cookie="/tmp/totulhd.txt";
function RrRrRrRr($teaabb) {
 $l=strlen($teaabb);
 $www=Round($l/2);
  $k=strpos($teaabb,"2CBEA6-1f9B-453400");
 if ($k > $www) $k=strpos($teaabb,"<beti=fahlyr");
 $hhhhffff=$www;
 if ($l<2*$www) $hhhhffff=$hhhhffff-1;
 //for($i=$k+200;$i<$k+450;$i++) {
 for($i=0;$i<$www;$i++) {
   $tttmmm = $tttmmm.$teaabb[$i].$teaabb[$i+$hhhhffff];
 }
 if($l<2*$www) $tttmmm = $tttmmm.$teaabb[$l-1];
 return $tttmmm;
}
//error_reporting(0);

exec ("rm -f /tmp/test.xml");
//exec ("rm -f /usr/local/etc/www/cgi-bin/scripts/filme/php/totulhd.cgi");
//exec ("rm -f /tmp/totulhd.txt");
$link = $_GET["file"];
$filelink=urldecode($link);
//$h=file_get_contents($link);
/*
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);

$filelink="http://adf.ly".str_between($h,"adf.ly",'"');
*/
//$filelink="http://adf.ly/FhoJn";
//$filelink="http://adf.ly/FhkrU";
//http://adf.ly/2696476/http://www.totul-hd.info/project/life.in.a.day.2011/
//https://v4.cache5.c.docs.google.com/videoplayback?requiressl=yes&shardbypass=yes&cmbypass=yes&id=c23bd9cbbcc91983&itag=18&source=webdrive&app=docs&ip=0.0.0.0&ipbits=0&expire=1360337203&sparams=requiressl,shardbypass,cmbypass,id,itag,source,ip,ipbits,expire&signature=6C1E3342202F80B48CE5E0961685AA0E0BF721A9.49953BC05E0699A561775612FB3866A7CEABCDB2&key=ck2&begin=0&cm2=0
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_HEADER, TRUE);
  $h = curl_exec($ch);
  curl_close($ch);
  //$t1=explode("Location:",$h);
  ////$t2=explode("\n",$t1[1]);
  $filelink=trim($t2[0]);
  //echo $h;
  //if (strpos($filelink,"totul-hd") === false)
     //$filelink="http://adf.ly".str_between($h,"var url = '","'");
//echo $filelink."<BR>";
/*
if (strpos($filelink,"adf.ly") !==false) {
 $h1=file_get_contents($filelink);
 $temp=$filelink;
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
//$l="http://www.totul-hd.info/project/Lawless.2012/";
$h=file_get_contents($filelink);
*/
$filelink=str_between($h,"var zzz = '","'");
$filelink="http://www.totul-hd.info/project/Killing.Them.Softly.2012/";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_HEADER, TRUE);
  $h = curl_exec($ch);
  curl_close($ch);
  //echo $h;
  //$t1=explode("Location:",$h);
  //$t2=explode("\n",$t1[1]);
  //$filelink=trim($t2[0]);
  if (strpos($filelink,"html") !== false)
      $filelink=cut_string_using_last('/', $filelink, 'left', true);
  if (substr($filelink, -1) <> "/") $filelink=$filelink."/";
  $filelink=str_replace(" ","%20",$filelink);
  //echo $filelink."<BR>";
$t1=explode('RrRrRrRr("',$h);
$t2=explode('");</SCRIPT>',$t1[2]);
$x=$t2[0];
$x=str_replace('\"','"',$x);
$x=str_replace('\r'," ",$x);
$x=str_replace('\n'," ",$x);
$x=str_replace('\t'," ",$x);
//echo $x;
$t = RrRrRrRr($x);
echo $t."<BR>";
//proxy.link=msnet*abade64ca2b510dfd583aa6d88959f7e17e94a4e0605d78614e2499e3095cc222e2c94edfcbc579ffeba582c6ec377fc2f2c0a164f0043dce006c7ffd93fa1ec
$link=str_between($t,"proxy.link=",'"');
if (preg_match("/videoslasher/",$link)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);

$code=str_between($h,"code: '","'");
$hash=str_between($h,"hash: '","'");
$p="http://www.videoslasher.com".str_between($h,"playlist: '","'");
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $p);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.videoslasher.com/static/player/flowplayer.commercial-3.2.7.swf");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
$l1=explode('content url="',$h);
$l2=explode('"',$l1[2]);
$movie=$l2[0];
} else if (preg_match("/google/",$link)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $h = curl_exec($ch);
  curl_close($ch);
  $movie=urldecode(str_between($h,"itag=22&url=","&type=video"));
  $movie=str_replace(",","%2C",$movie);
}
/*
$ll="http://www.videoslasher.com/service/player/on-start";
//$post="user=0&code=XEPQ12L1NCP0&hash=f45a0b2639a7dc47b91a23a16b8fafa0";
$post="user=0&code=".$code."&hash=".$hash;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ll);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
*/
/*
$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec /opt/bin/curl -s --cookie "/tmp/totulhd.txt" --referer "http://www.videoslasher.com/static/player/flowplayer.commercial-3.2.7.swf" "'.$movie.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/filme/php/totulhd.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/filme/php/totulhd.cgi");
*/
//http://www.totul-hd.info/project/The.Ugly.Truth1.srt
$sub=$filelink.str_between($t,"captions.file=","&");
//echo $sub;
////////////////////////////////////////////////////////////////////////
//$file=urldecode($sub);
$file=$sub;
$ttxml     = '';
$full_line = '';
$last_end=0;
if($file_array = file($file))
{
  //$ttxml .="<subtitrare>";
  foreach($file_array as $line)
  {
    $line = rtrim($line);
    $line = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line);
        if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $line, $match))
        {
          $begin = round(3600 * $match[1] + 60 * $match[2] + $match[3] + $match[4]/1000);
          $end   = round(3600 *$match[5] + 60 * $match[6] + $match[7] + $match[8]/1000);
          //$begin = 3600 * $match[1] + 60 * $match[2] + $match[3] + round($match[4]/100)/10;
          //$end   = 3600 * $match[5] + 60 * $match[6] + $match[7] + round($match[8]/100)/10;
          $line1 = '';
          $line2 = '';
        $f = "/usr/local/bin/home_menu22";

        if (!file_exists($f)) {
          if ($begin > $last_end)
          {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
          }

          $last_end=$end;
        }
        }
        // if the next line is not blank, get the text
        elseif($line != '')
        {
          if($line1 != '')
          {
            $line2= $line;
          }
          else
          {
            $line1= $line;
          }
        }

        // if the next line is blank, write
        if($line == '')
        {
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
        }
      }
//dummy sub
if ($end > 0) {
if (!file_exists($f))
   $ttxml .=$end."\n";
else
   $ttxml .="10000"."\n";
$ttxml .="10002"."\n";
$ttxml .="\n";
$ttxml .="\n";
}
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
print $movie;
die();
?>
