#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  screenXp = 4;
  screenYp = 3;
  item_type = 0;
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>

	<mediaDisplay name=photoView 
	  centerXPC=7 
		centerYPC=7
		centerHeightPC=85
		columnCount="6"
		rowCount="4"
        imageBorderPC="1.5"
		menuBorderColor="55:55:55"
		sideColorBottom="0:0:0"
		sideColorTop="0:0:0"
	    backgroundColor="0:0:0"
		imageBorderColor="10:105:150"
		itemBackgroundColor="0:0:0"
		itemGapXPC=1
		itemGapYPC=4
		sideTopHeightPC=0
		bottomYPC=0
		sliding=yes
		showHeader=no
		showDefaultInfo=no
		idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
<!--
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
		

  	<text redraw="yes" offsetXPC="82" offsetYPC="12" widthPC="13" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

-->
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
        
		<itemDisplay>
      <script>
				imageW = 90/6;
				if(item_type == 0)
				{
					imageH = imageW * 3 / 4 * screenXp / screenYp * 100 / 35;
					if(imageH > 50)
					{
					  imageH = 50;
					  imageW = imageH * 4 / 3 * screenYp / screenXp * 35 / imageW;
					}
				  else
				  {
				    imageW = 100;
          }
        }					
				else
				{
					imageH = imageW * 203 / 140 * screenXp / screenYp * 100 / 35;
					if(imageH > 100)
					{
					  imageH = 100;
					  imageW = imageH * 140 / 203 * screenYp / screenXp * 35 / imageW;
					}
				  else
				  {
				    imageW = 100;
          }
				}
      </script>
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
			 <widthPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 90; else 75;
			   </script>
			 </widthPC>
			 <heightPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 40; else 30;
			   </script>
			 </heightPC>
			 <offsetXPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 5; else 12;
			   </script>
			 </offsetXPC>
			 <offsetYPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 2; else 4;
			   </script>
			 </offsetYPC>
			</image>
			
			<text align="center" lines="4" offsetXPC=0 offsetYPC=55 widthPC=100 heightPC=45 backgroundColor=-1:-1:-1>
				<script>
					idx = getQueryItemIndex();
					if(item_type == 0)
  					getItemInfo(idx, "title");
  			  else
  			    "";
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
  				</script>
				</fontSize>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:150"; else "75:75:75";
  				</script>
			  </foregroundColor>
			</text>

		</itemDisplay>

	</mediaDisplay>
<channel>

<title>Adult Channel - XXX</title>
<!--
<item>
<title>online-moviez</title>
<link><?php echo $host; ?>/scripts/filme/php/online-moviez1.php</link>
<image>image/adult.png</image>
</item>
-->
<!--
<item>
<title>Porn TV</title>
<link><?php echo $host; ?>/scripts/adult/porn_tv.php</link>
<image>image/adult.png</image>
</item>
-->
<!--
<item>
<title>Porn TV</title>
  <link><?php echo $host; ?>/scripts/adult/php/pornofanatic.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/tv/image/tvlive.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>porno720p</title>
  <link><?php echo $host; ?>/scripts/adult/php/porno720p.php?query=1,http://porno720p.com</link>
<image>image/adult.png</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Tube8</title>
  <link><?php echo $host; ?>/scripts/adult/tube8.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/tube8.png</image>
<mediaDisplay name="threePartsView"/>
</item>

