#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$link = $_GET["file"];
    $html = file_get_contents($link);
    $html= urldecode($html);
    $l1=urldecode(str_between($html,'video_url":"','"'));
    /*
    if (!$l1) {
    $l2=urldecode(str_between($html,'autoURL":"','"'));
    $l2=str_replace("\/","/",$l2);
    $h=file_get_contents($l2);
    $l1=str_between($h,'"template":"','"');
    }
    $l="http:\/\/www.dailymotion.com\/cdn\/manifest\/video\/x10mktb.mnft?auth=1373519236-aa7d608692b88ba128f72f5225a77bb0";
    $l=str_replace("\/","/",$l);
    echo $l;
    $t1 = explode('sdURL', $html);
    $sd=urldecode($t1[1]);
    $t1=explode('"',$sd);
    $sd=$t1[2];
    $sd=str_replace("\\","",$sd);
    $n=explode("?",$sd);
    $nameSD=$n[0];
    $nameSD=substr(strrchr($nameSD,"/"),1);
    $t1 = explode('hqURL', $html);
    $hd=urldecode($t1[1]);
    $t1=explode('"',$hd);
    $hd=$t1[2];
    $hd=str_replace("\\","",$hd);
    $n=explode("?",$hd);
    $nameHD=$n[0];
    $nameHD=substr(strrchr($nameHD,"/"),1);
    if ($hd <> "") {
print $hd;
    }
    if (($sd <> "") && ($hd=="")) {
print $sd;
    }
*/
print $l1;
?>
