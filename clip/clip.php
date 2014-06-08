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
<title>Videoclipuri</title>


<item>
<title>Youtube</title>
	<link>rss_file:///usr/local/etc/www/cgi-bin/scripts/clip/youtube/yt_index.rss</link>
	<location>http://youtube.com</location>
	<image>image/youtube.gif</image>
	<media:thumbnail url="image/youtube.gif" />
	<annotation>YouTube este un loc în care puteti descoperi, urmări, încărca şi distribui videoclipuri.</annotation>
	<mediaDisplay name="onePartView" />
</item>
<!--
<item>
<title>Youtube user uploads</title>
	<link>rss_command://search</link>
	<location>http://youtube.com</location>
	<search url="<?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,%s" />
	<image>image/youtube.gif</image>
	<media:thumbnail url="image/youtube.gif" />
	<annotation>Căutare videoclipuri postate pe youtube de către....</annotation>
</item>
-->
<item>
<title>220</title>
	<link><?php echo $host; ?>/scripts/clip/220.php</link>
	<location>http://www.220.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/220.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/220.jpg" />
	<annotation>Te ţine în priză!</annotation>
</item>

<item>
<title>vplay</title>
	<link><?php echo $host; ?>/scripts/clip/php/vplay_main.php</link>
	<location>http://www.vplay.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/vplay.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/vplay.jpg" />
	<annotation>Videoclipuri HD Online</annotation>
</item>


<item>
<title>trilulilu</title>
	<link><?php echo $host; ?>/scripts/clip/trilulilu.php</link>
	<location>http://www.trilulilu.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/trilulilu.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/trilulilu.png" />
	<annotation>Vezi, asculţi, dai mai departe</annotation>
</item>

<item>
<title>peţeavă</title>
	<link><?php echo $host; ?>/scripts/clip/peteava_main.php</link>
	<location>http://www.peteava.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/peteava.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/peteava.png" />
	<annotation>Play me! Poţi încărca 50 de clipuri video sau 50 de imagini simultan, iar clipurile video pot avea 1 GB sau 50 min.</annotation>
</item>
<!--
<item>
<title>ViaţaLaServiciu</title>
	<link><?php echo $host; ?>/scripts/clip/php/viatalaserviciu.php</link>
	<location>http://www.viatalaserviciu.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/viatalaserviciu.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/viatalaserviciu.gif" />
	<annotation>Televizorul de la muncă</annotation>
</item>
-->
<item>
<title>VideoAlegeNet</title>
	<link><?php echo $host; ?>/scripts/clip/php/video_alege_net.php?query=0,http://video.alege.net/c-filme-noi-ro-</link>
	<location>http://video.alege.net</location>
	<image>image/videoclip.png</image>
	<media:thumbnail url="image/videoclip.png" />
	<annotation>Pentru tine</annotation>
</item>
<!--
<item>
<title>tare.ro</title>
	<link><?php echo $host; ?>/scripts/clip/php/tare.php</link>
	<location>http://www.tare.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/tare.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/tare.png" />
	<annotation>Intra pe cel mai tare album online, unde vei gasi cele mai tari imagini, melodii, poze si clipuri audio si video, plus o multime de faze amuzante. Doar pe Tare.ro .</annotation>
</item>
-->
<!--
<item>
<title>almanahe</title>
	<link><?php echo $host; ?>/scripts/clip/almanahe.php</link>
	<location>http://www.almanahe.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/almanahe.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/almanahe.png" />
	<annotation>Români cu simţul umorului, uniţi-vă!</annotation>
</item>
-->
<!--
<item>
<title>sanchi</title>
	<link><?php echo $host; ?>/scripts/clip/php/sanchi_main.php</link>
	<location>http://www.sanchi.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/sanchi.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/sanchi.jpg" />
	<annotation>Pastila ta de bună dispoziţie</annotation>
</item>
-->
<item>
<title>myvideo</title>
	<link><?php echo $host; ?>/scripts/clip/php/myvideo.php</link>
	<location>http://www.myvideo.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/myvideo.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/myvideo.gif" />
	<annotation>Iubim filmuleţele haioase!</annotation>
</item>

<item>
<title>bzi</title>
	<link><?php echo $host; ?>/scripts/clip/php/bzi.php?query=1,</link>
	<location>http://video.bzi.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/bzitv.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/bzitv.png" />
	<annotation>Reportaje video din Iasi, Reportaje video amuzante, Reportaje Necenzurate</annotation>
</item>

<item>
<title>Luzarii de pe Electrolizei</title>
<link><?php echo $host; ?>/scripts/php1/yt_playlist.php?query=1,PLA1CEC3D2A6A0263F,Luzarii+de+pe+Electrolizei</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/luzarii.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/luzarii.jpg</image>
<location>http://www.youtube.com/user/UnguruBulanOfficial</location>
<annotation>Luzarii de pe Electrolizei</annotation>
</item>

