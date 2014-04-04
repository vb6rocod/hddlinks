#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function dec($string) {
    $v=str_replace("\u015e","S",$string);
    $v=str_replace("\u015f","s",$v);
    $v=str_replace("\u0163","t",$v);
    $v=str_replace("\u0162","T",$v);
    $v=str_replace("\u0103","a",$v);
    $v=str_replace("\u0102","A",$v);
    $v=str_replace("\u00a0"," ",$v);
    $v=str_replace("\u00e2","a",$v);
    $v=str_replace("\u021b","t",$v);
    $v=str_replace("\u201e","'",$v);
    $v=str_replace("\u201d","'",$v);
    $v=str_replace("\u0219","s",$v);
    $v=str_replace("\u00ee","i",$v);
    $v=str_replace("\u00ce","I",$v);
    $v=str_replace("\u00e3","a",$v);
    $v=str_replace("&nbsp;","",$v);
    $v=str_replace("\/","/",$v);
    return $v;
}
$link = $_GET["file"];
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
$t1=explode(",",$link);
$link = $t1[0];
$k=str_between($link,"watch/","/");
$l="http://vplus.ro/watch/".$k."/";
//*************************
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $page = curl_exec($ch);
  curl_close($ch);
//http://vplus.ro/watch/eey8skva/
//http://vplus.ro/watch/qw7x6zhg/
$l="http://www.vplay.ro/play/dinosaur.do";
$l="http://vplus.ro/play/player_config.do";
$l="http://vplus.ro/play/dinosaur.do";
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
$post="onLoad=%5Btype%20Function%5D&key=".$k;
$post="onLoad=%5Btype%20Function%5D&external=0&key=".$k;
//Referer: http://i.vplus.ro//f/embed.swf?v=2.5&key=eey8skva
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch,CURLOPT_REFERER,"http://i.vplus.ro//f/embed.swf?v=2.5&key=".$k);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $page = curl_exec($ch);
//echo $page;
$link1=str_between($page,"nqURL=","&");
$subs = str_between($page,"[","]");
if (strpos($subs,'RO') !==false)
  $lang="RO";
else if (strpos($subs,'EN') !==false)
  $lang="EN";
else
  $lang="";
exec ("rm -f /tmp/test.xml");
$cookie="D://vplay_c.txt";
$cookie="/tmp/vplay_c.txt";
if ($lang <> "") {
$post="onLoad=%5Btype%20Function%5D&sc=undefined&lang=".$lang."&key=".$k;
$post="key=".$k;
$l="http://www.vplay.ro/play/subs.do";
$l="http://vplus.ro/play/subs.do";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  //echo $html;
  //$h=json_decode($html,true);
  //var_dump($h);
  //$html=dec($html);
  //echo $html;
  $html=str_replace("\\","",$html);
  //echo $html;
$ttxml ="";
$last_end=0;
$sub_max = 53;
$videos = explode('"s":"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode('"',$video);
 $line=$t1[0];

 $line=str_replace("u0163","þ",$line);
 $line=str_replace("u021B","þ",$line);
 $line=str_replace("u00e2","â",$line);
 $line=str_replace("u0103","ã",$line);
 $line=str_replace("u015f","º",$line);
 $line=str_replace("u0219","º",$line);
 $line=str_replace("u00ee","î",$line);

 $line=str_replace("u015e","ª",$line);
 $line=str_replace("u0218","ª",$line);
 $line=str_replace("u00ce","Î",$line);
 $line=str_replace("u0162","Þ",$line);
 $line=str_replace("u021A","Þ",$line);
 $line=str_replace("u0102","Ã",$line);
 $line=str_replace("u00C2","Â",$line);
 $line=str_replace("u00CE","Î",$line);
 
 $line=str_replace("u00e3","ã",$line);
 $line=str_replace("u00de","Þ",$line);
 $line=str_replace("u00c3","Ã",$line);


 //u00ce
 $l=explode("<br>",$line);
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
 $t1=explode('"f":',$video);
 $t2=explode(",",$t1[1]);
 $begin=$t2[0];
 $t1=explode('"t":',$video);
 $t2=explode('}',$t1[1]);
 $end=$t2[0];
 if ($begin > $last_end)
 {
   $ttxml .=$last_end."\n";
   $ttxml .=$begin."\n";
   $ttxml .="\n";
   $ttxml .="\n";
 }
 $last_end=$end;
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
//$ttxml="\xEF\xBB\xBF".$ttxml;
//$ttxml = mb_convert_encoding($ttxml, 'UTF-8', 'OLD-ENCODING');
//echo $ttxml;
$new_file = "/tmp/test.xml";
//$new_file = "D:\\Program Files\\xampp\\htdocs\\scripts\\filme\\test.xml";
$fh = fopen($new_file, 'w');
fwrite($fh, $ttxml);
fclose($fh);
}
print $link1;
?>
