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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/flytube.jpg";
  </script>

<channel>
	<title>flytube.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/newest-clips/</link>
</item>
<item><title>40 Inch Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/40-Inch-Ass-</link></item>
<item><title>Amateur Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Amateur-Blowjob-</link></item>
<item><title>Amateur Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Amateur-Porn-</link></item>
<item><title>Anal Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Anal-Fucking-</link></item>
<item><title>Anal Ramming</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Anal-Ramming-</link></item>
<item><title>Anal Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Anal-Xxx-</link></item>
<item><title>Asian Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Asian-Babe-</link></item>
<item><title>Asian Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Asian-Pornstar-</link></item>
<item><title>Asian Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Asian-Pussy-</link></item>
<item><title>Asian Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Asian-Xxx-</link></item>
<item><title>Ass Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ass-Fucking-</link></item>
<item><title>Ass Licking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ass-Licking-</link></item>
<item><title>Ass Ramming</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ass-Ramming-</link></item>
<item><title>Ass to Mouth</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ass-to-Mouth-</link></item>
<item><title>Babe in Pigtails</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Babe-in-Pigtails-</link></item>
<item><title>Babe in Stockings</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Babe-in-Stockings-</link></item>
<item><title>Babe in Thong</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Babe-in-Thong-</link></item>
<item><title>Ball Licking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ball-Licking-</link></item>
<item><title>Bedroom Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Bedroom-Fucking-</link></item>
<item><title>Bedroom Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Bedroom-Sex-</link></item>
<item><title>Bedroom Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Bedroom-Xxx-</link></item>
<item><title>Big Black Cock</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Black-Cock-</link></item>
<item><title>Big Cock Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Cock-Blowjob-</link></item>
<item><title>Big Cock Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Cock-Fucking-</link></item>
<item><title>Big Cock Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Cock-Sex-</link></item>
<item><title>Big Dick Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Dick-Fucking-</link></item>
<item><title>Big Juicy Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Juicy-Ass-</link></item>
<item><title>Big Natural Tits</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Natural-Tits-</link></item>
<item><title>Big Naturals</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Naturals-</link></item>
<item><title>Big Round Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Big-Round-Ass-</link></item>
<item><title>Black Cock Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Black-Cock-Fucking-</link></item>
<item><title>Black Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Black-Pornstar-</link></item>
<item><title>Black Stockings</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Black-Stockings-</link></item>
<item><title>Blonde Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Babe-</link></item>
<item><title>Blonde Milf</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Milf-</link></item>
<item><title>Blonde Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Pornstar-</link></item>
<item><title>Blonde Teen</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Teen-</link></item>
<item><title>Blonde Teen Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Teen-Babe-</link></item>
<item><title>Blonde Teen Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blonde-Teen-Pornstar-</link></item>
<item><title>Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Blowjob-</link></item>
<item><title>Brunette Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Babe-</link></item>
<item><title>Brunette Milf</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Milf-</link></item>
<item><title>Brunette Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Pornstar-</link></item>
<item><title>Brunette Slut</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Slut-</link></item>
<item><title>Brunette Teen</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Teen-</link></item>
<item><title>Brunette Teen Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Teen-Babe-</link></item>
<item><title>Brunette Teen Slut</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Brunette-Teen-Slut-</link></item>
<item><title>Busty Asian Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Busty-Asian-Babe-</link></item>
<item><title>Busty Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Busty-Babe-</link></item>
<item><title>Busty Milf</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Busty-Milf-</link></item>
<item><title>Busty Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Busty-Pornstar-</link></item>
<item><title>Chayse Evans</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Chayse-Evans-</link></item>
<item><title>Cheating Milf</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cheating-Milf-</link></item>
<item><title>Cock Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Fucking-</link></item>
<item><title>Cock Jerking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Jerking-</link></item>
<item><title>Cock Riding</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Riding-</link></item>
<item><title>Cock Stroking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Stroking-</link></item>
<item><title>Cock Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Sucking-</link></item>
<item><title>Cock Teasing</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cock-Teasing-</link></item>
<item><title>Creampie</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Creampie-</link></item>
<item><title>Cum Fiesta</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cum-Fiesta-</link></item>
<item><title>Cumshot</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cumshot-</link></item>
<item><title>Cunt Licking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Cunt-Licking-</link></item>
<item><title>Deepthroat Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Blowjob-</link></item>
<item><title>Deepthroat Blowjobs</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Blowjobs-</link></item>
<item><title>Deepthroat Cock Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Cock-Sucking-</link></item>
<item><title>Deepthroat Oral</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Oral-</link></item>
<item><title>Deepthroat Oral Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Oral-Sex-</link></item>
<item><title>Deepthroat Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Deepthroat-Sucking-</link></item>
<item><title>Dick Riding</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Dick-Riding-</link></item>
<item><title>Dildo Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Dildo-Fucking-</link></item>
<item><title>Doggystyle Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Doggystyle-Fucking-</link></item>
<item><title>Doggystyle Position</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Doggystyle-Position-</link></item>
<item><title>Doggystyle Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Doggystyle-Sex-</link></item>
<item><title>Doggystyle Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Doggystyle-Xxx-</link></item>
<item><title>Double Penetration</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Double-Penetration-</link></item>
<item><title>Dripping Wet</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Dripping-Wet-</link></item>
<item><title>Dylon Nicole</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Dylon-Nicole-</link></item>
<item><title>Ebony Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ebony-Babe-</link></item>
<item><title>Ebony Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ebony-Pornstar-</link></item>
<item><title>Ebony Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ebony-Pussy-</link></item>
<item><title>Ebony Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Ebony-Xxx-</link></item>
<item><title>Face Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Face-Fucking-</link></item>
<item><title>Facial</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Facial-</link></item>
<item><title>Fake Tits</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Fake-Tits-</link></item>
<item><title>Finger Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Finger-Fucking-</link></item>
<item><title>Fishnet Stockings</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Fishnet-Stockings-</link></item>
<item><title>Flower Tucci</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Flower-Tucci-</link></item>
<item><title>Free Teen Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Free-Teen-Porn-</link></item>
<item><title>Fucked from Behind</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Fucked-from-Behind-</link></item>
<item><title>Full Length Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Full-Length-Porn-</link></item>
<item><title>Full Length Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Full-Length-Sex-</link></item>
<item><title>Full Length Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Full-Length-Xxx-</link></item>
<item><title>Gangbang Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Gangbang-Fucking-</link></item>
<item><title>Gangbang Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Gangbang-Xxx-</link></item>
<item><title>Group Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Group-Blowjob-</link></item>
<item><title>Group Cock Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Group-Cock-Sucking-</link></item>
<item><title>Group Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Group-Fucking-</link></item>
<item><title>Group Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Group-Sucking-</link></item>
<item><title>Group Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Group-Xxx-</link></item>
<item><title>Hardcore Cock Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Cock-Fucking-</link></item>
<item><title>Hardcore Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Fucking-</link></item>
<item><title>Hardcore Milf Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Milf-Sex-</link></item>
<item><title>Hardcore Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Porn-</link></item>
<item><title>Hardcore Porno</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Porno-</link></item>
<item><title>Hardcore Pussy Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Pussy-Fucking-</link></item>
<item><title>Hardcore Pussy Ramming</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Pussy-Ramming-</link></item>
<item><title>Hardcore Teen Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Teen-Porn-</link></item>
<item><title>Hardcore Teen Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Teen-Sex-</link></item>
<item><title>Hardcore Teen Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Teen-Xxx-</link></item>
<item><title>Hardcore Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hardcore-Xxx-</link></item>
<item><title>Holly Morgan</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Holly-Morgan-</link></item>
<item><title>Horny Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Horny-Pornstar-</link></item>
<item><title>Hot Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Babe-</link></item>
<item><title>Hot Blonde Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Blonde-Babe-</link></item>
<item><title>Hot Blonde Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Blonde-Pornstar-</link></item>
<item><title>Hot Brunette Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Brunette-Babe-</link></item>
<item><title>Hot Ebony Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Ebony-Pornstar-</link></item>
<item><title>Hot Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Pornstar-</link></item>
<item><title>Hot Round Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Round-Ass-</link></item>
<item><title>Hot Teen Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Teen-Babe-</link></item>
<item><title>Hot Teen Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Teen-Pornstar-</link></item>
<item><title>Hot Teen Slut</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Hot-Teen-Slut-</link></item>
<item><title>Housewife Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Housewife-Sex-</link></item>
<item><title>Housewife Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Housewife-Xxx-</link></item>
<item><title>Interracial Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Interracial-Fucking-</link></item>
<item><title>Interracial Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Interracial-Xxx-</link></item>
<item><title>Jayden James</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Jayden-James-</link></item>
<item><title>Larine Lane</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Larine-Lane-</link></item>
<item><title>Latina Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Latina-Pornstar-</link></item>
<item><title>Latina Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Latina-Xxx-</link></item>
<item><title>Lesbian Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Lesbian-Xxx-</link></item>
<item><title>Lisa Ann</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Lisa-Ann-</link></item>
<item><title>Mason Jay</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Mason-Jay-</link></item>
<item><title>Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Masturbation-</link></item>
<item><title>Mikes Apartment</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Mikes-Apartment-</link></item>
<item><title>Milf Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Milf-Babe-</link></item>
<item><title>Milf Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Milf-Blowjob-</link></item>
<item><title>Milf Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Milf-Pornstar-</link></item>
<item><title>Milf Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Milf-Sex-</link></item>
<item><title>Milf Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Milf-Xxx-</link></item>
<item><title>Money Talks</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Money-Talks-</link></item>
<item><title>Monster Curves</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Monster-Curves-</link></item>
<item><title>Natural Tits</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Natural-Tits-</link></item>
<item><title>Office Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Office-Sex-</link></item>
<item><title>Oral Action</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Action-</link></item>
<item><title>Oral Pleasing</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Pleasing-</link></item>
<item><title>Oral Pleasure</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Pleasure-</link></item>
<item><title>Oral Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Sex-</link></item>
<item><title>Oral Sex Swapping</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Sex-Swapping-</link></item>
<item><title>Oral Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Oral-Sucking-</link></item>
<item><title>Orgy Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Orgy-Sex-</link></item>
<item><title>Orgy Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Orgy-Xxx-</link></item>
<item><title>Outdoor Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Outdoor-Blowjob-</link></item>
<item><title>Outdoor Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Outdoor-Fucking-</link></item>
<item><title>Outdoor Lesbians</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Outdoor-Lesbians-</link></item>
<item><title>Outdoor Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Outdoor-Porn-</link></item>
<item><title>Outdoor Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Outdoor-Xxx-</link></item>
<item><title>Phoenix Marie</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Phoenix-Marie-</link></item>
<item><title>Pigtails</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pigtails-</link></item>
<item><title>Poolside Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Poolside-Fucking-</link></item>
<item><title>Poolside Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Poolside-Pussy-</link></item>
<item><title>Poolside Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Poolside-Sex-</link></item>
<item><title>Porn Audition</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Porn-Audition-</link></item>
<item><title>Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-</link></item>
<item><title>Pornstar Bailey</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Bailey-</link></item>
<item><title>Pornstar Katja</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Katja-</link></item>
<item><title>Pornstar Kelly</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Kelly-</link></item>
<item><title>Pornstar Michelle</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Michelle-</link></item>
<item><title>Pornstar Roxy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Roxy-</link></item>
<item><title>Pornstar Tiffany</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pornstar-Tiffany-</link></item>
<item><title>Pov Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pov-Blowjob-</link></item>
<item><title>Pov Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pov-Fucking-</link></item>
<item><title>Pov Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pov-Sex-</link></item>
<item><title>Pure 18</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pure-18-</link></item>
<item><title>Pussy Fingering</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Fingering-</link></item>
<item><title>Pussy Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Fucking-</link></item>
<item><title>Pussy Licking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Licking-</link></item>
<item><title>Pussy Playing</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Playing-</link></item>
<item><title>Pussy Ramming</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Ramming-</link></item>
<item><title>Pussy Stuffing</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Pussy-Stuffing-</link></item>
<item><title>Red Head Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Red-Head-Pornstar-</link></item>
<item><title>Rimjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Rimjob-</link></item>
<item><title>Round Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Ass-</link></item>
<item><title>Round Ass Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Ass-Babe-</link></item>
<item><title>Round Ass Teen</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Ass-Teen-</link></item>
<item><title>Round Black Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Black-Ass-</link></item>
<item><title>Round Ebony Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Ebony-Ass-</link></item>
<item><title>Round Teen Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Round-Teen-Ass-</link></item>
<item><title>Shaft Riding</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Shaft-Riding-</link></item>
<item><title>Sisters Friend</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Sisters-Friend-</link></item>
<item><title>Small Tits</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Small-Tits-</link></item>
<item><title>Socal Slut</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Socal-Slut-</link></item>
<item><title>Solo Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Solo-Babe-</link></item>
<item><title>Solo Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Solo-Masturbation-</link></item>
<item><title>Solo Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Solo-Pornstar-</link></item>
<item><title>Solo Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Solo-Xxx-</link></item>
<item><title>Stephanie Richards</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Stephanie-Richards-</link></item>
<item><title>Stocking Fetish</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Stocking-Fetish-</link></item>
<item><title>Stripping</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Stripping-</link></item>
<item><title>Tattoo Fetish</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tattoo-Fetish-</link></item>
<item><title>Teen Babe</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Babe-</link></item>
<item><title>Teen Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Blowjob-</link></item>
<item><title>Teen Blowjobs</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Blowjobs-</link></item>
<item><title>Teen Cock Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Cock-Fucking-</link></item>
<item><title>Teen Cock Sucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Cock-Sucking-</link></item>
<item><title>Teen Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Fucking-</link></item>
<item><title>Teen in Thong</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-in-Thong-</link></item>
<item><title>Teen Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Masturbation-</link></item>
<item><title>Teen Oral Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Oral-Sex-</link></item>
<item><title>Teen Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Porn-</link></item>
<item><title>Teen Porn Movies</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Porn-Movies-</link></item>
<item><title>Teen Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Pornstar-</link></item>
<item><title>Teen Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Pussy-</link></item>
<item><title>Teen Rides Cock</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Rides-Cock-</link></item>
<item><title>Teen Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Teen-Xxx-</link></item>
<item><title>Threesome Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threesome-Blowjob-</link></item>
<item><title>Threesome Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threesome-Fucking-</link></item>
<item><title>Threesome Porn</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threesome-Porn-</link></item>
<item><title>Threesome Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threesome-Sex-</link></item>
<item><title>Threesome Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threesome-Xxx-</link></item>
<item><title>Threeway Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threeway-Sex-</link></item>
<item><title>Threeway Xxx</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Threeway-Xxx-</link></item>
<item><title>Tight Anal Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Anal-Sex-</link></item>
<item><title>Tight Ass</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Ass-</link></item>
<item><title>Tight Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Pussy-</link></item>
<item><title>Tight Pussy Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Pussy-Fucking-</link></item>
<item><title>Tight Pussy Sex</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Pussy-Sex-</link></item>
<item><title>Tight Teen Cunt</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Teen-Cunt-</link></item>
<item><title>Tight Teen Cunts</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Teen-Cunts-</link></item>
<item><title>Tight Teen Pussy</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Tight-Teen-Pussy-</link></item>
<item><title>Titty Cumshot</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Titty-Cumshot-</link></item>
<item><title>Titty Fucking</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Titty-Fucking-</link></item>
<item><title>Toys</title><link><?php echo $host; ?>/scripts/adult/php/flytube.php?query=1,http://www.flytube.com/search/Toys-</link></item>

</channel>
</rss>
