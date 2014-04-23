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

    <title>Emisiuni posturi nationale</title>
<!--
<item>
<title>Antena 1</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://www.a1.ro/</location>
<annotation>Tot ce va intereseaza: stiri, vedete, program tv, evenimente, noutati auto, sport si nu numai. O colectie de informatii necesara oricarui roman. Antena 1 - Mereu Aproape</annotation>
<mediaDisplay name="photoView"/>
</item>

<item>
<title>Antena2</title>
<link><?php echo $host; ?>/scripts/tv/php/antena2_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena2.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena2.jpg</image>
<location>http://antena2.ro/</location>
<annotation>Programe LIVE,  reactii, replici, emotii, nervii, toate autentice si necenzurate</annotation>
</item>

<item>
<title>Antena3</title>
<link><?php echo $host; ?>/scripts/tv/php/ant3_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena3.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena3.jpg</image>
<location>http://www.antena3.ro/</location>
<annotation>Specialisti in stiri, prima optiune pentru stiri online in timp real din Romania si din lume</annotation>
</item>

<item>
<title>ProTV</title>
<link><?php echo $host; ?>/scripts/tv/php/protv_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/protv.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/protv.jpg</image>
<location>http://www.protv.ro/</location>
<annotation>Vezi aici emisiuni inregistrate ale postului TV ProTV</annotation>
</item>
-->
<!--
<item>
<title>AcasaTV</title>
<link><?php echo $host; ?>/scripts/tv/acasatv.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/acasatv.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/acasatv.jpg</image>
<location>http://www.acasatv.ro/</location>
<annotation>Ultimele stiri despre telenovele, vedete, moda, frumusete, dieta si  familie</annotation>
</item>
-->

<item>
<title>TVR Stiri</title>
<link><?php echo $host; ?>/scripts/tv/php/tvrstiri.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvrstiri.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvrstiri.png</image>
<location>http://stiri.tvr.ro/top-video.html</location>
<annotation>Site-ul de stiri al Televiziunii Rom‚ne</annotation>
</item>

<item>
<title>Biziday</title>
<link><?php echo $host; ?>/scripts/tv/php/seenow_e.php?query=1,http://www.seenow.ro/biziday-3298-pagina-,Biziday</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/biziday.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/biziday.jpg</image>
<location>http://www.biziday.ro/</location>
<annotation>Blogul lui Moise Guran si al echipei de la Biziday si Ora de Business</annotation>
</item>

<item>
<title>National 24 Plus</title>
<link><?php echo $host; ?>/scripts/tv/php/n24.php?query=1,</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/n24.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/n24.png</image>
<location>http://www.n24plus.ro/</location>
<annotation>National TV - mai ceva ca-n viata!</annotation>
</item>
<!--
<item>
<title>Na≈£ional TV</title>
<link><?php echo $host; ?>/scripts/tv/php/national_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/national.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/national.jpg</image>
<location>http://www.nationaltv.ro/</location>
<annotation>Na≈£ional 24 Plus : filmele rom√¢ne≈üti, emisiunile ≈üi serialele tale preferate</annotation>
</item>
-->
<item>
<title>Na≈£ional TV</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,nationaltvro</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/national.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/national.jpg</image>
<location>http://www.nationaltv.ro/</location>
<annotation>Na≈£ional 24 Plus : filmele rom√¢ne≈üti, emisiunile ≈üi serialele tale preferate</annotation>
</item>


<item>
<title>RealitateaTV</title>
<link><?php echo $host; ?>/scripts/tv/php/realitateatv_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/realitateatv.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/realitateatv.gif</image>
<location>http://www.realitatea.net/tv</location>
<annotation>Site-ul de stiri nr. 1 in Romania iti ofera informatia proaspata corecta obiectiva si documentata despre stirile de ultima ora.</annotation>
</item>

<item>
<title>RealitateaTV - emisiuni</title>
<link><?php echo $host; ?>/scripts/tv/php/seenow_emisiuni1.php?query=1,http://www.seenow.ro/realitatea-tv-2698-pagina-,RealitateaTV</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/realitateatv.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/realitateatv.gif</image>
<location>http://www.seenow.ro/</location>
<annotation>Inregistrari emisiuni</annotation>
</item>

<item>
<title>Romania TV</title>
<link><?php echo $host; ?>/scripts/tv/php/rtv_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/rtv.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/rtv.png</image>
<location>http://www.rtv.net/</location>
<annotation>RTV.NET | Romania TV | Noi dam stirea exacta!:</annotation>
</item>


<item>
<title>Digi24</title>
<link><?php echo $host; ?>/scripts/tv/php/digi24.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/digi24.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/digi24.png</image>
<location>http://www.digi24.ro/video</location>
<annotation>DIGI 24 | Articole video si stiri video</annotation>
</item>
<!--
<item>
<title>Ora de Business</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,BiziDay</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/biziday.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/biziday.png</image>
<location>http://www.biziday.ro/category/inregistrari-ora-de-business/</location>
<annotation>Œnregistr„ri Ora De Business</annotation>
</item>
-->
<item>
<title>B1 TV</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,B1TVChannel</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/b1.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/b1.png</image>
<location>http://www.b1.ro/video</location>
<annotation>Stiri B1TV</annotation>
</item>

<item>
<title>B1 TV - emisiuni</title>
<link><?php echo $host; ?>/scripts/tv/php/seenow_emisiuni1.php?query=1,http://www.seenow.ro/b1-tv-2699-pagina-,B1TV</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/b1.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/b1.png</image>
<location>http://www.seenow.ro/</location>
<annotation>Inregistrari emisiuni</annotation>
</item>