<!--
<item>
<title>KeezMovies</title>
  <link><?php echo $host; ?>/scripts/adult/keezmovies.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/KeezMovies.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>extremetube</title>
  <link><?php echo $host; ?>/scripts/adult/php/extremetube_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/extremetube.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>friktube</title>
  <link><?php echo $host; ?>/scripts/adult/friktube.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/friktube.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>pornmehorny</title>
  <link><?php echo $host; ?>/scripts/adult/pornmehorny.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/pornmehorny.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>penthouse</title>
  <link><?php echo $host; ?>/scripts/adult/penthousevideos.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/penthousevideos.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>tjoob</title>
  <link><?php echo $host; ?>/scripts/adult/tjoob.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/tjoob.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>behindkink</title>
  <link><?php echo $host; ?>/scripts/adult/php/behindkink.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/behindkink.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>moviesand</title>
  <link><?php echo $host; ?>/scripts/adult/moviesand.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/moviesand.gif</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>pornrabbit</title>
  <link><?php echo $host; ?>/scripts/adult/pornrabbit.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/pornrabbit.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>pornvisit</title>
  <link><?php echo $host; ?>/scripts/adult/pornvisit.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/pornvisit.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>eporner</title>
  <link><?php echo $host; ?>/scripts/adult/eporner.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/eporner.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>snizzshare</title>
  <link><?php echo $host; ?>/scripts/adult/snizzshare.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/snizzshare.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>hardsextube</title>
  <link><?php echo $host; ?>/scripts/adult/php/hardsextube_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/hardsextube.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>pornomovies</title>
  <link><?php echo $host; ?>/scripts/adult/pornomovies.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/pornomovies.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>sexbot</title>
  <link><?php echo $host; ?>/scripts/adult/sexbot.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/sexbot.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>myjizztube</title>
  <link><?php echo $host; ?>/scripts/adult/myjizztube.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/myjizztube.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>timtube</title>
  <link><?php echo $host; ?>/scripts/adult/php/timtube.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/timtube.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>drtuber</title>
  <link><?php echo $host; ?>/scripts/adult/drtuber.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/drtuber.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>home-tube</title>
  <link><?php echo $host; ?>/scripts/adult/php/home-video-tube.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/home-video-tube.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>flytube</title>
  <link><?php echo $host; ?>/scripts/adult/flytube.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/flytube.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>xhamster</title>
  <link><?php echo $host; ?>/scripts/adult/php/xhamster_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/xhamster.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>redtube</title>
  <link><?php echo $host; ?>/scripts/adult/php/redtube_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/redtube.png</image>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>XXX4PODS</title>
<link>http://xxx4pods.com/podcasts/podcast.xml</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/xxx4pods.png</image>
<mediaDisplay name="threePartsView" sideLeftWidthPC="0" itemImageXPC="5" itemXPC="20" itemYPC="20" itemWidthPC="65" capWidthPC="70" unFocusFontColor="101:101:101" focusFontColor="255:255:255" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
<backgroundDisplay>
<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
image/mele/backgd.jpg
</image>
</backgroundDisplay>
<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
image/mele/rss_title.jpg
</image>
<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
XXX4PODS
</text>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
</mediaDisplay>
</item>
<!--
<item>
<title>French Maid TV</title>
<link>http://feeds.feedburner.com/FrenchMaidTV</link>
<mediaDisplay name="threePartsView" sideLeftWidthPC="0" itemImageXPC="5" itemXPC="20" itemYPC="20" itemWidthPC="65" capWidthPC="70" unFocusFontColor="101:101:101" focusFontColor="255:255:255" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
<backgroundDisplay>
<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
image/mele/backgd.jpg
</image>
</backgroundDisplay>
<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
image/mele/rss_title.jpg
</image>
<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
French Maid TV
</text>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
</mediaDisplay>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/french_maid_tv.png</image>
</item>

  <item>
<title>TnaFlix</title>
<link><?php echo $host; ?>/scripts/adult/tna.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/TnaFlix.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
  <item>
<title>Youporn</title>
<link><?php echo $host; ?>/scripts/adult/php/youporn_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/youporn.png</image>
<mediaDisplay name="threePartsView"/>
</item>
-->

  <item>
<title>Spankwire</title>
<link><?php echo $host; ?>/scripts/adult/php/spankwire_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/spankwire.gif</image>
<mediaDisplay name="threePartsView"/>
</item>

  <item>
<title>empflix</title>
<link><?php echo $host; ?>/scripts/adult/php/empflix_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/empflix.gif</image>
<mediaDisplay name="threePartsView"/>
</item>

  <item>
<title>alotporn</title>
<link><?php echo $host; ?>/scripts/adult/php/alotporn_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/alotporn.png</image>
<mediaDisplay name="threePartsView"/>
</item>
  <item>
<title>xnxx</title>
<link><?php echo $host; ?>/scripts/adult/php/xnxx_main.php</link>
<image>/usr/local/etc/www/cgi-bin/scripts/adult/image/xnxx.gif</image>
<mediaDisplay name="threePartsView"/>
</item>
<item>
<title>Hardcore</title>
  <link><?php echo $host; ?>/scripts/adult/php/seenow_satin.php?query=Private+Hardcore</link>
<image>image/adult.png</image>
<mediaDisplay name="threePartsView"/>
</item>
<item>
<title>Softcore</title>
  <link><?php echo $host; ?>/scripts/adult/php/seenow_satin.php?query=Private+Softcore</link>
<image>image/adult.png</image>
<mediaDisplay name="threePartsView"/>
</item>
<item>
<title>Mix</title>
  <link><?php echo $host; ?>/scripts/adult/php/seenow_satin.php?query=Private+Mix</link>
<image>image/adult.png</image>
<mediaDisplay name="threePartsView"/>
</item>
</channel>
</rss>
