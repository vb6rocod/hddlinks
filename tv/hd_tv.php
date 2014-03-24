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

  	<text align="center" offsetXPC="3" offsetYPC="5" widthPC="94" heightPC="10" fontSize="25" backgroundColor="10:105:150" foregroundColor="255:255:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="88" offsetYPC="7" widthPC="8" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="255:255:255">
		  <script>sprintf("%s/", focus-(-1))+itemCount;</script>
		</text>
		<image  redraw="yes" offsetXPC=65 offsetYPC=35 widthPC=30 heightPC=30>
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
			<text align="left"  lines="0" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
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
  			    if(focus==idx) "10:105:150"; else "-1:-1:-1";
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
	<title>High Definition Tv</title>
	<menu>main menu</menu>
	
<item>
<title>Animal Planet HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050001.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z050001.stream",10);</onClick>
</item>	

<item>
<title>BBC HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010201.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010201.stream",10);</onClick>
</item>

<item>
<title>Comedy Central HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020503.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z020503.stream",10);</onClick>
</item>

<item>
<title>Das Erste HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030402.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030402.stream",10);</onClick>
</item>

<item>
<title>Discovery Showcase HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050002.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z050002.stream",10);</onClick>
</item>

<item>
<title>Disney XD HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020101.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z020101.stream",10);</onClick>
</item>

<item>
<title>Eurosport HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010601.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010601.stream",10);</onClick>
</item>

<item>
<title>Eurosport 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010301.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010301.stream",10);</onClick>
</item>

<item>
<title>ESPN America HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050201.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z050201.stream",10);</onClick>
</item>

<item>
<title>HBO HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010402.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010402.stream",10);</onClick>
</item>

<item>
<title>HBO 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010701.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010701.stream",10);</onClick>
</item>

<item>
<title>History HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050003.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z050003.stream",10);</onClick>
</item>

<item>
<title>ITV2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020102.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z020102.stream",10);</onClick>
</item>

<item>
<title>ITV3 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020103.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z020103.stream",10);</onClick>
</item>

<item>
<title>Kabel 1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010103.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010103.stream",10);</onClick>
</item>

<item>
<title>MGM HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020401.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z020401.stream",10);</onClick>
</item>

<item>
<title>MTV HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010001.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010001.stream",10);</onClick>
</item>

<item>
<title>N24 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050008.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z050008.stream",10);</onClick>
</item>

<item>
<title>PRO7 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010102.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010102.stream",10);</onClick>
</item>

<item>
<title>RTL2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030104.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030104.stream",10);</onClick>
</item>

<item>
<title>RTL HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030101.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030101.stream",10);</onClick>
</item>

<item>
<title>Sat1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010101.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z010101.stream",10);</onClick>
</item>

<item>
<title>SIXX HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030104.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030104.stream",10);</onClick>
</item>

<item>
<title>Sport1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030103.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030103.stream",10);</onClick>
</item>

<item>
<title>Vox HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030102.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030102.stream",10);</onClick>
</item>

<item>
<title>ZDF HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030401.stream%20-p%20http://tvsector.com/,rtmp://s7.webport.tv/live/z030401.stream",10);</onClick>
</item>


</channel>
</rss>
