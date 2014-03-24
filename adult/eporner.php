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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/eporner.png";
  </script>
<channel>
	<title>eporner.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/</link>
</item>
<item><title>Students movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/student+students/</link></item>
<item><title>Group Sex movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/group/</link></item>
<item><title>Anal movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/anal/</link></item>
<item><title>Toys movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/toy+toys/</link></item>
<item><title>Public movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/public/</link></item>
<item><title>Uniform movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/uniform/</link></item>
<item><title>Housewives movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/housewives+housewive/</link></item>
<item><title>Spy cams movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/spy/</link></item>
<item><title>Blowjob movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/Blowjob+Blow+Job/</link></item>
<item><title>Asian movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/asian/</link></item>
<item><title>Teen movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/teen+teens+young/</link></item>
<item><title>Swinger movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/swinger+swingers/</link></item>
<item><title>Threesome movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/threesome/</link></item>
<item><title>Homemade movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/homemade/</link></item>
<item><title>Sleep movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/sleep/</link></item>
<item><title>Dual Penetration movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/dp+dual/</link></item>
<item><title>Hardcore movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/hardcore/</link></item>
<item><title>Big Tits movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/%22big+tits%22/</link></item>
<item><title>Big Cock movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/%22Big+dick%22/</link></item>
<item><title>BDSM movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/bdsm/</link></item>
<item><title>Mature movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/mature/</link></item>
<item><title>Amateur movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/amateur+amateurs/</link></item>
<item><title>Shemale movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/shemale/</link></item>
<item><title>Masturbation movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/masturbation+masturbate/</link></item>
<item><title>Office movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/office/</link></item>
<item><title>Lesbian movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/lesbian+lesbians/</link></item>
<item><title>Handjob movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/handjob/</link></item>
<item><title>Cumshot movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/cum+cumshot/</link></item>
<item><title>Ebony movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/ebony/</link></item>
<item><title>Reality movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/reality/</link></item>
<item><title>Fat movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/fat/</link></item>
<item><title>Older Men movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/%22old+man%22/</link></item>
<item><title>Outdoor movies</title><link><?php echo $host; ?>/scripts/adult/php/eporner.php?query=1,http://www.eporner.com/keywords/outdoor/</link></item>

</channel>
</rss>
