#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
############################################################################
# Copyright: ©2011, ©2012 wencaS <wenca.S@seznam.cz>
# This file is part of xListPlay.
# licence GNU GPL v2
############################################################################
$a_itags=array(37,22,18);

$file=$_GET["file"];
if(preg_match('/youtube\.com\/(v\/|watch\?v=|embed\/)([\w\-]+)/', $file, $match)) {
  $id = $match[2];
  $link = 'http://www.youtube.com/get_video_info?&video_id=' . $id . '&el=vevo&ps=default';
  //echo $link;
  //$html=file_get_contents($link);
  //$html = urldecode($html);
  $link   = "http://www.youtube.com/watch?v=".$id;
  $html   = file_get_contents($link);
  //echo $html;
  preg_match('#config = {(?P<out>.*)};#im', $html, $out);
  $parts  = json_decode('{'.$out['out'].'}', true);
  //print_r ($parts);
  $videos = explode(',', $parts['args']['url_encoded_fmt_stream_map']);
foreach ($videos as $video) {
		$vid = urldecode(urldecode($video));
		//$vid = str_replace(array('sig=', '---'), array('signature=', '.'), $vid);
		$vid=str_replace('"',"",$vid);
		$vid=str_replace('sig=',"signature=",$vid);
		$vid=str_replace(" ","%20",$vid);
		parse_str($vid, $output);

		if (in_array($output['itag'], $a_itags)) break;
	}
}
/*
$t1=explode("url=",$vid);
$l1=$t1[1];
$link=str_replace("&mime=video/mp4","",$l1);
*/
//print_r ($output);
//http://r4.sn-4g57knsy.c.youtube.com/videoplayback?ipbits=0&fexp=937502,901482,941404,909717,932295,936912,936910,923305,936913,907231,907240,921090&algorithm=throttle-factor&signature=5BFEAF69BD56834750A5723920DD50A892A2ED50.28322923F2D5BF1F0FFBC0C2F052C749949ED2F3&sver=3&mime=video/mp4&dur=155.713&upn=WKZXr5PVBlI&itag=18&gir=yes&ip=78.96.189.71&source=youtube&mv=m&mt=1387438661&ms=au&factor=1.25&id=ec6444d4b703c735&key=yt5&burst=40&sparams=algorithm,burst,clen,dur,factor,gir,id,ip,ipbits,itag,lmt,source,upn,expire&lmt=1387268708363484&expire=1387460011&clen=13101534
//http://r8---sn-4g57kuek.googlevideo.com/videoplayback?key=yt5&ip=78.96.189.71&upn=uwT0xaiDdI0&sparams=id%2Cip%2Cipbits%2Citag%2Cpcm2fr%2Cratebypass%2Csource%2Cupn%2Cexpire&source=youtube&pcm2fr=yes&ipbits=0&itag=18&ratebypass=yes&id=ec6444d4b703c735&sver=3&expire=1387460011&fexp=912301%2C914503%2C939919%2C901473%2C909717%2C932295%2C936912%2C936910%2C923305%2C936913%2C907231%2C907240%2C921090&signature=BE68C76293ED5F05B573CA4455576B0430ECAA73.625B917FA2ECC8C68DD61EACB14350FE7F6555B2&cmbypass=yes&redirect_counter=1&cms_redirect=yes&ms=tsu&mt=1387437554&mv=m
//http://r4.sn-4g57kn6s.googlevideo.com/videoplayback?ms=au&source=youtube&ratebypass=yes&ipbits=0&key=yt5&ip=78.96.189.71&expire=1387460011&itag=18&upn=iC6k6aeKuVY&id=ec6444d4b703c735&sparams=id,ip,ipbits,itag,ratebypass,source,upn,expire&signature=D85DBBD34421D812111426C730A3B99C861162CC.14C50E195C5C5B55878824178F571C7AB35C3460
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
	//echo $path;
  unset($output['url']);

	//if (isset($output['fexp']))          unset($output['fexp']);
	if (isset($output['type']))          unset($output['type']);
	if (isset($output['mv']))            unset($output['mv']);
	if (isset($output['sver']))          unset($output['sver']);
	if (isset($output['mt']))            unset($output['mt']);
	if (isset($output['ms']))            unset($output['ms']);
	if (isset($output['quality']))       unset($output['quality']);
	if (isset($output['codecs']))        unset($output['codecs']);
	if (isset($output['fallback_host'])) unset($output['fallback_host']);

	$link=urldecode($path.http_build_query($output));

	print $link;
die();
?>
