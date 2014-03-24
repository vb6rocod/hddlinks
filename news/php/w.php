#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0">
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$query = $_GET["q"];
if($query) {
   $queryArr = explode(',', $query);
   $loc = $queryArr[0];
   $id = $queryArr[1];
}
//http://vremea.meteoromania.ro/prognoza/Braila
$link="http://vremea.meteoromania.ro/prognoza/".$loc;
$html = file_get_contents($link);
//$bg="http://vremea.meteoromania.ro/sites/all/themes/meteo/images/bg_big.jpg";
// Conditii curente
$t1=explode('<td class="white2">',$html);
$t2=explode('</td>',$t1[1]);
$cond=explode("<br/>",$t2[0]);
$vant_cur=trim($cond[0]);
$pres_cur=trim($cond[1]);
$hum_cur=trim($cond[2]);
$ir_cur=trim($cond[3]);
//info actuale
$t1=explode('class="titlu"',$html);
$t2=explode(">",$t1[1]);
$t3=explode("<",$t2[1]);
$timp_cur=$t3[0];
$t1=explode('src="',$html);
$t2=explode('"',$t1[2]);
$img_cur="http://vremea.meteoromania.ro".$t2[0];
$t2=explode('title="',$t1[2]);
$t3=explode('"',$t2[1]);
$desc_cur=$t3[0];
$t1=explode('<div id="loc" class="vizibil">',$html);
$t2=explode('-->',$t1[1]);
$t3=explode('<',$t2[1]);
$loc=$t3[0];
$t4=explode('</div>',$t1[1]);
$t5=explode('</td>',$t4[1]);
$temp_cur=str_replace("&deg;","",trim($t5[0]));


//===================================

//Prognoza
$d=explode('<td background="/sites/all/themes/meteo/images/bg_prognoza_up.jpg"',$html);
// Get day name
$days=$d[1];
$day=explode('td align="center" class="titlu"',$days);
// Day 1
$t1=explode(">",$day[1]);
$t2=explode("<",$t1[1]);
$day1_name=$t2[0];
// Day 2
$t1=explode(">",$day[2]);
$t2=explode("<",$t1[1]);
$day2_name=$t2[0];
// Day 3
$t1=explode(">",$day[3]);
$t2=explode("<",$t1[1]);
$day3_name=$t2[0];
//Valori prognoza
$days=$d[3];
//Imagine
$t1=explode('src="',$days);
$t2=explode('"',$t1[1]);
$img_day1="http://vremea.meteoromania.ro".$t2[0];
$t2=explode('"',$t1[2]);
$img_day2="http://vremea.meteoromania.ro".$t2[0];
$t2=explode('"',$t1[3]);
$img_day3="http://vremea.meteoromania.ro".$t2[0];
//descriere
$t1=explode('title="',$days);
$t2=explode('"',$t1[1]);
$day1_desc=$t2[0];
$t2=explode('"',$t1[2]);
$day2_desc=$t2[0];
$t2=explode('"',$t1[3]);
$day3_desc=$t2[0];
//min max
$a1=explode("<br>",$t1[1]);
$day1_max=str_replace("&","",trim($a1[1]));
$a2=explode("</td>",$a1[2]);
$day1_min=str_replace("&","",trim($a2[0]));
$a1=explode("<br>",$t1[2]);
$day2_max=str_replace("&","",trim($a1[1]));
$a2=explode("</td>",$a1[2]);
$day2_min=str_replace("&","",trim($a2[0]));
$a1=explode("<br>",$t1[3]);
$day3_max=str_replace("&","",trim($a1[1]));
$a2=explode("</td>",$a1[2]);
$day3_min=str_replace("&","",trim($a2[0]));
//==========================================================

?>
<mediaDisplay  name="onePartView"
sideLeftWidthPC="0"
sideRightWidthPC="0"
backgroundColor="0:0:0"
showHeader="no"
showDefaultInfo="no"
headerImageWidthPC="0"
selectMenuOnRight="no"
autoSelectMenu="no"
autoSelectItem="no"
idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10" >
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>

		<backgroundDisplay>
			<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
   /usr/local/etc/www/cgi-bin/scripts/news/image/vremea_bg.jpg
			</image>
		</backgroundDisplay> -->
