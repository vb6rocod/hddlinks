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
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/adult/image/drtuber.png";
  </script>

<channel>
	<title>drtuber.com</title>
	<menu>main menu</menu>


<item>
	<title>Most Recent</title>
<link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?o=mr</link>
</item>
<item><title>Amateur</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=2</link></item>
<item><title>Anal</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=3</link></item>
<item><title>Asian</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=4</link></item>
<item><title>Ass</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=23</link></item>
<item><title>Babe</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=35</link></item>
<item><title>Big tits</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=32</link></item>
<item><title>Blonde</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=26</link></item>
<item><title>Blowjob</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=5</link></item>
<item><title>Brunette</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=27</link></item>
<item><title>Bukkake</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=34</link></item>
<item><title>Celebrity</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=21</link></item>
<item><title>Cumshot</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=36</link></item>
<item><title>Ebony</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=6</link></item>
<item><title>Erotic</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=7</link></item>
<item><title>Fat</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=39</link></item>
<item><title>Fetish</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=18</link></item>
<item><title>Fisting</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=20</link></item>
<item><title>Gay</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=8</link></item>
<item><title>Granny</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=40</link></item>
<item><title>Group</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=29</link></item>
<item><title>Handjob</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=30</link></item>
<item><title>Hardcore</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=9</link></item>
<item><title>Hentai</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=31</link></item>
<item><title>Interracial</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=19</link></item>
<item><title>Latina</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=10</link></item>
<item><title>Lesbian</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=11</link></item>
<item><title>Masturbation</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=15</link></item>
<item><title>Mature</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=12</link></item>
<item><title>Milf</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=25</link></item>
<item><title>Outdoor</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=37</link></item>
<item><title>Pornstar</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=22</link></item>
<item><title>Reality</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=38</link></item>
<item><title>Red Head</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=28</link></item>
<item><title>Shemale</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=13</link></item>
<item><title>Solo</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=16</link></item>
<item><title>Stockings</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=33</link></item>
<item><title>Strip</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=14</link></item>
<item><title>Teen</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=1</link></item>
<item><title>Toys</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=17</link></item>
<item><title>Vintage</title><link><?php echo $host; ?>/scripts/adult/php/drtuber.php?query=1,http://www.drtuber.com/videos?c=24</link></item>

</channel>
</rss>
