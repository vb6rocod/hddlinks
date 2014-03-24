#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}

error_reporting(0);
exec ("rm -f /tmp/test.xml");
$sub_max = 53;
$query = $_GET["file"];
$queryArr = explode(',', $query);
$file = $queryArr[0];
$buf = $queryArr[1];
$subtitle = $queryArr[2];
//
$cookie="D://spice.txt";
$cookie="/tmp/spice.txt";
$file=urldecode($file);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $file);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);

//jsAppData=new Array("26","rtmp://de-edge1.spicetv.ro:1935/filme","mp4:FILME/AfterSex/AFTERSEX_P1.mp4","31960390655dcd369839c0450c8dc572360f832c5522e1e38da0b930eb64eba0","http://www.spicetv.ro/storage/fsub/after-sex-1.sub");
$h=str_between($h,"jsAppData=new Array(",")");
$h=str_replace('"',"",$h);
$t1=explode(",",$h);
$rtmp=$t1[1];
$str=$t1[2];
$id=$t1[3];
$app = substr(strrchr($rtmp, "/"), 1)."?".$id;
//$app="filme?".$id;
$sub=$t1[4];

//$rtmp="rtmp://de-edge1.spicetv.ro:1935";
$l="Rtmp-options:-b ".$buf;
$l=$l." -a ".$app." -W http://static.spicetvnetwork.ro/player/player.swf";
$l=$l." -p http://www.ustv.ro ";
$l=$l."-y ".$str;
$l=$l.",".$rtmp;
$l=str_replace(" ","%20",$l);
$movie=$l;
if ($subtitle == "on") {
$file=urldecode($sub);
$html=file_get_contents($file);
$ttxml     = '';
$full_line = '';
$last_end=0;
if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $html)) {
$ttxml     = '';
$full_line = '';
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
} else {
$videos = explode('<p', $html);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$line22=str_replace("<![CDATA[","",$video);
$line22=str_replace("]]>","",$line22);
$t1=explode('begin="',$line22);
$t2=explode('"',$t1[1]);
$start=$t2[0];
$time1=explode(":",$start);
//$time2=explode(".",$time1[2]);
//00:08:00
if (count($time1)==3)
  $begin = round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
else
  $begin = round(60*$time1[0] + $time1[1]);
$t1=explode('end="',$line22);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$time1=explode(":",$endtime);
//$time2=explode(".",$time1[2]);
if (count($time1)==3)
   $end = round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
else
   $end = round(60*$time1[0] + $time1[1]);

if ($begin > $last_end)
 {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
 }
 $last_end=$end;

$line=str_between($t1[1],'">',"</p");
$l=explode("<br/>",$line);
$line1=trim($l[0]);
$line2=trim($l[1]);
$line1 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line1);
$line2 = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$line2);
 if (strlen($line1) >= $sub_max || strlen($line2) >=$sub_max) {
    $newtext = $line1." ".$line2;
    $newtext=str_replace("  "," ",$newtext);
    $newtext = wordwrap($newtext, $sub_max, "<br>");
    $t1=explode("<br>",$newtext);
    $line1=$t1[0];
    $line2=$t1[1];
 }
if ($line2=="")
{
$line2=$line1;
$line1="";
}
$ttxml .=$begin."\n";
$ttxml .=$end."\n";
$ttxml .=$line1."\n";
$ttxml .=$line2."\n";
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
//}
//echo $ttxml;
print $movie;
?>
