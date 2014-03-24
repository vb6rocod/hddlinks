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
  redrawDisplay();
</onRefresh>

	<mediaDisplay name=photoView
	  centerXPC=7
		centerYPC=25
		centerHeightPC=40
columnCount=4
	  rowCount=1
		menuBorderColor="55:55:55"
		sideColorBottom="0:0:0"
		sideColorTop="0:0:0"
	  backgroundColor="0:0:0"
		imageBorderColor="0:0:0"
		itemBackgroundColor="0:0:0"
		itemGapXPC=0
		itemGapYPC=1
		sideTopHeightPC=22
		bottomYPC=85
		sliding=yes
		showHeader=no
		showDefaultInfo=no
		idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<!--  lines="5" fontSize=15 -->
		<text align="center" redraw="yes"
  lines=3 fontSize=17
		      offsetXPC=5 offsetYPC=65 widthPC=90 heightPC=20
		      backgroundColor=0:0:0 foregroundColor=120:120:120>
			<script>print(annotation); annotation;</script>
		</text>

		<text align="center" redraw="yes" offsetXPC=10 offsetYPC=85 widthPC=80 heightPC=10 fontSize=15 backgroundColor=0:0:0 foregroundColor=75:75:75>
			<script>print(location); location;</script>
		</text>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		<itemDisplay>
			<image>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
					}
					getItemInfo(idx, "image");
				</script>
			 <offsetXPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 0; else 12;
			   </script>
			 </offsetXPC>
			 <offsetYPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 0; else 6;
			   </script>
			 </offsetYPC>
			 <widthPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 100; else 75;
			   </script>
			 </widthPC>
			 <heightPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 50; else 37;
			   </script>
			 </heightPC>
			</image>

			<text align="center" lines="4" offsetXPC=0 offsetYPC=55 widthPC=100 heightPC=45 backgroundColor=-1:-1:-1>
				<script>
					idx = getQueryItemIndex();
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "18"; else "14";
  				</script>
				</fontSize>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "75:75:75";
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
    idx -= -4;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 4;
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

    <title>Trailere filme şi jocuri</title>

<item>
<title>www.cinemarx.ro</title>
<link><?php echo $host; ?>/scripts/trailer/php/cinemarx.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/trailer/image/cinemax.jpg"/>
<image>/usr/local/etc/www/cgi-bin/scripts/trailer/image/cinemax.jpg</image>
<location>http://www.cinemarx.ro/</location>
<annotation>Filme noi, program cinema, trailere, filme 2011, filme 2010, box office, premiere cinema, filme, seriale tv - Radiografia cinematografiei - CinemaRx</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>www.cinemagia.ro</title>
<link><?php echo $host; ?>/scripts/trailer/php/cinemagia.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/trailer/image/cinemagia.jpg"/>
<image>/usr/local/etc/www/cgi-bin/scripts/trailer/image/cinemagia.jpg</image>
<location>http://www.cinemagia.ro/</location>
<annotation>Filme 2012, filme 2011, filme noi, programe TV, program cinema, premiere cinema, trailere filme</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>filme2012.ro</title>
<link><?php echo $host; ?>/scripts/trailer/php/filme2012.php?query=1,</link>
<media:thumbnail url="image/trailerb.png"/>
<image>image/trailerb.png</image>
<location>http://www.filme2012.ro/</location>
<annotation>Filme 2012: Va punem la dispozitie interaga colectie de filme lansate in anul 2012.</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>movienews.ro - trailers</title>
<link>http://movienews.ro/trailers/feed/</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/trailer/image/movienews.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/trailer/image/movienews.png</image>
<location>http://movienews.ro</location>
<annotation>Trailers MovieNews.ro | Sursa ta zilnica de stiri din lumea filmului!</annotation>
<mediaDisplay name="threePartsView" 
	itemBackgroundColor="0:0:0" 
	backgroundColor="0:0:0" 
	sideLeftWidthPC="0" 
	itemImageXPC="5" 
	itemXPC="20" 
	itemYPC="20" 
	itemWidthPC="65" 
	capWidthPC="70" 
	unFocusFontColor="101:101:101" 
	focusFontColor="255:255:255" 
	idleImageWidthPC="8"
	idleImageHeightPC="10">
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		<backgroundDisplay>
			<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
			image/mele/backgd.jpg
			</image>  
		</backgroundDisplay>
		<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
		image/mele/rss_title.jpg
		</image>
		<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
		movienews.ro - trailers
		</text>			
</mediaDisplay>
</item>
-->
<item>
<title>Gametrailers</title>
<link><?php echo $host; ?>/scripts/trailer/gt.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/trailer/image/gt.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/trailer/image/gt.jpg</image>
<location>http://www.gametrailers.com/</location>
<annotation>Watch new video game trailers, read reviews and previews of upcoming video games at GameTrailers.com. Video game demos, online gameplay, game cheats or view movies and media on the GameTrailers website.</annotation>
</item>

</channel>
</rss>
