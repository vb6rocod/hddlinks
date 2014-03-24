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
	<title>TV Live - Deutschland</title>
	<menu>main menu</menu>

<item>
<title>NDR Hamburg</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://ndr-fs-hh-hi-wmv.wm.llnwd.net/ndr_fs_hh_hi_wmv",10);</onClick>
</item>
<item>
<title>3Sat</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://a62.l12560554061.c125605.g.lm.akamaistream.net/D/62/125605/v0001/reflector:54061",10);</onClick>
</item>
<item>
<title>Rhein Main TV Livestream</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://rheinmaintv-livestream.de/rmtv-livestream",10);</onClick>
</item>
<item>
<title>Fashion-TV_deutsch_15</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://213.155.73.87/Fashion-TV_deutsch_15",10);</onClick>
</item>
<item>
<title>ARD Tagesschau</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://tagesschau-live2-webm-wmv.wm.llnwd.net/tagesschau_live2_webm_wmv",10);</onClick>
</item>
<item>
<title>AlexTV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://alex-stream.rosebud-media.de/live/flv:alexlivestream",10);</onClick>
</item>

<item>
<title>NRW TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://82.197.179.191:1935/nrwtv/nrwtv",10);</onClick>
</item>
<item>
<title>NOA4 Hamburg</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://wt-wm1.wtnet.de/noa4hh-stream-mid?.wma",10);</onClick>
</item>
<item>
<title>VRF Vogtland </title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://stream.vrf.de/VRF",10);</onClick>
</item>
<item>
<title>Center.tv Dusseldorf</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://80.246.121.90/ctv",10);</onClick>
</item>
<item>
<title>1-2-3 TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://cp83240.live.edgefcs.net:80/live?ovpfv=1.1/123TV_Live_Flash@14882",10);</onClick>
</item>
<item>
<title>Oberpfalz TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://sv18.muc2.hofmeirmedia.net/otv/otv/otv",10);</onClick>
</item>
<item>
<title>Feuer TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://213.155.73.172/feuer-tv_standard_10",10);</onClick>
</item>
<item>
<title>Franken TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://flash1.stream24.net:80/frankentv/live",10);</onClick>
</item>
<item>
<title>Worm TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://wms.global-streaming.net/04988",10);</onClick>
</item>
<item>
<title>Oeins TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://streaming.orgatech.de/live/oeins",10);</onClick>
</item>
<item>
<title>QVC Deutschland</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fml.0D89.edgecastcdn.net/200D89/qvc01-16_9_1",10);</onClick>
</item>
<item>
<title>Sonnenklar TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://c11010-l.f.core.cdn.streamfarm.net/11010euvia/live/3843sonnenklartv/live_de_550",10);</onClick>
</item>
<item>
<title>Auto TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://213.155.85.158/TuningWorld-TV_Auto-TV_15",10);</onClick>
</item>
<item>
<title>DAF</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://fms.daf.tmt.de:1935/live/dafstream",10);</onClick>
</item>

<item>
<title>Thueringer Landtag</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://streaming-internet2.fem.tu-ilmenau.de/landtag_dsl",10);</onClick>
</item>
<item>
<title>Massive Mag TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://stream01.massive-mag.tv/massivemag_mq",10);</onClick>
</item>


</channel>
</rss>
