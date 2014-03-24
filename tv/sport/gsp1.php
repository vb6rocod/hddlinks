#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$tit = $_GET["query"];
$tit=urldecode($tit);
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>

<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	
	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="8"
	itemYPC="25"
	itemWidthPC="50"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="50"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
		
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
		/usr/local/etc/www/cgi-bin/scripts/tv/image/gsp.png
		</image>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx) 
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "16"; else "14";
  				</script>
				</fontSize>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "10:80:120"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "140:140:140";
  				</script>
			  </foregroundColor>
			</text>

		</itemDisplay>
		
<onUserInput>
<script>
ret = "false";
userInput = currentUserInput();

if (userInput == "pagedown" || userInput == "pageup")
{
  idx = Integer(getFocusItemIndex());
  if (userInput == "pagedown")
  {
    idx -= -8;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 8;
    if(idx &lt; 0)
      idx = 0;
  }

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  redrawDisplay();
  "true";
}
ret;
</script>
</onUserInput>
		
	</mediaDisplay>
	
	<item_template>
		<mediaDisplay  name="threePartsView" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		</mediaDisplay>

	</item_template>

<channel>
	<title><?php echo $tit; ?></title>
	<menu>main menu</menu>


<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
include ("../../common.php");
$html = file_get_contents("http://tv.gsp.ro/");
if ($tit == "Fotbal Intern") {
  $html=str_between($html,'<h2>Fotbal Intern</h2>','big-thumb-liga1');
  $sep="dumalacategorie";
} elseif ($tit=="LIGA I") {
  $html=str_between($html,'<div id="liga1info">','big-thumb-liga1');
  $sep="dumalaetapa";
} elseif ($tit=="International"){
  $html=str_between($html,'<h2>International</h2>','big-thumb-liga1');
  $sep="dumalacategorie";
} elseif ($tit=="Sporturi") {
  $html=str_between($html,'<h2>Sporturi</h2>','big-thumb-liga1');
  $sep= "dumalacategorie";
} elseif ($tit=="Emisiuni GSPTV") {
  $html=str_between($html,'<h2>Emisiuni GSPTV</h2>','emisiuni_gsptv_descriere');
  $sep="dumalaemisiunea";
}

$videos = explode($sep, $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
    $t1 = explode('(', $video);
    $t2 = explode(')', $t1[1]);
    $t3 = explode(",",$t2[0]);
    //dumalacategorie(0, 1)
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&categorii=1&superCategoria=1
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&categorii=2&superCategoria=1
    //dumalaetapa(0)
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&etapa=1
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&etapa=2
    //dumalacategorie(0, 2)
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&categorii=1&superCategoria=2
    //dumalacategorie(0, 4)
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&categorii=1&superCategoria=4
    //dumalaemisiunea(0)
    //http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&emisiuni=1
    $supercat = trim($t3[1]);
    $cat=trim($t3[0]);
    $t3 = explode('>', $t1[1]);
    $t4 = explode('<', $t3[1]);
    $title = trim($t4[0]);
    $title=fix_s($title);
    if ($sep == "dumalacategorie") {
      $cat=$cat+1;
      $link="http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&categorii=".$cat."&superCategoria=".$supercat;
    } elseif ($sep=="dumalaetapa") {
      $cat=$cat +1;
      $link="http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&etapa=".$cat;
    } elseif ($sep == "dumalaemisiunea") {
      $cat=$cat +1;
      $link="http://tv.gsp.ro/ajax.php?ajax=1&sens=-1&emisiuni=".$cat;
     }
    $link = $host."/scripts/tv/sport/gsp2.php?query=".urlencode($link).",".urlencode($title);
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$link.'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
}

?>

</channel>
</rss>
