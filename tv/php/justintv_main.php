#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
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
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
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
  image/tv_radio.png
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

    <title>Justin.tv</title>

<item>
<title>Justin.tv - favorite list</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv_fav.php</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - all</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - entertainment</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,entertainment</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - producers</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,featured</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>Justin.tv - mobile</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,mobile</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>Justin.tv - social</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,social</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - gaming</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,gaming</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - sports</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,sports</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - news</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,news</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - animals</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,animals</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - science</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,science_tech</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Justin.tv - other</title>
<link><?php echo $host; ?>/scripts/tv/php/justintv.php?query=1,other</link>
<media:thumbnail url="image/tv_radio.png" />
<mediaDisplay name="threePartsView"/>
</item>

</channel>
</rss>                                                                                                                             
