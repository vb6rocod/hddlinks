#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$img = "/usr/local/etc/www/cgi-bin/scripts/clip/image/dailymotion.png";
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
  <?php echo $img; ?>
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
					  annotation = getItemInfo(idx, "title");
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
	<searchLink>
	  <link>
	    <script>"<?php echo $host; ?>/scripts/clip/php/dm_search.php?query=1," + urlEncode(keyword) + "," + urlEncode(keyword);</script>
	  </link>
	</searchLink>
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
<title>dailymotion</title>
<!--
<item>
<title>Căutare</title>
<onClick>
  keyword = getInput();
  if (keyword != null)
  {
    jumpToLink("searchLink");
  }
</onClick>
</item>
-->
<item>
<title>Most viewed videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/visited,Most+viewed+videos</link>
</item>

<item>
<title>Most recent videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/ro,Most+recent+videos</link>
</item>

<item>
<title>Top rated videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/rated,Top+rated+videos</link>
</item>
<!--
<item>
<title>Featured users</title>
<link><?php echo $host; ?>/scripts/clip/php/dm_user_main.php?query=,http://www.dailymotion.com/users/featured</link>
</item>
-->
<item>
<title>Classic black &amp; white movies</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/playlist/x1dqg9_crazedigitalmovies_classic-and-black-white-movies,Classic+black+and+white+movies</link>
</item>

<item>
<title>football</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/creative-official/search/football,football</link>
</item>

<item>
<title>FOX Sports Interactive</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/user/FOX_Sports_Interactive,FOX+Sports+Interactive</link>
</item>

<item>
<title>Animals</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/animals,Animals</link>
</item>

<item>
<title>Arts</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/creation,Arts</link>
</item>

<item>
<title>Auto-Moto</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/auto,Auto-Moto</link>
</item>

<item>

<title>College</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/featured/channel/school,College</link>
</item>

<item>
<title>Featured videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/featured,Featured+videos</link>
</item>

<item>
<title>Film & TV</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/shortfilms,Film</link>
</item>

<item>
<title>Funny</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/fun,Funny</link>
</item>

<item>
<title>Gaming</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/videogames,Gaming</link>
</item>

<item>
<title>HD videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/hd,HD+videos</link>
</item>

<item>
<title>Life & Style</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/lifestyle,Life+and+Style</link>
</item>

<item>
<title>Most visited</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/visited-week,Most+visited</link>
</item>

<item>
<title>Motionmaker videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/creative,Motionmaker+videos</link>
</item>

<item>
<title>Music</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/music,Music</link>
</item>

<item>
<title>News & Politics</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/news,News+and+Politics</link>
</item>

<item>
<title>Official Content videos</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/official,Official+Content+videos</link>
</item>

<item>
<title>People & Family</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/featured/channel/people,People+and+Family</link>
</item>

<item>
<title>Sexy</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/featured/channel/sexy,Sexy</link>
</item>

<item>
<title>Sports & Extreme</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/sport,Sports+and+Extreme</link>
</item>

<item>
<title>Tech & Science</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/tech,Tech+and+Science</link>
</item>

<item>
<title>Travel</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/en/channel/travel,Travel</link>
</item>

<item>
<title>Webcam & Vlogs</title>
<link><?php echo $host; ?>/scripts/clip/php/dm.php?query=,http://www.dailymotion.com/featured/channel/webcam,Webcam+Vlogs</link>
</item>

</channel>
</rss>
