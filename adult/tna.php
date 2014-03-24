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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/TnaFlix.png";
  </script>
<channel>
	<title>tnaflix.com</title>
	<menu>main menu</menu>
	
<item>
	<title>Most Recent</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/video.php?page=</link>
</item>

<item>
	<title>Amateur</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/amateur-porn/most-recent/</link>
</item>

<item>
	<title>Anal &amp; Ass</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/anal-porn/most-recent/</link>
</item>

<item>
	<title>Asians</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/asian-porn/most-recent/</link>
</item>

<item>
	<title>Babes</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/babe-videos/most-recent/</link>
</item>

<item>
	<title>BBW</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/bbw-porn/most-recent/</link>
</item>

<item>
	<title>Bizarre</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/bizarre-porn/most-recent/</link>
</item>

<item>
	<title>Blonde</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/blonde-porn/most-recent/</link>
</item>

<item>
	<title>Brunette</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/brunette-porn/most-recent/</link>
</item>

<item>
	<title>Cartoon</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/cartoon-porn/most-recent/</link>
</item>

<item>
	<title>Classic</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/classic-porn/most-recent/</link>
</item>

<item>
	<title>Creampie</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/creampie-videos/most-recent/</link>
</item>

<item>
	<title>Cumshots</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/cum-videos/most-recent/</link>
</item>

<item>
	<title>Double Penetration</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/double-penetration/most-recent/</link>
</item>

<item>
	<title>Ebony</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/ebony-porn/most-recent/</link>
</item>

<item>
	<title>Euro Porn</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/euro-porn/most-recent/</link>
</item>

<item>
	<title>Facial Cum Shots</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/facial-porn/most-recent/</link>
</item>

<item>
	<title>Fat Girls</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/fat-porn/most-recent/</link>
</item>

<item>
	<title>Fetish Sex</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/fetish-videos/most-recent/</link>
</item>

<item>
	<title>Fisting</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/fisting-videos/most-recent/</link>
</item>

<item>
	<title>Foot Fetish</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/feet-porn/most-recent/</link>
</item>

<item>
	<title>Gang Bang</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/gang-bang/most-recent/</link>
</item>

<item>
	<title>Gay / Bi-Male</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/gay-porn/most-recent/</link>
</item>

<item>
	<title>Granny</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/granny-porn/most-recent/</link>
</item>

<item>
	<title>Group Sex</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/group-sex/most-recent/</link>
</item>

<item>
	<title>Hairy</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/hairy-porn/most-recent/</link>
</item>

<item>
	<title>Hardcore Porn</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/hardcore-porn/most-recent/</link>
</item>

<item>
	<title>Hentai</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/hentai-porn/most-recent/</link>
</item>

<item>
	<title>Home made</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/homemade-porn/most-recent/</link>
</item>

<item>
	<title>Huge Cocks</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/big-cock/most-recent/</link>
</item>

<item>
	<title>Huge Tits</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/big-boobs/most-recent/</link>
</item>

<item>
	<title>Indian</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/indian-porn/most-recent/</link>
</item>

<item>
	<title>Interracial</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/interracial-porn/most-recent/</link>
</item>

<item>
	<title>Latinas</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/latina-porn/most-recent/</link>
</item>

<item>
	<title>Lesbian</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/lesbian-porn/most-recent/</link>
</item>

<item>
	<title>Masturbation</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/masturbation-videos/most-recent/</link>
</item>

<item>
	<title>Mature</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/mature-porn/most-recent/</link>
</item>

<item>
	<title>MILF </title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/milf-porn/most-recent/</link>
</item>

<item>
	<title>Blowjobs &amp; Oral Sex</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/blowjob-videos/most-recent/</link>
</item>

<item>
	<title>Petite</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/petite-porn/most-recent/</link>
</item>

<item>
	<title>Piss</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/piss-videos/most-recent/</link>
</item>

<item>
	<title>POV</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/pov-porn/most-recent/</link>
</item>

<item>
	<title>Pregnant </title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/pregnant-porn/most-recent/</link>
</item>

<item>
	<title>Public</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/public-porn/most-recent/</link>
</item>

<item>
	<title>Reality Porn</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/reality-porn/most-recent/</link>
</item>

<item>
	<title>Redhead</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/redhead-porn/most-recent/</link>
</item>

<item>
	<title>Sex Toys</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/toy-videos/most-recent/</link>
</item>

<item>
	<title>Shemale/Trans</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/shemale-porn/most-recent/</link>
</item>

<item>
	<title>Softcore</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/softcore-videos/most-recent/</link>
</item>

<item>
	<title>Spanking</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/spanking-videos/most-recent/</link>
</item>

<item>
	<title>Squirting</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/squirting-videos/most-recent/</link>
</item>

<item>
	<title>Storyline</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/storyline-porn/most-recent/</link>
</item>

<item>
	<title>Teens 18+</title>
	<link><?php echo $host; ?>/scripts/adult/php/tna.php?query=1,http://www.tnaflix.com/teen-porn/most-recent/</link>
</item>

</channel>
</rss>
