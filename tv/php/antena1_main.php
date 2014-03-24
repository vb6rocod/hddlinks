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
		idleImageWidthPC="8" idleImageHeightPC="10" idleImageXPC="5" idleImageYPC="5">

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

    <title>Antena1 - Emisiuni</title>

<item>
<title>In gura presei cu Mircea Badea</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_igp_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_igp.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_igp.jpg</image>
<location>http://ingurapresei.a1.ro/</location>
<annotation>Despre politica, justitie, politia, pitipoance, Romania, viata de zi cu zi, ziare, autostrazi si multe multe altele. Cu comentariile lui amuzante sau amare, pornite de la subiectele abordate de presa in ziua respectiva, Mircea Badea spune ceea ce gandesc multi dintre romani, deranjand deseori mai-marii zilei si devenind una din vocile influente ale vietii publice.</annotation>
</item>
<!--
<item>
<title>X Factor</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_xfactor.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_xfactor.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_xfactor.jpg</image>
<location>http://xfactor.a1.ro/</location>
<annotation>X Factor, cel mai mare show care transforma oameni obisnuiti in superstaruri este la Antena 1. Stiri X Factor, video, galerie foto, cele mai tari faze din show.</annotation>
</item>
-->
<item>
<title>In puii mei cu Mihai Bendeac</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_ipm_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_ipm.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_ipm.jpg</image>
<location>http://inpuiimei.a1.ro/</location>
<annotation>In pui mei, monden,florin piersic,inmormantare,reporteri,declaratii,afirmatii...</annotation>
</item>

<item>
<title>Neatza cu Razvan si Dani</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_neatza_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_neatza.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_neatza.jpg</image>
<location>http://neatza.a1.ro/</location>
<annotation>Neatza cu Razvan si Dani, Matinal Antena1</annotation>
</item>

<item>
<title>Un show pacatos cu Dan Capatos</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_pacatos_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_pacatos.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_pacatos.jpg</image>
<location>http://unshowpacatos.a1.ro/</location>
<annotation>Campionul noptilor albe face din nou Un Show Pacatos. De luni pana joi, cu un sfert de ora inainte de miezul noptii.</annotation>
</item>

<item>
<title>Acces direct cu Simona Gherghe</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_acces_emisiuni.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_acces.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1_acces.jpg</image>
<location>http://accesdirect.a1.ro/</location>
<annotation>Acces direct cu Simona Gherghe, cel mai tare show de dupa-amiaza, Primii care au ajuns la adevaruri bine zavorate, Primii care ti-au oferit cu adevarat acces la toate chipurile vietii, Antena1</annotation>
</item>

<item>
<title>Plasa de stele</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_plasadestele.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://plasadestele.a1.ro/</location>
<annotation>Astazi la emisiunea lui Dan Negru, Plasa de stele de pe Antena 1, prima victima a fost Daniela Crudu. Aceasta s-a manifestat ca la ea in Ferentari... Oare de ce fac oamenii astia farse politicienilor  ca sa ii vedem in starea lor naturala.</annotation>
</item>

<item>
<title>Narcisa: Iubiri nelegiuite</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_narcisa.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://iubirinelegiuite.a1.ro/</location>
<annotation>Iubiri nelegiuite – urmareste noul serial.  Este o poveste de iubire, lux, seductie, senzualitate, suspans si emotie intensa.</annotation>
</item>

<!--
<item>
<title>Next top model</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_nexttopmodel.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://nexttopmodel.a1.ro/</location>
<annotation>Mii de fete au luptat pentru sansa vietii lor: un contract pe 4 ani, in valoare de 50.000 euro, cu cea mai mare agentie de modeling din Romania!</annotation>
</item>

<item>
<title>Sa te prezint parintilor</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_sa-te-prezint-parintilor.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://www.a1.ro/emisiuni-tv/sa-te-prezint-parintilor-100276.html</location>
<annotation>"Sa te prezint parintilor" a intrat, odata cu luna decembrie in cel de-al treilea sezon. Asa cum v-a obisnuit pana acum, veti avea parte de povesti tumultoase, situatii de viata dintre cele mai surprinzatoare si personaje inedite.</annotation>
</item>

<item>
<title>Te pui cu blondele</title>
<link><?php echo $host; ?>/scripts/tv/php/antena1_tepuicublondele.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/antena1.jpg</image>
<location>http://tepuicublondele.a1.ro/</location>
<annotation>Blondele au reusit sa-l invinga pe Prigoana si totodata au castigat si suma de bani pusa in joc.</annotation>
</item>
-->
</channel>
</rss>
