#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
error_reporting(0);
exec ("rm -f /tmp/test.xml");
$file = $_GET["file"];
//$file=urldecode($file);
//$file = str_replace(' ','%20',$file);
//$file = str_replace('[','%5B',$file);
//$file = str_replace(']','%5D',$file);
$file=str_replace("%3A",":",$file);
$file=str_replace("%2F","/",$file);
//echo $file;
$ttxml     = '';
$full_line = '';
$sub_max = 53;
$last_end=0;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $file);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
  $file_array=explode("\n",$h);

if($file_array)
{
if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $h)) {
  foreach($file_array as $line)
  {
    $line = trim($line);
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
} else {
//echo $h;
$videos = explode('<p', $h);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$t1=explode('begin="',$video);
$t2=explode('"',$t1[1]);
$start=$t2[0];
$time1=explode(":",$start);
if (!$time1[2])
 $begin = 60*$time1[0] + $time1[1];
else
  $begin=round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
$t1=explode('end="',$video);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$time1=explode(":",$endtime);
if (!$time1[2])
 $end = 60*$time1[0] + $time1[1];
else
 $end=round(3600*$time1[0] + 60*$time1[1] + $time1[2]);
if ($begin > $last_end)
 {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
 }
 $last_end=$end;

$line=str_between($t1[1],">","</p");
$l=explode("<br/>",$line);
$line1=$l[0];
$line2=$l[1];
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
//echo $ttxml;
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
}
?>
