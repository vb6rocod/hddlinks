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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/moviesand.gif";
  </script>

<channel>
	<title>moviesand</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/page/</link>
</item>
<item><title>Amateur</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/1/</link></item>
<item><title>Anal</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/8/</link></item>
<item><title>Asian</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/11/</link></item>
<item><title>Ass</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/12/</link></item>
<item><title>Babe</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/13/</link></item>
<item><title>Big Dick</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/14/</link></item>
<item><title>Big Tits</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/15/</link></item>
<item><title>BiSexual</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/40/</link></item>
<item><title>Blacks</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/54/</link></item>
<item><title>Blonde</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/16/</link></item>
<item><title>Blowjobs</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/5/</link></item>
<item><title>Brunette</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/18/</link></item>
<item><title>Cartoons</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/41/</link></item>
<item><title>Celebrity</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/20/</link></item>
<item><title>Cumshots</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/6/</link></item>
<item><title>Fat</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/42/</link></item>
<item><title>Funny</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/26/</link></item>
<item><title>GangBang</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/43/</link></item>
<item><title>Gay</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/55/</link></item>
<item><title>Handjob</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/27/</link></item>
<item><title>Hardcore</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/2/</link></item>
<item><title>Interracial</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/29/</link></item>
<item><title>Latina</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/31/</link></item>
<item><title>Lesbian</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/3/</link></item>
<item><title>Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/32/</link></item>
<item><title>Mature</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/33/</link></item>
<item><title>MILF</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/34/</link></item>
<item><title>Party</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/49/</link></item>
<item><title>Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/35/</link></item>
<item><title>Public</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/36/</link></item>
<item><title>Reality</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/37/</link></item>
<item><title>RedHeads</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/51/</link></item>
<item><title>Shemales</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/58/</link></item>
<item><title>Squirting</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/52/</link></item>
<item><title>Striptease</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/38/</link></item>
<item><title>Teen</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/10/</link></item>
<item><title>Toys</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/39/</link></item>
<item><title>Unknown category</title><link><?php echo $host; ?>/scripts/adult/php/moviesand.php?query=1,http://www.moviesand.com/channels/0/</link></item>

</channel>
</rss>