<text  redraw="yes" align="center" offsetXPC="5" offsetYPC="5" widthPC="50" heightPC="8" fontSize="17" backgroundColor="0:64:128" foregroundColor="100:200:255">
<?php echo $timp_cur; ?>
</text>
<image offsetXPC=5 offsetYPC=15 widthPC=10 heightPC=16>
<?php echo $img_cur; ?>
</image>
<text align="left" offsetXPC="15" offsetYPC="15" widthPC="40" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
Temperatura curentă:<?php echo str_replace("deg;"," ",$temp_cur); ?>
</text>
<text align="left" lines="2" offsetXPC="15" offsetYPC="20" widthPC="40" heightPC="10" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $desc_cur; ?>
</text>

<text  redraw="yes" align="center" offsetXPC="5" offsetYPC="35" widthPC="50" heightPC="8" fontSize="17" backgroundColor="0:64:128" foregroundColor="100:200:255">
Informaţii suplimentare
</text>
<text align="left" offsetXPC="5" offsetYPC="44" widthPC="20" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
Viteza vântului:
</text>
 <text align="left" offsetXPC="25" offsetYPC="44" widthPC="30" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $vant_cur; ?>
</text>
<text align="left" offsetXPC="5" offsetYPC="49" widthPC="20" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
Umiditate:
</text>
 <text align="left" offsetXPC="25" offsetYPC="49" widthPC="30" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $hum_cur; ?>
</text>
<text align="left" offsetXPC="5" offsetYPC="54" widthPC="20" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
Presiunea:
</text>
 <text align="left" offsetXPC="25" offsetYPC="54" widthPC="30" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $pres_cur; ?>
</text>
<text align="left" offsetXPC="5" offsetYPC="59" widthPC="20" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
IR:
</text>
 <text align="left" offsetXPC="25" offsetYPC="59" widthPC="30" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $ir_cur; ?>
</text>


<image offsetXPC=60 offsetYPC=15 widthPC=10 heightPC=16>
<?php echo $img_day1; ?>
</image>
<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="5" widthPC="35" heightPC="8" fontSize="17" backgroundColor="0:64:128" foregroundColor="100:200:255">
<?php echo $day1_name; ?>
</text>
<text  redraw="yes" align="left" lines="2" offsetXPC="70" offsetYPC="24" widthPC="25" heightPC="10" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $day1_desc; ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="14" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day1_max); ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="19" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day1_min); ?>
</text>

<image offsetXPC=60 offsetYPC=45 widthPC=10 heightPC=16>
<?php echo $img_day2; ?>
</image>
<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="35" widthPC="35" heightPC="8" fontSize="17" backgroundColor="0:64:128" foregroundColor="100:200:255">
<?php echo $day2_name; ?>
</text>
<text  redraw="yes" align="left" lines="2" offsetXPC="70" offsetYPC="54" widthPC="25" heightPC="10" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $day2_desc; ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="44" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day2_max); ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="49" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day2_min); ?>
</text>

<image offsetXPC=60 offsetYPC=75 widthPC=10 heightPC=16>
<?php echo $img_day3; ?>
</image>
<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="65" widthPC="35" heightPC="8" fontSize="17" backgroundColor="0:64:128" foregroundColor="100:200:255">
<?php echo $day3_name; ?>
</text>
<text  redraw="yes" align="left" lines="2" offsetXPC="70" offsetYPC="84" widthPC="25" heightPC="10" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo $day3_desc; ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="74" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day3_max); ?>
</text>
<text  redraw="yes" align="left" offsetXPC="70" offsetYPC="79" widthPC="25" heightPC="5" fontSize="14" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
<?php echo str_replace("deg;"," ",$day3_min); ?>
</text>

<text  redraw="yes" align="center" offsetXPC="5" offsetYPC="70" widthPC="50" heightPC="18" fontSize="24" backgroundColor="-1:-1:-1" foregroundColor="0:0:0">
Localitate: <?php echo $loc; ?>
</text>
<onUserInput>
<script>
      ret = "false";
      if(userInput == "right" || userInput == "R")
      {
        ret = "true";
      }
      ret;
</script>
</onUserInput>
</mediaDisplay>
<channel>
	<title>Vremea</title>
</channel>
</rss>
