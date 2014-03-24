#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
error_reporting(0);
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
exec ("rm -f /tmp/test.xml");
$baseurl = "http://127.0.0.1/cgi-bin/translate?stream,Content-type:video/x-flv,";
$link = $_GET["file"];
$t1=explode(",",$link);
$link = $t1[0];
$pg = urldecode($t1[1]);
//$html = file_get_contents($link);
$cookie="D://cookie.txt";
$cookie="/tmp/cookie.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.peteava.ro/");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $id = str_between($html,"hd_file=","&");
  if ($id == "") {
    $id = str_between($html,"stream.php&file=","&");
  }
$srt=str_between($html,"sub=","&");
if ($srt <> "") {
$file=$srt;
$ttxml ="<subtitrare>"."\n";
$full_line = '';
$last_end=0;
$html = file_get_contents($file);
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
$time2=explode(".",$time1[2]);
$begin = round(3600*$time1[0] + 60*$time1[1] + $time2[0] + $time2[1]/1000);
$t1=explode('end="',$line22);
$t2=explode('"',$t1[1]);
$endtime=$t2[0];
$time1=explode(":",$endtime);
$time2=explode(".",$time1[2]);
$end = round(3600*$time1[0] + 60*$time1[1] + $time2[0] + $time2[1]/1000);
$f = "/usr/local/bin/home_menu";
if (!file_exists($f)) {
if ($begin > $last_end)
 {
   $ttxml .="<sub>"."\n";
   $ttxml .="<time1>".$last_end."</time1>"."\n";
   $ttxml .="<time2>".$begin."</time2>"."\n";
   $ttxml .="<line1></line1>"."\n";
   $ttxml .="<line2></line2>"."\n";
   $ttxml .="</sub>"."\n\n";
 }
 $last_end=$end;
}
$line=str_between($t1[1],">","</p");
$line = str_replace("ª","S",$line);
$line = str_replace("º","s",$line);
$line = str_replace("Þ","T",$line);
$line = str_replace("þ","t",$line);
$l=explode("<br />",$line);
$line1=$l[0];
$line2=$l[1];
$line1 = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$line1));
$line2 = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$line2));
if ($line2=="")
{
$line2=$line1;
$line1="";
}
$ttxml .="<sub>"."\n";
$ttxml .="<time1>".$begin."</time1>"."\n";
$ttxml .="<time2>".$end."</time2>"."\n";
$ttxml .="<line1>".$line1."</line1>"."\n";
$ttxml .="<line2>".$line2."</line2>"."\n";
$ttxml .="</sub>"."\n\n";
}
$ttxml .="</subtitrare>";
$new_file = "/tmp/test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
$token = peteava($id);
if ($token <> "") {
  $link =  "http://content.peteava.ro/video/".$id."?start=0&token=".$token;
} else {
  $link = "http://content.peteava.ro/video/".$id;
}
$l="http://127.0.0.1/cgi-bin/scripts/util/mozhay.cgi?id=".$id.";token=".$token;
print $link;
?>
