#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
############################################################################
# Copyright: ©2011, ©2012 wencaS <wenca.S@seznam.cz>
# This file is part of xListPlay.
# licence GNU GPL v2
############################################################################

function s_dec($s) {
/*
	By: Nick A. Gaun
	Sekator500 <sekator500@gmail.com>
*/

	$sA = str_split($s);
	$sA = array_reverse($sA);
	$sA = array_slice($sA,3);
	$tS = $sA[0];
	$sA[0] = $sA[19 % count($sA)];
	$sA[19] = $tS;
	$sA = array_reverse($sA);
	$sA = array_slice($sA,2);

	return implode($sA);
}	

$a_itags=array(37,22,18);

$file=$_GET["file"];
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {
  $id = $match[2];
  $link = 'http://www.youtube.com/get_video_info?&video_id=' . $id . '&el=leanback&ps=xl&eurl=https://s.ytimg.com/yts/swfbin/apiplayer-vflhRmAoN.swf&hl=en_US&sts=1588';
  $html   = file_get_contents($link);
  //echo $html;
  parse_str($html,$parts);
  $videos = explode(',',$parts['url_encoded_fmt_stream_map']); 
foreach ($videos as $video) {
		parse_str($video, $output);
		if (in_array($output['itag'], $a_itags)) break;
	}
}
//print_r ($output);
	if (isset($output['type']))          unset($output['type']);
	if (isset($output['mv']))            unset($output['mv']);
	if (isset($output['sver']))          unset($output['sver']);
	if (isset($output['mt']))            unset($output['mt']);
	if (isset($output['ms']))            unset($output['ms']);
	if (isset($output['quality']))       unset($output['quality']);
	if (isset($output['codecs']))        unset($output['codecs']);
	if (isset($output['fallback_host'])) unset($output['fallback_host']);

    $out=str_replace("sig=","signature=",$output['url']);
    if (!preg_match("/signature/",$out)) {
		$signature=s_dec($output['s']);
		$link=$out."&signature=".$signature;
	} else {
	$link=$out;
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
sleep (1);
$link="http://127.0.0.1/cgi-bin/scripts/util/m.cgi?".mt_rand();
	print $link;
die();
?>
