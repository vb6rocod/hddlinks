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
	<title>High Definition TV</title>
	<menu>main menu</menu>

<item>
<title>Eurosport HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010601.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010601.stream",10);</onClick>
</item>

<item>
<title>Eurosport 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010301.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010301.stream",10);</onClick>
</item>

<item>
<title>Discovery HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050208.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050208.stream",10);</onClick>
</item>	

<item>
<title>Nat Geo WILD HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050204.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050204.stream",10);</onClick>
</item>	

<item>
<title>Discovery Showcase HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050002.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050002.stream",10);</onClick>
</item>
	
<item>
<title>Animal Planet HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050001.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050001.stream",10);</onClick>
</item>	

<item>
<title>Nat Geo HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050203.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050203.stream",10);</onClick>
</item>	

<item>
<title>History HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050003.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050003.stream",10);</onClick>
</item>

<item>
<title>Bio HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020204.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020204.stream",10);</onClick>
</item>	

<item>
<title>BBC HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010201.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010201.stream",10);</onClick>
</item>

<item>
<title>CCTV News</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050222.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050222.stream",10);</onClick>
</item>

<item>
<title>MTV Live HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010001.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010001.stream",10);</onClick>
</item>

<item>
<title>HBO HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010402.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010402.stream",10);</onClick>
</item>

<item>
<title>HBO 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010701.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010701.stream",10);</onClick>
</item>

<item>
<title>Comedy Central HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020503.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020503.stream",10);</onClick>
</item>

<item>
<title>Cinema Comedy HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050205.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050205.stream",10);</onClick>
</item>	

<item>
<title>Cinema Hits HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050211.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050211.stream",10);</onClick>
</item>	

<item>
<title>Cinema Max HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050206.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050206.stream",10);</onClick>
</item>	

<item>
<title>Cinemax HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050221.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050221.stream",10);</onClick>
</item>

<item>
<title>Cinemamax 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010401.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010401.stream",10);</onClick>
</item>

<item>
<title>Sky Cinema 1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050207.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050207.stream",10);</onClick>
</item>	

<item>
<title>Disney XD HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020101.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020101.stream",10);</onClick>
</item>

<item>
<title>Nickelodeon HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050007.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050007.stream",10);</onClick>
</item>

<item>
<title>ITV2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020102.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020102.stream",10);</onClick>
</item>

<item>
<title>ITV3 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020103.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020103.stream",10);</onClick>
</item>

<item>
<title>MGM HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z020401.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z020401.stream",10);</onClick>
</item>

<!-- Germany -->
<item>
<title>Sport1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z130103.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z130103.stream",10);</onClick>
</item>

<item>
<title>Das Erste HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030402.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z030402.stream",10);</onClick>
</item>

<item>
<title>ZDF HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030401.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z030401.stream",10);</onClick>
</item>

<item>
<title>N24 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050008.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050008.stream",10);</onClick>
</item>

<item>
<title>PRO7 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010102.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010102.stream",10);</onClick>
</item>

<item>
<title>RTL HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030101.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z030101.stream",10);</onClick>
</item>

<!-- item>
<title>RTL2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030104.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z030104.stream",10);</onClick>
</item -->

<item>
<title>RTL2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050219.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050219.stream",10);</onClick>
</item>

<item>
<title>Sat1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010101.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010101.stream",10);</onClick>
</item>

<item>
<title>SIXX HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010104.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010104.stream",10);</onClick>
</item>

<!-- item>
<title>Vox HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z030102.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z030102.stream",10);</onClick>
</item -->

<item>
<title>Vox HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050220.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050220.stream",10);</onClick>
</item>

<!-- France -->
<item>
<title>France 24</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050213.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050213.stream",10);</onClick>
</item>

<item>
<title>FT1 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010107.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010107.stream",10);</onClick>
</item>	

<item>
<title>France 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010105.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010105.stream",10);</onClick>
</item>	

<item>
<title>M6 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010106.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010106.stream",10);</onClick>
</item>	

<item>
<title>Arte HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050218.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050218.stream",10);</onClick>
</item>

<!-- Italy -->
<item>
<title>Rai News</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050217.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050217.stream",10);</onClick>
</item>

<item>
<title>Rai 1</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050214.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050214.stream",10);</onClick>
</item>

<item>
<title>Rai 2</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050215.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050215.stream",10);</onClick>
</item>

<item>
<title>Italia 1</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010502.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010502.stream",10);</onClick>
</item>	

<item>
<title>Canale 5</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z010501.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z010501.stream",10);</onClick>
</item>	

<item>
<title>Rai Movie</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050216.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050216.stream",10);</onClick>
</item>

<item>
<title>Fox</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050210.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050210.stream",10);</onClick>
</item>	

<item>
<title>Fox Crime</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z050209.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z050209.stream",10);</onClick>
</item>	

<!-- Rusia -->
<item>
<title>CTC</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z040003.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z040003.stream",10);</onClick>
</item>	

<item>
<title>THT</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z040004.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z040004.stream",10);</onClick>
</item>	

<item>
<title>HTB</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z040001.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z040001.stream",10);</onClick>
</item>	

<item>
<title>Channel One</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z040002.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z040002.stream",10);</onClick>
</item>	

<!-- Adult -->
<!--
<item>
<title>Penthouse HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z990103.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z990103.stream",10);</onClick>
</item>

<item>
<title>Penthouse 2 HD</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-b%2060000%20-W%20http://tvsector.com/mediaplayer/player.swf%20-y%20z990104.stream%20-p%20http://tvsector.com/,rtmp://s99.webport.tv/live/z990104.stream",10);</onClick>
</item>
-->
</channel>
</rss>
