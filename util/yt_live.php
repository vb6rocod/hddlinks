#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
############################################################################
# Copyright: ©2011, ©2012 wencaS <wenca.S@seznam.cz>
# This file is part of xListPlay.
# licence GNU GPL v2
############################################################################
$a_itags=array(37,22,18);

$file=$_GET["file"];
if(preg_match('/(v\/|\?v=|embed\/)([\w\-]+)/', $file, $match)) {
  $id = $match[2];
  $id="GFNDTpCyc70";
  $link = 'http://www.youtube.com/get_video_info?&video_id=' . $id . '&el=vevo&ps=default';
  //echo $link;
  $html=file_get_contents($link);
  $html = urldecode($html);
  $link   = "http://www.youtube.com/watch?v=".$id;
  //echo $link;
  $html   = file_get_contents($link);
  $t1=explode('hlsvp": "',$html);
  $t2=explode('"',$t1[1]);
  $l1=str_replace("\/","/",$t2[0]);
  echo $l1;
  preg_match('#config = {(?P<out>.*)};#im', $html, $out);
  $parts  = json_decode('{'.$out['out'].'}', true);
  $videos = explode(',', $parts['args']['url_encoded_fmt_stream_map']);
foreach ($videos as $video) {
		$vid = urldecode(urldecode($video));
		$vid = str_replace(array('sig=', '---'), array('signature=', '.'), $vid);
		parse_str($vid, $output);

		if (in_array($output['itag'], $a_itags)) break;
	}
}
	/**
	 *	parse $link by wencaS
	 * zkusit odstranit z $tip query fexp - pokud se vyskytuje
	 * je mozne odstranit i dalsi query !! (aspon ve FF video bez nich hraje)
	 * mv=m
	 * sver=3
	 * mt=1345139882
	 * ms=tsu
	 * quality=medium
	 * fallback_host=tc.v6.cache6.c.youtube.com
	 */
	$path = $output['url'].'&';
  unset($output['url']);

	if (isset($output['fexp']))          unset($output['fexp']);
	if (isset($output['type']))          unset($output['type']);
	if (isset($output['mv']))            unset($output['mv']);
	if (isset($output['sver']))          unset($output['sver']);
	if (isset($output['mt']))            unset($output['mt']);
	if (isset($output['ms']))            unset($output['ms']);
	if (isset($output['quality']))       unset($output['quality']);
	if (isset($output['codecs']))        unset($output['codecs']);
	if (isset($output['fallback_host'])) unset($output['fallback_host']);

	$link=urldecode($path.http_build_query($output));
	//$link=$link."&begin=Infinity";
	print $link;
$out='#!/bin/sh
cat <<EOF
Content-type: video/mp4

EOF
exec wget -q -O -  "'.$link.'"';
$fp = fopen('/usr/local/etc/www/cgi-bin/scripts/tv/youtube.cgi', 'w');
fwrite($fp, $out);
fclose($fp);
exec("chmod +x /usr/local/etc/www/cgi-bin/scripts/tv/youtube.cgi");
die();
?>
