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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/pornomovies.jpg";
  </script>
<channel>
	<title>pornomovies.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/video/list/feature/</link>
</item>
<item><title>amateur</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/amateur/</link></item>
<item><title>anal</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/anal/</link></item>
<item><title>anime</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/anime/</link></item>
<item><title>asian</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/asian/</link></item>
<item><title>babes</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/babes/</link></item>
<item><title>BBW</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/BBW/</link></item>
<item><title>Big Tits</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Big Tits/</link></item>
<item><title>bisexual</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/bisexual/</link></item>
<item><title>black ebony</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/black ebony/</link></item>
<item><title>blonde</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/blonde/</link></item>
<item><title>bondage</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/bondage/</link></item>
<item><title>brunette</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/brunette/</link></item>
<item><title>busty</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/busty/</link></item>
<item><title>celebrity</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/celebrity/</link></item>
<item><title>creampie</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/creampie/</link></item>
<item><title>cum shots</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/cum shots/</link></item>
<item><title>female-masturbation</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/female-masturbation/</link></item>
<item><title>fetish</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/fetish/</link></item>
<item><title>gay</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/gay/</link></item>
<item><title>group orgy</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/group orgy/</link></item>
<item><title>hardcore</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/hardcore/</link></item>
<item><title>housewives</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/housewives/</link></item>
<item><title>interracial</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/interracial/</link></item>
<item><title>Latina</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Latina/</link></item>
<item><title>lesbians</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/lesbians/</link></item>
<item><title>male-masturbation</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/male-masturbation/</link></item>
<item><title>mature</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/mature/</link></item>
<item><title>Oral</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Oral/</link></item>
<item><title>Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Pornstar/</link></item>
<item><title>Public</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Public/</link></item>
<item><title>Red Heads</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Red Heads/</link></item>
<item><title>She Males</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/She Males/</link></item>
<item><title>Small Tits</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Small Tits/</link></item>
<item><title>Softcore</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Softcore/</link></item>
<item><title>Teen</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Teen/</link></item>
<item><title>Toys</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Toys/</link></item>
<item><title>Upskirt</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Upskirt/</link></item>
<item><title>Voyeur</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Voyeur/</link></item>
<item><title>Webcams</title><link><?php echo $host; ?>/scripts/adult/php/pornomovies.php?query=1,http://pornomovies.com/channel/Webcams/</link></item>

</channel>
</rss>
