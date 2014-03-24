#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
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
$n=0;
$first=0;
$link = $_GET["file"];
$link="http://port.ro/pls/w/tv.channel?i_ch=".$link."&i_xday=5";
$html = file_get_contents($link);
$p1=explode('http://media.port-network.com/page_elements/line.gif',$html);
$p2=explode('check_page();',$p1[1]);
$table_sus=$p2[1];
$videos = explode('event_port.ro', $table_sus);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[1]);
  	$t3=explode('<',$t2[1]);
  	$begin_time=$t3[0];
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[2]);
  	$t3=explode('<',$t2[1]);
  	$title=c($t3[0]);
  	if (($title=="") && ($first==0)) {
			$a=explode('class="lbbtxt"',$table_sus);
			$t1=explode('>',$a[2]);
			$t2=explode('<',$t1[1]);
			$title=c($t2[0]);
print("Acum: ".$title."\n\r");
			$first=1;
			$n++;
  	} elseif (($begin_time <> "") && ($title <> "")) {
print($begin_time." ".$title."\n\r");
  		$n++;
  	} elseif (($title <> "") && ($first==0)){
print("Acum: ".$title."\n\r");
  		$first=1;
  		$n++;
  	}
  	if ($n >= 12) break;
}
$table_jos=$p1[6];
$videos = explode('event_port.ro', $table_jos);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[1]);
  	$t3=explode('<',$t2[1]);
  	$begin_time=$t3[0];
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[2]);
  	$t3=explode('<',$t2[1]);
  	$title=c($t3[0]);
  	if (($begin_time <> "") && ($title <> "")) {
print($begin_time." ".$title."\n\r");
  		$n++;
  	} elseif (($title <> "") && ($first==0)){
print("Acum: ".$title."\n\r");
  		$first=1;
  		$n++;
  	}
  	if ($n >= 12) break;
}
$table_maine=$p1[2];
$videos = explode('event_port.ro', $table_maine);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[1]);
  	$t3=explode('<',$t2[1]);
  	$begin_time=$t3[0];
  	$t1=explode('class="btxt"',$video);
  	$t2=explode('>',$t1[2]);
  	$t3=explode('<',$t2[1]);
  	$title=c($t3[0]);
  	if (($begin_time <> "") && ($title <> "")) {
print($begin_time." ".$title."\n\r");
  		$n++;
  	} elseif (($title <> "") && ($first==0)){
print("Acum: ".$title."\n\r");
  		$first=1;
  		$n++;
  	}
  	if ($n >= 12) break;
}
?>

