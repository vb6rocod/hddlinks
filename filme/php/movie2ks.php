#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
   $tit=str_replace("\\'","'",$tit);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
$t=explode('<div style="float:left">',$html);
$part=$t[1];
//echo $part;
$descriere = str_between($part,'<div class="moviedescription">','</div>');
$descriere = preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$descriere);
$descriere = str_replace("&nbsp;","",$descriere);

$t1=explode('src="',$part);
$t2=explode('"',$t1[1]);
$image=$t2[0];

$t1=explode("IMDB Rating:",$part);
$t2=explode(">",$t1[1]);
$t3=explode("<",$t2[1]);
$imdb = "IMDB Rating: ".$t3[0];
if (strpos($part,"Length") !==false) {
$t1=explode('Length:',$part);
} else {
$t1=explode('nge:',$part);
}
$t2=explode('|',$t1[1]);
$durata=$t2[0];
$durata = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$durata));
$durata="Length: ".str_replace("&nbsp;","",$durata);
if (strpos($part,"Year") !==false) {
$t1=explode("Year:",$part);
} else {
$t1=explode("Jahr:",$part);
}
$t2=explode("<",$t1[1]);
$premiera = $t2[0];
$premiera = "Year: ".trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$premiera));

$t1=explode("Genre:",$part);
$t2=explode("|",$t1[1]);
$cat=$t2[0];
$cat = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$cat));
$cat = str_replace("&nbsp;","",$cat);
$cat = str_replace(" ","",$cat);
$t1=explode("Regie:",$part);
$t2=explode(">",$t1[1]);
$t3=explode("<",$t2[1]);
$regia=$t3[0];
$regia ="Regie: ".trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$regia));

$t1=explode("Actors:",$part);
$t2=explode("<BR>",$t1[1]);
$actor=$t2[0];
if ($actor == "") {
 $t1=explode("Schauspieler:",$part);
 $t2=explode("<BR>",$t1[1]);
 $actor=$t2[0];
}
$actor = "Actors: ".trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$actor));

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
	itemWidthPC="25"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="25"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
		
  	<text redraw="yes" align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <?php echo $tit; ?>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="22.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
    <?php echo $cat; ?>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="28" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <?php echo $regia; ?>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="33.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
    <?php echo $actor; ?>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="39" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
    <?php echo $durata; ?>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="44.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
    <?php echo $imdb; ?>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="50" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <?php echo $premiera; ?>
		</text>
		<text align="justify" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=35 offsetYPC=57 widthPC=60 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
   <?php echo $descriere; ?>
		</text>
		<image  redraw="yes" offsetXPC=35 offsetYPC=22.5 widthPC=15 heightPC=30>
  <?php echo $image; ?>
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
					  annotation = getItemInfo(idx, "annotation");
					  img = getItemInfo(idx,"image");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
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

$videos = explode('<tr id="tablemoviesindex2"', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1 = explode('href="', $video);
    $t2 = explode('"', $t1[1]);
    $link = "http://www.movie2k.to/".$t2[0];

    $t1 = explode('src="', $video);
    $t2 = explode('>', $t1[1]);
    $t3=explode('<',$t2[1]);
    $title = $t3[0];
    $title="Server: ".trim(str_replace("&nbsp;","",$title));

    $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme1_link.php?file='.$link.','.urlencode($tit);

    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
}

?>

</channel>
</rss>
