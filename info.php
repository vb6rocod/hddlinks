#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
set_time_limit(60);
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function is_valid_date($value, $format = 'dd.mm.yyyy'){
    if(strlen($value) >= 6 && strlen($format) == 10){

        // find separator. Remove all other characters from $format
        $separator_only = str_replace(array('m','d','y'),'', $format);
        $separator = $separator_only[0]; // separator is first character

        if($separator && strlen($separator_only) == 2){
            // make regex
            $regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
            $regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
            $regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
            $regexp = str_replace($separator, "\\" . $separator, $regexp);
            if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){

                // check date
                $arr=explode($separator,$value);
                $day=$arr[0];
                $month=$arr[1];
                $year=$arr[2];
                if(@checkdate($month, $day, $year))
                    return true;
            }
        }
    }
    return false;
}
function uploadc($n_func,$html_cod) {
  $f=explode("return p}",$html_cod);
  $e=explode("'.split",$f[$n_func]);
  $ls=$e[0];
  //echo $ls;
  $a=explode("'",$ls);
  //print_r($a); //for debug only
  $a1=explode("'",$a[count($a)-1]); //char list for replace
  $b1=explode(",",$a1[1]);
  $base_enc=$a[4];
  //echo $base_enc;
  $w=explode("|",$a[count($a)-1]);
  //print_r ($w);
  $fl="";
  for ($i=0;$i<strlen($base_enc)-1;$i++) {
    $b=$base_enc[$i];
    if ($w[$b])
    $fl=$fl.$w[$b];
    else
    $fl=$fl.$base_enc[$i];
  }
return $fl;
}
$mod=$_GET["mod"];
$host = "http://127.0.0.1/cgi-bin";
$l="/usr/local/etc/dvdplayer/update.txt";
$h=file_get_contents($l);
$t=explode("\n",$h);
$player_tip=trim($t[0]);
if (!$player_tip) $player_tip=0; // eboda
$p=$_SERVER['SCRIPT_FILENAME'];
$script_directory = substr($p, 0, strrpos($p, '/'));
$f_version=$script_directory."/version.txt";
if (file_exists($f_version)) {
  $curr_vers=trim(file_get_contents($script_directory."/version.txt"));
  $l="http://hdforall.googlecode.com/hg/version.txt";
  $l="http://hdforall.freehostia.com/version.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h = curl_exec($ch);
  curl_close($ch);
  $t=explode("\n",$h);
  $avb_vers=trim($t[0]);
  $serv_update=trim($t[1]);
  $mod_update=trim($t[2]);
$valid_date = is_valid_date($avb_vers);
if ($valid_date) {
if ($avb_vers <> $curr_vers) {
  $info = "O nouă versiune este disponibilă (".$avb_vers.")!";
} else {
  $info = "Sfat: Folosiţi tastele PREV/NEXT pentru o navigare mai uşoară.";
}
} else {
  $info="Eroare citire data versiune disponibila!";
}

if (($mod=="update"  && $avb_vers <> $curr_vers) || $mod=="update1") {  //auto-update
if ($valid_date) {
if ($mod_update == "direct")
  $server_update=$serv_update;
else if ($mod_update=="uploadc") {
 //http://www.uploadc.com/download-t8hutdje8y8f.html
 $ch1 = curl_init($serv_update);
 curl_setopt($ch1, CURLOPT_FOLLOWLOCATION  ,1);
 curl_setopt($ch1, CURLOPT_REFERER, $serv_update);
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
 $h = curl_exec($ch1);
 curl_close($ch1);
 //echo $h;
 $server_update=uploadc(1,$h);
}
$l="http://127.0.0.1/cgi-bin/scripts/update.cgi?player=".$player_tip.";server=".$server_update.";name=".$mod_update.";";
$h=file_get_contents($l);
$curr_vers=trim(file_get_contents($script_directory."/version.txt"));
if ($avb_vers <> $curr_vers) {
  $info = "O nouă versiune este disponibilă (".$avb_vers.")! Eroare de actualizare!";
} else {
  $info = "Sfat: Folosiţi tastele PREV/NEXT pentru o navigare mai uşoară.";
}
}
}
////////////////////////////////////////////////////////////////////////
if ($player_tip < 2) {  //numai eboda si iconbit
$f = "/usr/local/bin/home_menu";
if (file_exists($f)) {
  $file = "/usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss";
  $h=file_get_contents($file);
  if (strpos($h,"eboda") === false) {
    exec("cp /usr/local/etc/www/cgi-bin/scripts/filme/videoRenderer.rss /usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
    exec("cp /usr/local/etc/www/cgi-bin/scripts/filme/videoRenderer_h.rss /usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_h.rss");
  }
}
}
}
print $info;
?>
