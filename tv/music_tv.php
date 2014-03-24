#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<script>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";

  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";
  storagePath_playlist    = storagePath + "playlist.dat";

  error_info          = "";
</script>
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
	sliding="no"
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
  image/tv_radio.png
		</image>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
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

<channel>
	<title>TV Live - Muzica</title>
	<menu>main menu</menu>

   <item>
   <title>OneHD Concerts</title>
   <link>/usr/local/etc/www/cgi-bin/scripts/tv/onehd_concert.rss</link>
   </item>

   <item>
    <title>Virgin TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/virgin1",10);</onClick>
  </item>
   <!--
   <item>
    <title>Top 40</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/charts1",10);</onClick>
  </item>

   <item>
    <title>Italy TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/italytv1",10);</onClick>
  </item>

   <item>
    <title>Legend</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/legend1",10);</onClick>
  </item>
   -->
   <item>
    <title>Radio 105 TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/105Test1",10);</onClick>
  </item>

   <item>
    <title>Radio Monte Carlo</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.105.net:1935/live/rmc1",10);</onClick>
  </item>
    <!--
   <item>
    <title>Music 1</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://80.94.85.180/live/stream21",10);</onClick>
  </item>

   <item>
    <title>DeeJay TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://wm.streaming.kataweb.it/reflector:40004",10);</onClick>
  </item>
    -->
   <item>
    <title>1 Music</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://80.232.172.37/rtplive/vlc.sdp",10);</onClick>
  </item>

   <item>
    <title>RougeTv</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.rougetv.ch/JWPlayer/mediaplayer/player.swf%20-p%20http://www.rougetv.ch,rtmp://rtmp.infomaniak.ch/livecast/rougetv",10);</onClick>
  </item>

   <item>
    <title>play.me</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://cp107974.live.edgefcs.net:80/live/beep-flash-live@34654",10);</onClick>
  </item>
  
   <item>
    <title>Rock One TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://mediatv2.topix.it/24RockOne66",10);</onClick>
  </item>

   <item>
    <title>Clap Tv</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://rr93.diffusepro.com/rr93",10);</onClick>
  </item>

   <item>
    <title>Soleil TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://live240.impek.com/soleiltv?MSWMExt=.asf",10);</onClick>
  </item>
   <!--
   <item>
    <title>Music Box</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://81.89.49.210/musicbox",10);</onClick>
  </item>
  -->

   <item>
    <title>HIP HOP TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://93.152.172.201/hiphoptv",10);</onClick>
  </item>

   <item>
    <title>Spirit Television</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://nyc04.egihosting.com/839181",10);</onClick>
  </item>
   <!--
   <item>
    <title>StreetClip TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://85.214.55.57:1234",10);</onClick>
  </item>
   -->
   <item>
    <title>Labelle TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtsp://www.labelletv.com/labelletv",10);</onClick>
  </item>
   <!--
   <item>
    <title>Ibiza on TV Live TV from Italy</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtsp://81.174.67.45/ibizaontv",10);</onClick>
  </item>

   <item>
    <title>La Locale</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtsp://stream.lalocale.com/lalocale",10);</onClick>
  </item>
   -->
   <item>
    <title>Play TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtsp://93.103.4.16/playtv",10);</onClick>
  </item>


</channel>
</rss>
