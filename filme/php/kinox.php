#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$query = $_GET["query"];
if($query) {
   $queryArr = explode('@', $query);
   $link = urldecode($queryArr[0]);
   $tit = urldecode($queryArr[1]);
   $tit=str_replace("\\'","'",$tit);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER, "http://www.kinox.to/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);

$descriere = str_between($html,'<div class="Descriptore">','</div>');
$descriere = preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$descriere);
$descriere = str_replace("&nbsp;","",$descriere);

$t0=explode('<div class="Grahpics">',$html);
$t1=explode('src="',$t0[1]);
$t2=explode('?',$t1[1]);
$image=$t2[0];

$imdb = "";

$durata=str_between($html,'<span class="Runtime">','</li>');
$durata = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$durata));
$durata="Length: ".str_replace("&nbsp;","",$durata);

$premiera = "";

$cat=str_between($html,'<span class="Genre">','</li>');
$cat = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$cat));
$cat = str_replace("&nbsp;","",$cat);

$regia=str_between($html,'<span class="Director">','</li>');
$regia ="Regie: ".trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$regia));

$actor="";

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

	echo '
	<item>
		<title>Servers:</title>
		<mediaDisplay name="threePartsView"/>
	</item>
	';
$videos = explode('li id="Hoster', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('rel="',$video);
  $t2=explode('"',$t1[1]);
  $link="http://kinox.to/aGET/Mirror/".$t2[0];
  $link=str_replace("&amp;","&",$link);
  $title=str_between($video,'<div class="Named">','</div>');
  $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/kinox_link.php?file='.urlencode($link).'@'.urlencode($tit);

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
