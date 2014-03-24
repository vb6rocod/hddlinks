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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/snizzshare.jpg";
  </script>
<channel>
	<title>snizzshare.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/</link>
</item>
<item><title>Amateur User Submitted Video</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/64/amateur-user-submitted-video/</link></item>
<item><title>Amateurs</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/2/amateurs/</link></item>
<item><title>Anal</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/3/anal/</link></item>
<item><title>Anime</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/4/anime/</link></item>
<item><title>Asians</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/5/asians/</link></item>
<item><title>Babes</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/8/babes/</link></item>
<item><title>BBW</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/6/bbw/</link></item>
<item><title>BDSM</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/7/bdsm/</link></item>
<item><title>Big Dicks</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Big Tits</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Bizarre</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Blondes</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Blowjobs</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/3</link></item>
<item><title>Booty</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/9/booty/</link></item>
<item><title>Brazilian</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/6</link></item>
<item><title>Brunettes</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Celeb</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>CFNM</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/54/cfnm/</link></item>
<item><title>Cheerleaders</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Cream Pies</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Cumshots</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/53/cumshots/</link></item>
<item><title>Ebony</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Euro Girls</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/49/euro-girls/</link></item>
<item><title>Extreme</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/59/extreme/</link></item>
<item><title>Facials</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>Feet</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/20/feet/</link></item>
<item><title>Fetish</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/45/fetish/</link></item>
<item><title>Fisting</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/2</link></item>
<item><title>Full Length Long Porn Movies</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/65/full-length-long-porn-movies/</link></item>
<item><title>Gay</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/46/gay/</link></item>
<item><title>Goldenshowers</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/57/goldenshowers/</link></item>
<item><title>Group Sex</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/22/group-sex/</link></item>
<item><title>Hairy</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/23/hairy/</link></item>
<item><title>Hand Jobs</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/24/hand-jobs/</link></item>
<item><title>Hardcore</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/62/hardcore/</link></item>
<item><title>Humor</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/48/humor/</link></item>
<item><title>Indians</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/25/indians/</link></item>
<item><title>Interracial</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/26/interracial/</link></item>
<item><title>Latinas</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/27/latinas/</link></item>
<item><title>Lesbian</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/28/lesbian/</link></item>
<item><title>Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/30/masturbation/</link></item>
<item><title>Midgets</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/60/midgets/</link></item>
<item><title>MILFS</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/29/milfs/</link></item>
<item><title>Nude Female Bodybuilders</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/63/nude-female-bodybuilders/</link></item>
<item><title>Orgy</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/58/orgy/</link></item>
<item><title>Panties</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/33/panties/</link></item>
<item><title>Porn Stars</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/34/porn-stars/</link></item>
<item><title>POV</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/32/pov/</link></item>
<item><title>Pregnant</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/35/pregnant/</link></item>
<item><title>Public Nudity</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/36/public-nudity/</link></item>
<item><title>Reality</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/37/reality/</link></item>
<item><title>Redheads</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/38/redheads/</link></item>
<item><title>Sexy Commercials</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/52/sexy-commercials/</link></item>
<item><title>Sexy Girls</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/55/sexy-girls/</link></item>
<item><title>Shemales</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/47/shemales/</link></item>
<item><title>Small Tits</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/39/small-tits/</link></item>
<item><title>Squirting</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/40/squirting/</link></item>
<item><title>Teens</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/</link></item>
<item><title>The Violence Channel</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/56/the-violence-channel/</link></item>
<item><title>Toys</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/4</link></item>
<item><title>Uniforms</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/42/uniforms/</link></item>
<item><title>Vintage</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/43/vintage/</link></item>
<item><title>Voyeur</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/44/voyeur/</link></item>
<item><title>Webcams</title><link><?php echo $host; ?>/scripts/adult/php/snizzshare.php?query=1,http://www.snizzshare.com/channels/5</link></item>

</channel>
</rss>
