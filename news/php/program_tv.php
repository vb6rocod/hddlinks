#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function c($title) {
     $title = htmlentities($title);
     $title = str_replace("&ordm;","s",$title);
     $title = str_replace("&Ordm;","S",$title);
     $title = str_replace("&thorn;","t",$title);
     $title = str_replace("&Thorn;","T",$title);
     $title = str_replace("&icirc;","i",$title);
     $title = str_replace("&Icirc;","I",$title);
     $title = str_replace("&atilde;","a",$title);
     $title = str_replace("&Atilde;","I",$title);
     $title = str_replace("&ordf;","S",$title);
     $title = str_replace("&acirc;","a",$title);
     $title = str_replace("&Acirc;","A",$title);
     $title = str_replace("&oacute;","o",$title);
     $title = str_replace("&amp;", "&",$title);
     return $title;
}
$id = $_GET["file"];
$link="http://port.ro/pls/tv/tv.prog";
$html = file_get_contents($link);
$t1=explode('chNumberCombo',$html);
$t2=explode('<optgroup',$t1[0]);
if ($id==0) {
$html=$t1[0];
$pg="Toate";
} else {
$html=$t2[$id];
$a=explode('label="',$html);
$b=explode('"',$a[1]);
$pg=$b[0];
}
echo "<channel>";
echo "<title_pg>".c($pg)."</title_pg>";
$videos = explode('<option', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('value="',$video);
  $t2=explode('"',$t1[1]);
  $canal=$t2[0];
  $t3=explode(">",$t1[1]);
  $t4=explode("<",$t3[1]);
  $title=c($t4[0]);
  if (strlen($canal) == 5) {
  print '
  <item>
  <title>'.$title.'</title>
  <canal>'.$canal.'</canal>
  </item>
  ';
  }
}
echo "</channel>";
?>
