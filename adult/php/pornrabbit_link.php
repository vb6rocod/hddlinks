#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://cdn1.public.spankwire.phncdn.com/201302/03/710331/240P_300K_710331.mp4?nvb=20130313050647&nva=20130313070647&hash=092d1bf49464a25c3681b
//iframe src="http://www.spankwire.com/EmbedPlayer.aspx?ArticleId=710331
//http://88.208.24.200/key=TqwrdlnxdWE,end=1369907526,ip=78.96.189.71/data=C7D08BF3/reftag=5412162/buffer=450K/speed=83200/s/xh/1962316_my_friend_fucking_a_fat_black_ass.flv
//http://3.xhcdn.com&file=eTU9Q9h91fA,ip=78.96.189.71,end=1369907452/data=C7D08BF3/speed=83200/1962316_my_friend_fucking_a_fat_black_ass.flv
$link = $_GET["file"];
    $html = file_get_contents($link);
    $link=str_between($html,"file: '","'");
    if ($link == "") {
    $l1=str_between($html,'iframe src="','"');
    $h=file_get_contents($l1);
    $link=urldecode(str_between($h,'flashvars.video_url = "','"'));
    }
    if ($link == "") {
    $l1=str_between($html,'height="480" src="','"');
    $h = file_get_contents($l1);
    $l2=urldecode(str_between($h,"main_url=","&"));
    //echo $l2;
    $h = file_get_contents($l2);
    $mod=str_between($h,"url_mode=","&");
    $srv=str_between($h,"srv=","&");
    $file=str_between($h,"file=","&");
    if ($mod=="3")
       $link=urldecode($file);
    else if ($mod=="1")
       $link=urldecode($srv."/key=".$file);
}
//http://xhamster.com/xembed.php?video=1771239
print $link;
?>