<item>
<title>Tara lui Fratzica</title>
<link><?php echo $host; ?>/scripts/php1/yt_playlist.php?query=1,PL8YoNHKjWTYA0PvglTn9OqpQiuyIrIrDq,Tara+lui+Fratzica</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/luzarii.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/luzarii.jpg</image>
<location>http://www.youtube.com/user/UnguruBulanOfficial</location>
<annotation>Tara lui Fratzica</annotation>
</item>

<item>
<title>RObotzi</title>
	<link><?php echo $host; ?>/scripts/clip/php/roboti.php?query=1,</link>
	<location>http://creativemonkeyz.com/category/roboti/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg" />
	<annotation>Website dedicat artei!</annotation>
</item>

<item>
<title>MiEZ</title>
	<link><?php echo $host; ?>/scripts/clip/php/creativemonkeyz.php?query=1,http://creativemonkeyz.com/category/shows/miez/,MiEZ</link>
	<location>http://creativemonkeyz.com/category/shows/miez/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg" />
	<annotation>Website dedicat artei!</annotation>
</item>

<item>
<title>3Lar</title>
	<link><?php echo $host; ?>/scripts/clip/php/creativemonkeyz.php?query=1,http://creativemonkeyz.com/category/shows/3lar/,3Lar</link>
	<location>http://creativemonkeyz.com/category/shows/3lar/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg" />
	<annotation>Website dedicat artei!</annotation>
</item>

<item>
<title>RECOMAND</title>
	<link><?php echo $host; ?>/scripts/clip/php/roboti_r.php?query=1,</link>
	<location>http://creativemonkeyz.com/recomand/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/roboti.jpg" />
	<annotation>Website dedicat artei!</annotation>
</item>

<item>
<title>DoZa De Has</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,DoZaDeHas</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/dozadehas.jpg" />
<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/dozadehas.jpg</image>
<location>http://dozadehas.com/</location>
<annotation></annotation>
</item>
<!--
<item>
<title>top1</title>
	<link><?php echo $host; ?>/scripts/clip/php/top1_main.php</link>
	<location>http://www.top1.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/top1.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/top1.gif" />
	<annotation>Portalul top1 este o comunitate de prieteni, intra si tu si creaza-ti cont si poti uploada propriile filme si distreaza-te cu prietenii.</annotation>
</item>
-->
<!--
<item>
<title>happyfish</title>
	<link><?php echo $host; ?>/scripts/clip/php/happyfish_main.php</link>
	<location>http://www.happyfish.ro/arhiva</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/happyfish.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/happyfish.png" />
	<annotation>Vrem altă Românie</annotation>
</item>
-->
<!--
<item>
<title>zagazaga</title>
	<link><?php echo $host; ?>/scripts/clip/php/zagazaga_main.php</link>
	<location>http://www.zagazaga.ro/video</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/zagazaga.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/zagazaga.jpg" />
	<annotation>ZagaZaga - Videoclipuri muzica funny.</annotation>
</item>
-->
<!--
<item>
<title>Vimeo</title>
	<link><?php echo $host; ?>/scripts/clip/php/vimeo_cat.php</link>
	<location>http://vimeo.com/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/vimeo.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/vimeo.jpg" />
	<annotation>Vimeo is a respectful community of creative people who are passionate about sharing the videos they make. We provide the best tools and highest quality video.</annotation>
</item>
-->
<item>
<title>Dailymotion</title>
	<link><?php echo $host; ?>/scripts/clip/dm.php</link>
	<location>http://www.dailymotion.com</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/dailymotion.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/dailymotion.png" />
	<annotation>Dailymotion is about finding new ways to see, share and engage your world through the power of online video. You can find or upload videos.</annotation>
</item>

<item>
<title>Metacafe</title>
	<link><?php echo $host; ?>/scripts/clip/php/metacafe.php?query=1</link>
	<location>http://www.metacafe.com</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/metacafe.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/metacafe.png" />
	<annotation>Metacafe - Best Videos & Funny Movies:</annotation>
</item>
<!--
<item>
<title>Discover Germany</title>
	<link><?php echo $host; ?>/scripts/clip/php/discovery.php</link>
	<location>http://mediacenter.dw.de</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/discovery.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/discovery.jpg" />
	<annotation>Discover Germany - The Travel Guide</annotation>
</item>
-->
<!--
<item>
<title>dump.</title>
	<link><?php echo $host; ?>/scripts/clip/php/dump.php</link>
	<location>http://dump.ro/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/dump.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/dump.jpg" />
	<annotation>Uploadeaza-ti si tu clipurile sau amintirile preferate, pentru a le arata prietenilor sau efectiv pentru a le avea la indemana, cu noua facilitate pe care ti-o ofera Dump.ro vei putea vedea fisierele video intr-o fereastra mult mai mare .</annotation>
