#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
exec ("rm -f /tmp/test.xml");
$file = $_GET["file"];
$file=urldecode($file);
//$file = str_replace(' ','%20',$file);
//$file = str_replace('[','%5B',$file);
//$file = str_replace(']','%5D',$file);
//$file=str_replace("%3A",":",$file);
//$file=str_replace("%2F","/",$file);
//$file="/tmp/ramfs/volumes/HDD:/movie/0003 - Sci-Fi/Battlestar Galactica (2003)/Battlestar Galactica part 1.srt";
$ttxml     = '';
$full_line = '';
$sub_max = 53;
$last_end=0;
$h=file_get_contents($file);
/*
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $file);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
*/
//echo $h;
  $file_array=explode("\n",$h);

if($file_array)
{
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
}

?>
