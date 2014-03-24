#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["file"];
$queryarr = explode(",",$query);
$serieLink = $queryarr[0];
$serieTitle = urldecode($queryarr[1]);
$content = file_get_contents($serieLink . "about.html");
$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
$input = str_replace($newlines, "", $content);

//Get header image, description and cover
$image = "image/movies.png";
preg_match("/<div class\=\"header\-middle\" style\=\"background:url\((.*)\)\;(.*)<img src\=\"(.*)\"(.*)>(.*)<div style\=\"margin\-bottom\:10px\;\">(.*)<\/div>/U", $input, $div);
if($div) {
    $headerImage = $div[1];
    $image = $div[3];
    $description = $div[6];
}
echo "<?xml version='1.0' encoding='UTF8' ?>";
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
	itemWidthPC="45"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="45"
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

		<text align="center" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=30>
  <?php echo $image; ?>
		</image>
		<idleImage> image/POPUP_LOADING_01.png </idleImage>
		<idleImage> image/POPUP_LOADING_02.png </idleImage>
		<idleImage> image/POPUP_LOADING_03.png </idleImage>
		<idleImage> image/POPUP_LOADING_04.png </idleImage>
		<idleImage> image/POPUP_LOADING_05.png </idleImage>
		<idleImage> image/POPUP_LOADING_06.png </idleImage>
		<idleImage> image/POPUP_LOADING_07.png </idleImage>
		<idleImage> image/POPUP_LOADING_08.png </idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
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
	<title><?php echo $serieTitle; ?></title>
	<menu>main menu</menu>
<?php
//--------------------------------------------------------------------------
// GET SEASONS AND EPISODES
$content = file_get_contents($serieLink. "sitemap.xml");
$newlines = array("\t", "\n", "\r", "\x20\x20", "\0", "\x0B");
$input = str_replace($newlines, "",$content);
//$input = strstr($input, "<td valign=\"top\" width=\"33%\">");
preg_match_all("/<loc>(.*)<\/loc>/siU", $input, $div);
if ($div) {
    $div = $div[1];
    $links = array();
    for ($i = count($div); $i >= 0; --$i) {
        $value = $div[$i];
        if (strpos($value, "Episode_")) {
            preg_match_all("/(.*)_Online_Season_(.*)_Episode_(.*)_(.*)\.html/siU", $value, $links);
            $seasonNum = $links[2];
            $episodeNum = $links[3];
            $episodeName = $links[4];
            $title = "Episode ".$seasonNum[0]."-".$episodeNum[0]." ".str_replace("_"," ",$episodeName[0]);
            $link = $host."/scripts/filme/php/10starmovies_link.php?file=".$value.",".urlencode($serieTitle." - ".$title);
              echo '
  <item>
  <title>'.$title.'</title>
  <link>'.$link.'</link>
  <annotation>'.str_replace("_"," ",$episodeName[0]).'</annotation>
  <media:thumbnail url="'.$image.'" />
  <mediaDisplay name="threePartsView"/>
  </item>
  ';
        }
    }
}
?>
</channel>
</rss>
