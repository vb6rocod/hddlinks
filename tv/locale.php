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
		centerYPC=30
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

    <title>Emisiuni posturi locale</title>
<!--
<item>
<title>tvt89</title>
<link><?php echo $host; ?>/scripts/tv/locale/tvt89.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvt89.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvt89.jpg</image>
<location>http://tvt89.bridgeman.ro/index.php</location>
<annotation>tvt89 a fost prima staţie de televiziune privată din România şi a rămas în conştiinţa publicului din vestul ţării, drept primul canal tv prin care s-au manifestat liber zilele revoluţiei române.</annotation>

</item>
-->
<item>
<title>1 TV Bacau</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,1tvbacauvideo</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/1tvbacau.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/1tvbacau.jpg</image>
<location>http://www.1tvbacau.ro/</location>
<annotation>1 TV Bacau, post local de televiziune, prezintă evenimentele locale din ziua respectivă</annotation>
</item>
<!--
<item>
<title>Transilvania Tube</title>
<link><?php echo $host; ?>/scripts/tv/locale/transilvaniatube.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/transilvaniatube.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/transilvaniatube.png</image>
<location>http://transilvaniatube.ro/</location>
<annotation>Look TV, Transilvania Live</annotation>
</item>
-->
<item>
<title>TVSat</title>
<link><?php echo $host; ?>/scripts/tv/locale/tvsatrm.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvsat.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvsat.gif</image>
<location>http://www.jurnal.tvsatrm.ro/</location>
<annotation>Cele mai importante stiri din judetul Buzau. Jurnalul TVSat video, inregistrarile emisiunilor. TVSat Live!</annotation>
</item>
<!--
<item>
<title>Info TV</title>
<link><?php echo $host; ?>/scripts/tv/locale/infotv.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/infotv.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/infotv.gif</image>
<location>http://www.infotv.ro/</location>
<annotation>Info TV va ofera zilnic cele mai noi informatii din actualitatea locala Aradeana, incadrul jurnalului infotv. Emisiuni de actualitate, politica, social, cultura, sport, divertisment. Va oferim si micile informatii: meteo, curs valutar, tranzactii bursiere, anunturi.</annotation>
</item>
-->
<item>
<title>RTS</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,rtseverin</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/televiziuneaseverin.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/televiziuneaseverin.png</image>
<location>http://www.televiziuneaseverin.ro/rts4/</location>
<annotation>RTS - Radioteleviziunea Severin</annotation>
</item>
<!--
<item>
<title>Tele'M</title>
<link><?php echo $host; ?>/scripts/tv/locale/telem_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/telem.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/telem.png</image>
<location>http://www.telem.ro/telem/</location>
<annotation>Televiziunea Tele'M Iaşi - informaţia deşteaptă</annotation>
</item>
-->
<!--
<item>
<title>BaricadaTV</title>
<link><?php echo $host; ?>/scripts/clip/php/vimeo2.php?query=,4936621,BaricadaTV</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/baricadatv.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/baricadatv.jpg</image>
<location>http://vimeo.com/user4936621/videos</location>
<annotation>BaricadaTV.  revolutie in televiziune!</annotation>
</item>
-->
<!--
<item>
<title>eMaramures</title>
<link><?php echo $host; ?>/scripts/tv/locale/emaramures.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/emaramures.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/emaramures.jpg</image>
<location>http://www.emaramures.ro</location>
<annotation>STIRI MARAMURES  ziar electronic actualizat non-stop cu stiri din Baia Mare, Sighet, Borsa, Targu Lapus...</annotation>
</item>
-->
<item>
<title>CNS Roman</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,tvcns</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/cns.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/cns.jpg</image>
<location>http://www.cnstv.ro/</location>
<annotation>Televiziunea Roman CNS</annotation>
</item>
</channel>
</rss>