<item>
<title>Agerpres</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,UCfnP_igK3BPLst-QTmIh0Wg</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/agerpres.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/agerpres.png</image>
<location>http://www1.agerpres.ro/agerpres/home</location>
<annotation>AGERPRES : Actualizeaz„ lumea.</annotation>
</item>

<item>
<title>Seenow</title>
<link><?php echo $host; ?>/scripts/tv/php/seenow_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/seenow.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/seenow.png</image>
<location>http://www.seenow.ro/emisiuni-tv-2697-pagina-1</location>
<annotation>Emisiuni inregistrate Seenow</annotation>
</item>

<!--
<item>
<title>Kanal D</title>
<link><?php echo $host; ?>/scripts/tv/php/kanald_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/kanald.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/kanald.png</image>
<location>http://www.kanald.ro/</location>
<annotation>Galerii video si editii online pentru seriale si filme, stiri, concursuri, vedete, evenimente mondene. Video online de la emisiunile Kanal D.</annotation>
</item>
-->
<!--
<item>
<title>In gura presei cu Mircea Badea</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_igp_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_igp.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_igp.jpg</image>
<location>http://ingurapresei.a1.ro/</location>
<annotation>Despre politica, justitie, politia, pitipoance, Romania, viata de zi cu zi, ziare, autostrazi si multe multe altele. Cu comentariile lui amuzante sau amare, pornite de la subiectele abordate de presa in ziua respectiva, Mircea Badea spune ceea ce gandesc multi dintre romani, deranjand deseori mai-marii zilei si devenind una din vocile influente ale vietii publice.</annotation>
</item>
-->
<!--
<item>
<title>TVR Info</title>
<link><?php echo $host; ?>/scripts/tv/php/tvrinfo.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvrinfo.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvrinfo.png</image>
<location>http://www.tvrinfo.ro/top-video.html</location>
<annotation>Site-ul de stiri al Televiziunii Rom‚ne</annotation>
</item>
-->
<!--
<item>
<title>Nasul TV</title>
<link><?php echo $host; ?>/scripts/tv/php/nasu_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/nasu.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/nasu.png</image>
<location>http://www.nasul.tv/</location>
<annotation>Un blog personal exploziv, o platforma multimedia de exprimare libera. Stiri, anchete, dosare si editii speciale realizate live de catre jurnalistul Radu Moraru si echipa sa.</annotation>
</item>
-->
<item>
<title>Zona IT</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,ArealIT</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/zonait.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/zonait.jpg</image>
<location>http://www.arealit.tv/</location>
<annotation>Zona IT este singura emisiune de IT difuzata in HD din Romania. Aici veti gasi teste Hardware si Software, Jocuri si Concursuri.</annotation>
</item>

<item>
<title>tele-tv.info</title>
<link><?php echo $host; ?>/scripts/tv/php/tele-tv.php?file=1,emisiuni,Emisiuni</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/tele-tv.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tele-tv.png</image>
<location>http://www.tele-tv.info</location>
<annotation>Tv online, tv live, tv online gratis, webcam online, jocuri online, broadcast, programe tv online! - www.tele-tv.info:</annotation>
</item>
<!--
<item>
<title>CancanTV</title>
	<link><?php echo $host; ?>/scripts/clip/php/cancantv.php</link>
	<location>http://www.kanald.ro/Emisiuni/Cancan-TV/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/cancan.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/cancan.jpg" />
	<annotation>CANCAN TV, cel mai fierbinte show monden al momentului, se va difuza de luni pana joi de la 22.30. | Emisiunile Kanal D - Cancan TV - prezint„ Andreea Mantea, Adrian Artene - edi˛ii online, galerii foto si video, noutati.</annotation>
</item>
-->
<item>
<title>SensoTV</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/arte-vizuale/clipa-de-arta</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png</image>
<location>http://www.sensotv.ro/</location>
<annotation>Senso TV este o televiziune online ce face parte dintr-un trust media, compus din 6 canale TV online: Arts Channel, Health Channel, Music Channel, Politic Channel, Extrem Sports Channel si Lifestyle Channel.</annotation>
</item>

<item>
<title>Publika.Md</title>
<link><?php echo $host; ?>/scripts/tv/php/publika.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/publika.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/publika.jpg</image>
<location>http://publika.md/</location>
<annotation>Site-ul de stiri care iti ofera informatia proaspata corecta obiectiva si documentata despre stirile de ultima ora.</annotation>
</item>

<item>
<title>JurnalTV</title>
<link><?php echo $host; ?>/scripts/tv/php/jurnaltv.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/jurnaltv.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/jurnaltv.jpg</image>
<location>http://jurnaltv.md/</location>
<annotation>JurnalTV - Prima televiziune de stiri din Republica Moldova</annotation>
</item>

<item>
<title>privesc.eu</title>
<link><?php echo $host; ?>/scripts/tv/php/privesc_main.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/privesc.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/privesc.jpg</image>
<location>http://www.privesc.eu</location>
<annotation>Privesc.eu</annotation>
</item>
<!--
<item>
<title>Curaj.TV</title>
<link><?php echo $host; ?>/scripts/tv/php/curaj.php?query=1</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/curaj.png" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/curaj.png</image>
<location>http://curaj.tv</location>
<annotation>Curaj.TV - Media alternativa:</annotation>
</item>
-->
<!--
<item>
<title>EuforiaTV</title>
<link><?php echo $host; ?>/scripts/tv/php/euforiatv.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/euforiatv.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/euforiatv.gif</image>
<location>http://www.euforia.tv/</location>
<annotation>Euforia, lifestyle, hobby, fashion, retete culinare, sanatate, community</annotation>
</item>
-->
</channel>
</rss>
