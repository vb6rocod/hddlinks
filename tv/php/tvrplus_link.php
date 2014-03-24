#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function enc($string) {
  $local3="";
  $arg1=strlen($string);
  $arg2="mediadirect";
  $l_arg2=strlen($arg2);
  $local4=0;
  while ($local4 < $arg1) {
    $m1=ord($string[$local4]);
    $m2=ord($arg2[$local4 % $l_arg2]);
    $local3=$local3.chr($m1 ^ $m2);
    $local4++;
  }
  return $local3;
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $buf = $queryArr[1];
}
//:rtmp://big01.mediadirect.ro:1935/tvrplus/_definst_?id=10668839&publisher=4&siteId=0&token=d7e2b0e517dc818deab8f28c5b2244ba2deb479bf15a669454b937eb/mp4:2013/04/17/98921_Ora_de_business_2013-04-17_19-00-00.mp4?id=10668839&publisher=4&siteId=0&token=d7e2b0e517dc818deab8f28c5b2244ba2deb479bf15a669454b937eb
$link=urldecode($link);
$html = file_get_contents($link);
//echo $link;
$t1=explode('str: "',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$link=enc($t1);

$t1=explode('app: "',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$app=enc($t1);
$t1=explode("/",$app);
$app=$t1[1];
$t1=explode('data: "',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$data=enc($t1);
$t1=explode('publisher: "',$html);
$t2=explode('"',$t1[1]);
$f=$t2[0];
$t1=base64_decode($f);
$publisher=enc($t1);
$serv="big01.mediadirect.ro";

//http://index.mediadirect.ro/getUrl?publisher=4&app=tvrplus&file=mp4:2012/07/30/41701_ROMANIA_OLIMPICA_18_IUL_VAR_1_1.mp4
$s="http://index.mediadirect.ro/getUrl?publisher=4&app=tvrplus&file=".str_replace("mp4:","",$link);
$h = file_get_contents($s);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms20.mediadirect.ro";
}

//echo $link."<BR>".$app."<BR>".$data."<BR>".$publisher."<BR>".$serv;
//rtmpdump -r "rtmp://fms20.mediadirect.ro:1935/tvrplus/_definst_"-y "mp4:2012/05/28/21395_Arena_leilor_2012-05-28_19-30-00.mp4?id=10668839&publisher=4" -o 21395_Arena_leilor_2012-05-28_19-30-00.flv
$l1="Rtmp-options:-b ".$buf." -a tvrplus/_definst_?id=10668839&publisher=4 -W http://static1.mediadirect.ro/mediaplayer/manager/preloader.swf -p http://www.tvrplus.ro";
$l1=$l1." -y ".$link."?id=10668839&publisher=4";
$l1=$l1.",rtmp://".$serv."/tvrplus/_definst_";
$l1=str_replace(" ","%20",$l1);
print $l1;

?>