</item>
-->
<!--
<item>
<title>video.rol</title>
	<link><?php echo $host; ?>/scripts/clip/video_rol_ro.php</link>
	<location>http://video.rol.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/video_rol_ro.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/video_rol_ro.gif" />
	<annotation>VideoMix.ro - video, filme, clipuri haioase, filme online, videoclipuri, muzica</annotation>
</item>
-->
<!--
<item>
<title>BlipTV</title>
	<link><?php echo $host; ?>/scripts/clip/bliptv.php</link>
	<location>http://blip.tv/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/blip_tv.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/blip_tv.jpg" />
	<annotation>Our mission is to make independent Web shows sustainable. We provide services to more than 50,000 independently produced Web shows. More than 44,000 show creators use blip.tv every day to manage their online and offline presence.</annotation>
</item>
-->
<item>
<title>funnyordie</title>
	<link><?php echo $host; ?>/scripts/clip/php/funnyordie_main.php</link>
	<location>http://www.funnyordie.com</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/funnyordie.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/funnyordie.png" />
	<annotation>funny or die - Funny videos, funny pictures, funny jokes, top ten lists, funny blogs, caption contests, and funny articles featuring celebrities, comedians, and you.</annotation>
</item>
<!--
<item>
<title>youclubvideo</title>
	<link><?php echo $host; ?>/scripts/clip/php/youclubvideo.php</link>
	<location>http://www.youclubvideo.com</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/youclubvideo.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/youclubvideo.png" />
	<annotation>YouClubVideo was started as an idea to bring together a wide variety of clubbing experiences and people from all the countries of the world that have in common the same feelings, sounds and sences of club music.</annotation>
</item>
-->
<item>
<title>dancetrippin.tv</title>
	<link><?php echo $host; ?>/scripts/clip/php/dancetrippin.php</link>
	<location>http://www.dancetrippin.tv</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/dancetrippin.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/dancetrippin.png" />
	<annotation>DanceTrippin.tv: The Man With No Shadow (aka De Man Zonder Schaduw in his homeland of the Netherlands) closes Zomerpark 2012 with a stunning set that builds and builds to the perfect ending of an amazing day in Amsterdam. Much respect to the organization GZG for this special event!</annotation>
</item>

<item>
<title>Best of YouTube (iPod video)</title>
	<link>http://feeds.feedburner.com/boyt</link>
	<location>http://feeds.feedburner.com/boyt</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/bestofyoutube.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/bestofyoutube.jpg" />
	<annotation>The best video clips from YouTube delivered directly to your iPod</annotation>
    <mediaDisplay name="threePartsView" itemBackgroundColor="0:0:0" backgroundColor="0:0:0" sideLeftWidthPC="0" itemImageXPC="5" itemXPC="20" itemYPC="20" itemWidthPC="65" capWidthPC="70" unFocusFontColor="101:101:101" focusFontColor="255:255:255" idleImageWidthPC="10" idleImageHeightPC="10">
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
               Best of YouTube
		</text>
    </mediaDisplay>
</item>
<item>
<title>Revision3</title>
<link><?php echo $host; ?>/scripts/tv/rev3.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/revision3.gif" />
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/revision3.gif</image>
<location>http://revision3.com/</location>
<annotation>Revision3 is the leading independent free online video service that offers hit TV shows including Diggnation with Kevin Rose, Scam School, Film Riot, etc.</annotation>
</item>
<!--
<item>
<title>Video Podcast from SDK4</title>
	<link>/usr/local/etc/www/cgi-bin/scripts/clip/videopodcast.rss</link>
	<location></location>
	<image>/usr/local/etc/www/cgi-bin/scripts/user/image/metafeeds.jpg</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/user/image/metafeeds.jpg" />
	<annotation>Video Podcast from SDK4</annotation>
</item>
-->
<!--
<item>
<title>HD Podcast</title>
	<link><?php echo $host; ?>/scripts/clip/php/podcasthd.php</link>
	<location>http://www.podcast.tv/high-definition-video-podcasts.html</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/podcast.png</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/podcast.png" />
	<annotation>HD-Podcasts (High Definition)  | podcast.tv is an international video podcast directory with podcast recommendations and useful podcasting functions for enjoying podcasts and learn how to podcast</annotation>
</item>
-->
<item>
<title>Video Podcast Directory</title>
	<link><?php echo $host; ?>/scripts/clip/php/videopodcasts_main.php</link>
	<location>http://www.videopodcasts.tv/</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/videopodcasts.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/videopodcasts.gif" />
	<annotation>The best video podcast directory. Search the biggest collection of video podcasts, video podcast feeds and video podcast software in the universe. Play, share, and enjoy!</annotation>
</item>


</channel>
</rss>
