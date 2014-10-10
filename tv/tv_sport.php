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
  middleItem = Integer(itemCount / 2);
  redrawDisplay();
</onRefresh>

	<mediaDisplay name=photoView
	  centerXPC=7
		centerYPC=25
		centerHeightPC=40
columnCount=5
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
      majorContext = getPageInfo("majorContext");

      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);

      if(userInput == "one" || userInput == "1")
      {
        if(itemCount &gt;= 1)
        {
          setFocusItemIndex(0);
          redrawDisplay();
        }
      }
      else if(userInput == "two" || userInput == "2")
      {
        if(itemCount &gt;= 2)
        {
          setFocusItemIndex(1);
          redrawDisplay();
        }
      }
      else if(userInput == "three" || userInput == "3")
      {
        if(itemCount &gt;= 3)
        {
          setFocusItemIndex(2);
          redrawDisplay();
        }
      }
      else if(userInput == "four" || userInput == "4")
      {
        if(itemCount &gt;= 4)
        {
          setFocusItemIndex(3);
          redrawDisplay();
        }
      }
      else if(userInput == "five" || userInput == "5")
      {
        if(itemCount &gt;= 5)
        {
          setFocusItemIndex(4);
          redrawDisplay();
        }
      }
      else if(userInput == "six" || userInput == "6")
      {
        if(itemCount &gt;= 6)
        {
          setFocusItemIndex(5);
          redrawDisplay();
        }
      }
      else if(userInput == "seven" || userInput == "7")
      {
        if(itemCount &gt;= 7)
        {
          setFocusItemIndex(6);
          redrawDisplay();
        }
      }
      else if(userInput == "eight" || userInput == "8")
      {
        if(itemCount &gt;= 8)
        {
          setFocusItemIndex(7);
          redrawDisplay();
        }
      }
      else if(userInput == "nine" || userInput == "9")
      {
        if(itemCount &gt;= 9)
        {
          setFocusItemIndex(8);
          redrawDisplay();
        }
      }
      if(userInput == "zero" || userInput == "0")
      {
        if(itemCount &gt;= 10)
        {
          setFocusItemIndex(9);
          redrawDisplay();
        }
      }
      else if (userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG")
      {
        itemSize = getPageInfo("itemCount");
        idx = Integer(getFocusItemIndex());
        if (userInput == "pagedown")
        {
          idx -= -5;
          if(idx &gt;= itemSize)
            idx = itemSize-1;
        }
        else
        {
          idx -= 5;
          if(idx &lt; 0)
            idx = 0;
        }
        setFocusItemIndex(idx);
        setItemFocus(idx);
        redrawDisplay();
        ret = "true";
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

    <title>Emisiuni Sportive</title>

<item>
<title>Sport.ro</title>
<link><?php echo $host; ?>/scripts/tv/sport/sportro.php?query=1</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sport_ro.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/sport_ro.gif</image>
<location>http://www.sport.ro/</location>
<annotation>Stiri si informatii de ultima ora din sport, interviuri si comentarii la cald din fotbalul de pretutindeni. Meciurile live din Europa League si Cupa Romaniei se vad doar pe www.sport.ro</annotation>
</item>


	<item>
	<title>Koolnet (abonament)</title>
	<link><?php echo $host; ?>/scripts/tv/php/seenow_e.php?query=1,http://www.seenow.ro/ro/koolnet-5514-pagina-,Koolnet</link>
	<annotation>Koolnet (abonament)</annotation>
	<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/koolnet.png</image>
	<mediaDisplay name="threePartsView"/>
	</item>

	<item>
	<title>Cupa Romaniei (abonament)</title>
	<link><?php echo $host; ?>/scripts/tv/php/seenow_e.php?query=1,http://www.seenow.ro/ro/cupa-romaniei-5658-pagina-,Cupa+Romaniei</link>
	<annotation>Cupa Romaniei (abonament)</annotation>
	<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/cupa.png</image>
	<mediaDisplay name="threePartsView"/>
	</item>
<!--
<item>
<title>Liga2.ro</title>
<link><?php echo $host; ?>/scripts/tv/sport/liga2.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/liga2.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/liga2.gif</image>
<location>http://www.liga2.ro/</location>
<annotation>Stiri din sport, informatii de ultima ora, comentarii si opinii din sport, bloguri de sport, clasamente actualizate, livescore, liga a doua, liga3</annotation>
</item>
-->
<!--
<item>
<title>sportgioco.it</title>
<link><?php echo $host; ?>/scripts/tv/sport/sportgioco.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sportgioco.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/sportgioco.jpg</image>
<location>http://www.sportgioco.it/calcio/highlights.php</location>
<annotation>Notizie sportive, informazioni, highlights video e tabelle comparative delle squadre di calcio. Tutti i calendari dei campionati di calcio con le quote dei bookmakers ed aggiornamenti sugli incontri di calcio</annotation>
</item>
-->


<item>
<title>www.footytube.com</title>
<link><?php echo $host; ?>/scripts/tv/sport/footytube.php?query=0</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/footytube.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/footytube.png</image>
<location>http://www.footytube.com</location>
<annotation>footytube.com. Latest football highlights, clips and videos.</annotation>
</item>
<!--
<item>
<title>www.tvgool.ro</title>
<link><?php echo $host; ?>/scripts/tv/sport/tvgool.php?query=,http://www.tvgool.ro/page/championship</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvgool.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvgool.png</image>
<location>http://www.tvgool.ro</location>
<annotation>Latest Football Highlights & Goals from major leagues.</annotation>
</item>
-->
<!--
<item>
<title>tvgool.ro (youtube)</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,TVGOOLpunctro</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvgool.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvgool.png</image>
<location>http://www.tvgool.ro/</location>
<annotation>tvgool.ro</annotation>
</item>
-->
<item>
<title>football (youtube)</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,football</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/youtube.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/youtube.png</image>
<location>http://www.youtube.com/user/football/videos</location>
<annotation>youtube.com</annotation>
</item>
<!--
<item>
<title>soccerclips.net</title>
<link><?php echo $host; ?>/scripts/tv/sport/soccerclips_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/soccerclips.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/soccerclips.jpg</image>
<location>http://www.soccerclips.net</location>
<annotation>Football videos, football news, forum and more. SoccerClips is a community of football fans.</annotation>
</item>
-->

<item>
<title>DiGiSport</title>
<link><?php echo $host; ?>/scripts/tv/sport/digi.php?query=1,http://www.digisport.ro/Sport/VIDEO/,Toate</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/digi.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/digi.png</image>
<location>http://www.digisport.ro/video</location>
<annotation>Digi Sport</annotation>
</item>

<item>
<title>GSPTV</title>
<link><?php echo $host; ?>/scripts/tv/sport/gsp.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/gsp.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/gsp.png</image>
<location>http://tv.gsp.ro/</location>
<annotation>GSPTV - Golurile si fazele video din Liga I:</annotation>
</item>

<!--
<item>
<title>DigiSport - youtube</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,DigiSportTV</link>
<image>image/youtube.gif</image>
<location>http://www.youtube.com/user/DigiSportTV</location>
<annotation>DigiSport TV pe youtube</annotation>
<media:thumbnail url="image/youtube.gif" />
</item>
-->
<!--
<item>
<title>Steaua Bucure≈üti</title>
<link><?php echo $host; ?>/scripts/tv/sport/steaua.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/steaua.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/steaua.png</image>
<location>http://www.steauafc.com/ro/arhiva_video/</location>
<annotation>FCSB - site-ul oficial al FC Steaua Bucuresti.</annotation>
</item>

<item>
<title>Dinamo Bucure≈üti</title>
<link><?php echo $host; ?>/scripts/tv/sport/dinamo.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/dinamo.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/dinamo.png</image>
<location>http://www.fcdinamo.ro/web/guest/galerii-video</location>
<annotation>Site-ul oficial al echipei Dinamo Bucuresti. Include stiri, informatii, magazin virtual, fotografii, imnul Cainilor Rosii.</annotation>
</item>
-->
<item>
<title>CFR Cluj</title>
<link><?php echo $host; ?>/scripts/tv/sport/cfr_cluj.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/cfr_cluj.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/cfr_cluj.png</image>
<location>http://www.cfr1907.ro/ro/multimedia/video/</location>
<annotation>CFR Cluj este un club de fotbal din Rom·≠©a, Ì≠¶iintat Ì¨†anul 1907 Ì¨†orasul Cluj</annotation>
</item>
<!--
<item>
<title>sportitalia</title>
<link><?php echo $host; ?>/scripts/tv/sport/sportitalia.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sportitalia.jpg" />
<image></image>
<location></location>
<annotation></annotation>
</item>
-->
<item>
<title>Bing</title>
<link><?php echo $host; ?>/scripts/tv/bing_sport.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg</image>
<location>http://www.bing.com/</location>
<annotation>FOX Soccer Channel, NBA, NHL, NFL, MLB, College Football, College Basketball</annotation>
</item>

<item>
<title>NBA</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,nba</link>
<media:thumbnail url="image/youtube.gif" />
<image>image/youtube.gif</image>
<location>http://www.youtube.com/user/NBA</location>
<annotation>Official channel of the NBA.</annotation>
</item>


</channel>
</rss>
