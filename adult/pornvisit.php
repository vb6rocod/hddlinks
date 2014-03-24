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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/pornvisit.gif";
  </script>
<channel>
	<title>pornvisit.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/page</link>
</item>
<item><title>Amateur</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/amateur.php?page=</link></item>
<item><title>Anal</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/anal.php?page=</link></item>
<item><title>Asian</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/asian.php?page=</link></item>
<item><title>BBW</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/bbw.php?page=</link></item>
<item><title>Big Boobs</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/big-boobs.php?page=</link></item>
<item><title>Big Butts</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/big-butts.php?page=</link></item>
<item><title>Big Dick</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/big-dick.php?page=</link></item>
<item><title>Black</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/black.php?page=</link></item>
<item><title>Blonde</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/blonde.php?page=</link></item>
<item><title>Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/blowjob.php?page=</link></item>
<item><title>Bondage</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/bondage.php?page=</link></item>
<item><title>Brunette</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/brunette.php?page=</link></item>
<item><title>Bukkake</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/bukkake.php?page=</link></item>
<item><title>Celebrity</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/celebrity.php?page=</link></item>
<item><title>Creampie</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/creampie.php?page=</link></item>
<item><title>Cumshot</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/cumshot.php?page=</link></item>
<item><title>Fetish</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/fetish.php?page=</link></item>
<item><title>Group</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/group.php?page=</link></item>
<item><title>Handjob</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/handjob.php?page=</link></item>
<item><title>Hardcore</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/hardcore.php?page=</link></item>
<item><title>Hentai</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/hentai.php?page=</link></item>
<item><title>Interracial</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/interracial.php?page=</link></item>
<item><title>Latina</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/latina.php?page=</link></item>
<item><title>Lesbian</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/lesbian.php?page=</link></item>
<item><title>Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/masturbation.php?page=</link></item>
<item><title>Mature</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/mature.php?page=</link></item>
<item><title>MILF</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/milf.php?page=</link></item>
<item><title>Nasty</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/nasty.php?page=</link></item>
<item><title>Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/pornstar.php?page=</link></item>
<item><title>POV</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/pov.php?page=</link></item>
<item><title>Public</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/public.php?page=</link></item>
<item><title>Redhead</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/redhead.php?page=</link></item>
<item><title>Softcore</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/softcore.php?page=</link></item>
<item><title>Squirt</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/squirt.php?page=</link></item>
<item><title>Teen</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/teen.php?page=</link></item>
<item><title>Vintage</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/vintage.php?page=</link></item>
<item><title>Webcam</title><link><?php echo $host; ?>/scripts/adult/php/pornvisit.php?query=1,http://www.pornvisit.com/videos/webcam.php?page=</link></item>

</channel>
</rss>
