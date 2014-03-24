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
		<!--<image offsetXPC=5 offsetYPC=2 widthPC=20 heightPC=16>
		  <script>channelImage;</script>
		</image>-->
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
  <script>channelImage;</script>
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
<script>
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/sexbot.png";
  </script>
<channel>
	<title>sexbot.com</title>
	<menu>main menu</menu>



<item><title>Porn videos</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/videos/</link></item>
<item><title>Amateur Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/amateur/</link></item>
<item><title>Anal Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/anal/</link></item>
<item><title>Asian Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/asian/</link></item>
<item><title>Babe Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/babe/</link></item>
<item><title>Big Ass Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/big_ass/</link></item>
<item><title>Big Cocks Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/big_cocks/</link></item>
<item><title>Big Tits Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/big_tits/</link></item>
<item><title>Black Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/black/</link></item>
<item><title>Blowjobs Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/blowjobs/</link></item>
<item><title>Camel Toe Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/camel_toe/</link></item>
<item><title>College Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/college/</link></item>
<item><title>Creampie Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/creampie/</link></item>
<item><title>Cum Shots Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/cum_shots/</link></item>
<item><title>Deep Throat Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/deep_throat/</link></item>
<item><title>DP Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/dp/</link></item>
<item><title>Euro Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/euro/</link></item>
<item><title>Fetish Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/fetish/</link></item>
<item><title>Foot Fetish Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/foot_fetish/</link></item>
<item><title>Gang Bang Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/gang_bang/</link></item>
<item><title>Group Sex Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/group_sex/</link></item>
<item><title>Hardcore Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/hardcore/</link></item>
<item><title>Homemade Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/homemade/</link></item>
<item><title>Housewife Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/housewife/</link></item>
<item><title>Interracial Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/interracial/</link></item>
<item><title>Latina Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/latina/</link></item>
<item><title>Lesbian Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/lesbian/</link></item>
<item><title>Mature Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/mature/</link></item>
<item><title>MILF Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/milf/</link></item>
<item><title>Outdoor Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/outdoor/</link></item>
<item><title>POV Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/pov/</link></item>
<item><title>Reality Porn Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/reality_porn/</link></item>
<item><title>Sleeping Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/sleeping/</link></item>
<item><title>Squirting Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/squirting/</link></item>
<item><title>Teen (18+) Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/teen/</link></item>
<item><title>Threesome Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/threesome/</link></item>
<item><title>Tranny Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/tranny/</link></item>
<item><title>Vintage Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/vintage/</link></item>
<item><title>Workout Porn</title><link><?php echo $host; ?>/scripts/adult/php/sexbot.php?query=1,http://www.sexbot.com/category/videos/workout/</link></item>

</channel>
</rss>
