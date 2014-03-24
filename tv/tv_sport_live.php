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
	<title>TV Live - Canale sport</title>
	<menu>main menu</menu>

	<item>
	<title>Orange sport info (fr)</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,mms://livewm.orange.fr/live-multicanaux",10);</onClick>
	</item>

	<item>
	<title>SPORT ITALIA 24</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://94.32.101.11/streamit/solocalciolive.flv",10);</onClick>
	</item>
	
	<item>
	<title>CSPN</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,mms://58.48.156.93/hubeitiyu",10);</onClick>
	</item>
	
    <item>
	<title>Sport TV (Greek)</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,mms://broadcast.hol.gr/tvmagic",10);</onClick>
	</item>
    -->
    <item>
	<title>Iraqi Media Sport</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,mms://212.7.196.74/sport",10);</onClick>
	</item>

	<item>
	<title>Quartarete 4</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.tv-tube.net/net.tv-tube/players/jwflashplayer/player.swf%20-p%20http://www.tv-tube.net/tvchannels/watch/862/quartarete-4,rtmp://wowza1.top-ix.org/quartaretetv/quartareteweb",10);</onClick>
	</item>

	<item>
	<title>Sport.ro</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://assets.acasatv.ro/assets/flvplayer/player.swf%20-p%20http://www.sport.ro/live/show-player/id_stream/ibu1,rtmp://live.sport.ro/live1/mp4:live1.mp4",10);</onClick>
	</item>

	<item>
	<title>SPORT 1 UKRAINA</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://212.40.43.10/sport1/sport1i1.stream",10);</onClick>
	</item>
	
	<item>
	<title>SPORT 2 UKRAINA</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://212.40.43.10/sport1/sport2i1.stream",10);</onClick>
	</item>
	
</channel>
</rss>
