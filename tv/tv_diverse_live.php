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
  server = "s6";
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
else if (userInput == "two" || userInput == "2")
{
		if (server == "s7")
           server = "s6";
		else if (server == "s6")
           server = "s5";
		else if (server == "s5")
          server = "s7";
        else
		 server = "s6";
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
	<title>TV Live - Canale diverse</title>
	<menu>main menu</menu>
<item>
<title>*** TV from Hungary ***</title>
</item>
<item>
<title>MTV m1</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://streamer.carnation.hu/mtvonlinem1",10);</onClick>
</item>
<item>
<title>MTV m2</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://streamer.carnation.hu/mtvonlinem2",10);</onClick>
</item>
<item>
<title>Duna TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://80.249.172.27/dunatv",10);</onClick>
</item>
<item>
<title>Duna II</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://80.249.172.27/autonomia",10);</onClick>
</item>
<item>
<title>Hir TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://stream3.hirtv.net/hirtv.asf",10);</onClick>
</item>
<item>
<title>Hálózat TV</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://stream02.gtk.hu/zeg_tv1",10);</onClick>
</item>

<item>
<title>Piros</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://live1.szupernet.tv:80/piros",10);</onClick>
</item>
<item>
<title>Zold</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://live1.szupernet.tv:80/zold",10);</onClick>
</item>
<item>
<title>D ???</title>
<onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://85.90.176.28:8123",10);</onClick>
</item>
<item>
<title>*** TV Live - Deutschland ***</title>
</item>
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

<item>
<title>*** TV Live - Alte Tari ***</title>
</item>
   <item>
    <title>France 24</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://stream1.france24.yacast.net/f24_liveen",10);</onClick>
  </item>


   <item>
    <title>Quararete TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://wowza1.top-ix.org/quartaretetv/quartareteweb",10);</onClick>
  </item>

<item>
<title>TVE_Internacional</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://documentos32.webcindario.com/player.swf%20-p%20http://documentos32.webcindario.com,rtmp://flash1.e-cast.co.nz/live/tve3",10);</onClick>
</item>

<item>
<title>Antena_3_Internacional</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://s3.e-monsite.com/2010/09/23/01/jw_player.swf,rtmp://antena3fms35livefs.fplive.net/antena3fms35live-live/stream-canalinternacional",10);</onClick>
</item>

<item>
<title>A3_Noticias_24h</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://s3.e-monsite.com/2010/09/23/01/jw_player.swf,rtmp://antena3fms35livefs.fplive.net/antena3fms35live-live/stream-canal24h",10);</onClick>
</item>

<item>
<title>A3_Eventos_1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://s3.e-monsite.com/2010/09/23/01/jw_player.swf,rtmp://antena3fms35livefs.fplive.net/antena3fms35live-live/stream-eventos1",10);</onClick>
</item>

<item>
<title>A3_Eventos_2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://s3.e-monsite.com/2010/09/23/01/jw_player.swf,rtmp://antena3fms35livefs.fplive.net/antena3fms35live-live/stream-eventos2",10);</onClick>
</item>

<item>
<title>Intereconomia_Business</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://media.intereconomia.com/live/business1",10);</onClick>
</item>

<item>
<title>Tele_Madrid</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp118141.live.edgefcs.net/live/TSAlaotra@47718",10);</onClick>
</item>

<item>
<title>TeleMadrid_Sat</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp118140.live.edgefcs.net/live/TSAtelemadridsat@47720",10);</onClick>
</item>

<item>
<title>TV_Canaria</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp101924.live.edgefcs.net/live/RTVC1_world@31146",10);</onClick>
</item>

<item>
<title>TV_Canaria_2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp101926.live.edgefcs.net/live/RTVC2_world@31148",10);</onClick>
</item>

<item>
<title>ETB_Sat</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp70268.live.edgefcs.net/live/eitb-ETBSat@5219",10);</onClick>
</item>

<item>
<title>Canal_Vasco</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp70268.live.edgefcs.net/live/eitb-CanalVasco@5519",10);</onClick>
</item>

<item>
<title>7RM</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.7rm.es//flashjw/player.swf%20-p%20http://www.7rm.es/servlet/rtrm.servlets.ServletLink2?METHOD,rtmp://directo7rm.redctnet.com/live",10);</onClick>
</item>

<item>
<title>Aragon_TV</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.aragontelevision.es/externos/player_aragontv/plugins/LimelightStreamingPlugin.swf%20-p%20http://www.aragontelevision.es,rtmp://aragontv.fc.llnwd.net:443/aragontv/stream_normal",10);</onClick>
</item>

<item>
<title>TV_Galicia_Europa</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://media1.crtvg.es/live/tvge",10);</onClick>
</item>

<item>
<title>TV3CAT</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://tv3cat.directe-f4v.emissio.tvcatalunya.cat/live/TV3CAT_FLV@13069",10);</onClick>
</item>

<item>
<title>TV3</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://tv3.directe-f4v.emissio.tvcatalunya.cat/live/TV3_FLV@12888",10);</onClick>
</item>

<item>
<title>3/24</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://324.directe-f4v.emissio.tvcatalunya.cat/live/324_FLV@13068",10);</onClick>
</item>

<item>
<title>El_33</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://33d.directe-f4v.emissio.tvcatalunya.cat/live/33D_FLV@13067",10);</onClick>
</item>

<item>
<title>Super3/3XL</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://k3d.directe-f4v.emissio.tvcatalunya.cat/live/K3D_FLV@13066",10);</onClick>
</item>

<item>
<title>Info_Meteo</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://jonas.do.am/player.swf%20-p%20http://jonas.do.am,rtmp://cp87402.live.edgefcs.net/live/INFOMETEO@17659",10);</onClick>
</item>

<item>
<title>TV_Publica</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.tvpublica.com.ar/recursos/media/swf/player.swf%20-p%20http://www.tvpublica.com.ar,rtmp://canal7vivoflash.telecomdatacenter.com.ar/live/livestream",10);</onClick>
</item>

<item>
<title>TeleSur</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://telesur.fms.visionip.tv/live/b2b-telesur-live-25f-4x3_4",10);</onClick>
</item>

<item>
<title>45_TV</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.flashwebtown.com/mediaplayer/mediaplayer.swf%20-p%20http://www.45tvhn.com,rtmp://shared.flashwebtown.com/lirias/45TV",10);</onClick>
</item>

<item>
<title>Giralda_TV</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.giraldatv.es/vidplayer/player.swf%20-p%20http://www.giraldatv.es,rtmp://giraldatvlivefs.fplive.net/giraldatvlive-live/stream001",10);</onClick>
</item>

<item>
<title>TVP_1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/13",10);</onClick>
</item>

<item>
<title>TVP_2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/6",10);</onClick>
</item>

<item>
<title>Polsat</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/1",10);</onClick>
</item>

<item>
<title>TVN</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/3",10);</onClick>
</item>

<item>
<title>TVN_24</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/2",10);</onClick>
</item>

<item>
<title>Comedy_Central</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/21",10);</onClick>
</item>

<item>
<title>Discovery_Channel</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/9",10);</onClick>
</item>

<item>
<title>Canal+</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/,rtmp://app.weeb.tv/live/29",10);</onClick>
</item>

<item>
<title>AE\???????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/57-al-arabiya-arabic-arabic,rtmp://media2.lsops.net/live/alarabiy_ar_high.sdp",10);</onClick>
</item>

<item>
<title>EG\??????????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://cp79926.live.edgefcs.net:1935/live?_fcs_vhost",10);</onClick>
</item>

<item>
<title>FR\?????24</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.france24.com/fr/sites/all/modules/maison/aef_player/flash/player.swf%20-p%20http://www.france24.com/fr/aef_player_popup/france24_player,rtmp://stream2.france24.yacast.net:80/france24_live/frda/f24_livefrda",10);</onClick>
</item>

<item>
<title>QA\????????????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/101-al-jazeera-mubasher-arabic,rtmp://media2.lsops.net/live/aljamuba_ar_high.sdp",10);</onClick>
</item>

<item>
<title>QA\?????????</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/125-libya-tv-arabic,rtmp://media2.lsops.net/libyatv/libyatv_ar_high.sdp",10);</onClick>
</item>

<item>
<title>RU\??????????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://arabic.rt.com/style/liveplayer.swf%20-p%20http://arabic.rt.com/live_high,rtmp://russiatoday.fms.visionip.tv/rt/Russia_al_yaum_1000k_1/1000k_1",10);</onClick>
</item>

<item>
<title>UK\BBC???????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/34-bbc-arabic-arabic,rtmp://media2.lsops.net/live/bbcarab_ar_high.sdp",10);</onClick>
</item>

<item>
<title>UK\????????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.almustakillahlive.com/live/player.swf%20-p%20http://onlinelive24.com/online/b4885,rtmp://www.almustakillahlive.com/live/livestream",10);</onClick>
</item>

<item>
<title>US\?????</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://110.164.253.197:1935/live?_fcs_vhost",10);</onClick>
</item>

<item>
<title>Hollywood</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.tvtuga.com/live47/player.swf%20-p%20http://www.tvtuga.com/streams/hollywood.php,rtmp://streamer.istreamlive.net/tvtuga/hollywood2",10);</onClick>
</item>

<item>
<title>FOX_BR</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.serv-vto.com/player4.7.swf%20-p%20http://www.brasilligado.org/parceiros/fox.html,rtmp://streamer.istreamlive.net/35_137/fox2.sdp",10);</onClick>
</item>

<item>
<title>Legend</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/modules/Video_Stream/plugins/akaim/liveplayer.swf,rtmp://fms.105.net:1935/live/legend1",10);</onClick>
</item>

<item>
<title>SKY_TG24</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/modules/Video_Stream/plugins/akaim/liveplayer.swf,rtmp://cp49989.live.edgefcs.net/live/streamRM1@2564",10);</onClick>
</item>

<item>
<title>US_TOP_40</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/script/mediaplayer/player.swf,rtmp://fms.105.net:1935/live/charts1",10);</onClick>
</item>

<item>
<title>Radio_Montecarlo_TV</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/script/mediaplayer/player.swf,rtmp://fms.105.net:1935/live/rmc1",10);</onClick>
</item>

<item>
<title>ItalyTv1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/script/mediaplayer/player.swf,rtmp://fms.105.net:1935/live/italytv1",10);</onClick>
</item>

<item>
<title>Radio_105_Network_TV</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/script/mediaplayer/player.swf,rtmp://fms.105.net:1935/live/105Test1",10);</onClick>
</item>

<item>
<title>Wnyw_Fox5_New_York_cam</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://cdn.livestream.com/grid/LSPlayer.swf,rtmp://cp61497.live.edgefcs.net/live/wnyw_live1_flash@6503",10);</onClick>
</item>

<item>
<title>PRESS_TV_1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.presstv.ir/live/llnw/LLNWPlayer.swf,rtmp://presstv.fc.llnwd.net/presstv/PressTV/PressTV",10);</onClick>
</item>

<item>
<title>C-SPAN_1</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.c-span.org/cspanVideoHD.swf,rtmp://cp82346.live.edgefcs.net:1935/live/CSPAN1@14845",10);</onClick>
</item>

<item>
<title>C-SPAN_2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.c-span.org/cspanVideoHD.swf,rtmp://cp82347.live.edgefcs.net:1935/live/CSPAN2@14846",10);</onClick>
</item>

<item>
<title>C-SPAN_3</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.c-span.org/cspanVideoHD.swf,rtmp://cp82348.live.edgefcs.net:1935/live/CSPAN3@14847",10);</onClick>
</item>

<item>
<title>UN_Television</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/79-united-nations-tv-english,rtmp://media2.lsops.net/untv/CHANNEL-7@13082",10);</onClick>
</item>

<item>
<title>oc16_Hawaii</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.oc16.tv/videoplayer/jw/player.swf%20-p%20http://www.oc16.tv/,rtmp://24.165.45.209/oc16live/oc16",10);</onClick>
</item>

<item>
<title>7RM</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.7rm.es//flashjw/player.swf%20-p%20http://www.7rm.es/servlet/rtrm.servlets.ServletLink2?METHOD,rtmp://directo7rm.redctnet.com/live",10);</onClick>
</item>

<item>
<title>ABC_News_24</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://cp103653.live.edgefcs.net:1935/live?_fcs_vhost",10);</onClick>
</item>

<item>
<title>Al_Jazeera_(EN)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://admin.brightcove.com/viewer/us1.25.04.00.2011-05-19124744/federatedVideoUI/BrightcovePlayer.swf%20-p%20http://english.aljazeera.net/watch_now/,rtmp://aljazeeraflashlivefs.fplive.net:1935/aljazeeraflashlive-live/aljazeera_english_2",10);</onClick>
</item>

<item>
<title>BBC_NEWS</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/bbcnews_en_high.sdp",10);</onClick>
</item>

<item>
<title>BBC_WORLD_NEWS</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/bbcworld1_en_high.sdp",10);</onClick>
</item>

<item>
<title>BLOOMBERG_US</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://cdn.gotraffic.net/v/20110210_153738//flash/BloombergMediaPlayer.swf%20-p%20http://www.bloomberg.com/tv/,rtmpt://cp87869.live.edgefcs.net:1935/live/us_300@21006",10);</onClick>
</item>

<item>
<title>CNN_INTERNATIONAL</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf%20-p%20http://www.livestation.com/channels/66-cnn-international,rtmp://media2.lsops.net/live/cnn_en_veryhigh.sdp",10);</onClick>
</item>

<item>
<title>EURONEWS_(EN)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/euronews_en_high.sdp",10);</onClick>
</item>

<item>
<title>EURONEWS_(FR)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/euronews_fr_high.sdp",10);</onClick>
</item>

<item>
<title>EURONEWS_(DE)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/euronews_de_high.sdp",10);</onClick>
</item>

<item>
<title>EURONEWS_(PORTOGHESE)</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/euronews_pt_high.sdp",10);</onClick>
</item>

<item>
<title>EURONEWS_(SPAIN)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.livestation.com/flash/player/5.4/player.swf,rtmp://media2.lsops.net/live/euronews_es_high.sdp",10);</onClick>
</item>

<item>
<title>NASA</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.nasa.gov/templateimages/redesign/flash_player/swf/4.5/player.swf%20-p%20http://www.nasa.gov/multimedia/nasatv/media_flash.html,rtmp://cp76072.live.edgefcs.net/live/MED-HQ-Flash@42814",10);</onClick>
</item>

<item>
<title>NHK_World</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www3.nhk.or.jp/nhkworld/r/movie/fivecool_player.0.3.6.2.swf%20-p%20http://www3.nhk.or.jp/nhkworld/r/movie/index.html,rtmp://216.155.128.59:1935/2e2cd/nhkworldhd.sdp",10);</onClick>
</item>

<item>
<title>RUSSIA_TODAY_(EN)</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://rt.com/s/swf/player5.4.viral.swf%20-p%20http://rt.com/on-air/,rtmp://fms5.visionip.tv/live/RT_3",10);</onClick>
</item>

<item>
<title>RUSSIA_TODAY_(SPAIN)</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://actualidad.rt.com/swf/player.swf%20-p%20http://actualidad.rt.com/mas/envivo/,rtmp://rt.fms.visionip.tv/live/RT_Spanish_3",10);</onClick>
</item>

<item>
<title>SUN_News_Network</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.freeetv.com/modules/Video_Stream/plugins/akaim/liveplayer.swf,rtmp://cp39414.live.edgefcs.net/live/argent@9751",10);</onClick>
</item>

<item>
<title>Musiq1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://m1.livevideo.sk/m1/m1.sdp",10);</onClick>
</item>

<item>
<title>SKY_POKER</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.estadio.in/player.swf%20-p%20http://www.estadio.in/skypoker,rtmp://cp67698.live.edgefcs.net/live/SkyPoker_500k@9124/SkyPoker_500k@9124",10);</onClick>
</item>

<item>
<title>Super_Tennis</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://109.123.96.197/ws-lexicon/ws-lexicon/supertennistvbackup",10);</onClick>
</item>

<item>
<title>HGTV_HD</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.tikilive.com/public/flash/viewerModules/player/PlayerModule.swf?version,rtmp://fms2.tikilive.com:1935/view/25503_211/stream25503",10);</onClick>
</item>

<item>
<title>ABC</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/11089/ABC,rtmp://live2.seeon.tv/edge/pk0jje65a5bk592",10);</onClick>
</item>

<item>
<title>CBS</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/6802/CBS,rtmp://live1.seeon.tv/edge/pzx79urgrh2qjaj",10);</onClick>
</item>

<item>
<title>NBC</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/3809/NBC,rtmp://live4.seeon.tv/edge/uijs8reafi8i2ay",10);</onClick>
</item>

<item>
<title>Discovery_Channel</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/117/,rtmp://live7.seeon.tv/edge/z78vu2irprzsvix",10);</onClick>
</item>

<item>
<title>Nickelodeon</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/10007/Nickelodeon,rtmp://live6.seeon.tv/edge/vdoycrdqyxtmac5",10);</onClick>
</item>

<item>
<title>STARZ</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/12466/StarZ_movies,rtmp://live8.seeon.tv/edge/0zp72w21x0n9slr",10);</onClick>
</item>

<item>
<title>SyFy</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.seeon.tv/jwplayer/player.swf%20-p%20http://www.seeon.tv/view/158/,rtmp://live5.seeon.tv/edge/qamnib1julbnx0b",10);</onClick>
</item>

<item>
<title>REDE_TV</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.redetv.com.br/player/jw/4.4/player.swf%20-p%20http://www.redetv.com.br/player/jw/4.4/player.swf,rtmp://live.redetv.com.br/redetvlive/livestream",10);</onClick>
</item>

<item>
<title>TV_Brasil</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://centraltv.50webs.com/jw_player.swf%20-p%20http://www.centraltv.fr/rubrique,tv-brasil-hd,765409.html,rtmp://cp92616.live.edgefcs.net/live/TVBrasil@35103/TVBrasil@35103",10);</onClick>
</item>

<item>
<title>RTP_1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www0.rtp.pt/play/rtpplay.swf,rtmp://195.245.168.33:80/livetv/_definst_/2ch5h264",10);</onClick>
</item>

<item>
<title>RTP_2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www0.rtp.pt/play/rtpplay.swf,rtmp://195.245.168.26:80/livetv/_definst_/2ch3h264",10);</onClick>
</item>

<item>
<title>RTP_Memória</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www0.rtp.pt/play/rtpplay.swf,rtmp://195.245.168.33:80/livetv/_definst_/2ch80h264",10);</onClick>
</item>

<item>
<title>Economico_TV</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://cp89928.live.edgefcs.net:443/live?ovpfv",10);</onClick>
</item>

<item>
<title>AniMax_br</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tv-msn.com/player/player.swf%20-p%20http://tv-msn.com/animax.html,rtmp://cdn2.mastertv.net/ueba23/animax/animax",10);</onClick>
</item>

<item>
<title>Nick_br</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tv-msn.com/player/player.swf%20-p%20http://tv-msn.com/nick.html,rtmp://cdn2.mastertv.net/ueba23/nick/nick",10);</onClick>
</item>

<item>
<title>FOX_LIFE</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.tvtuga.com/live47/player.swf%20-p%20http://www.tvtuga.com/streams/ed-foxlife.php,rtmp://streamer.istreamlive.net/tvtuga/foxlife_3",10);</onClick>
</item>

<item>
<title>RTÉ_1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.rte.ie/player/assets/player_403.swf,rtmpte://fmsod.rte.ie/live/rte1",10);</onClick>
</item>

<item>
<title>RTÉ_2</title>

<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.rte.ie/player/assets/player_403.swf,rtmpte://fmsod.rte.ie/live/rte2",10);</onClick>
</item>

<item>
<title>ROUGE_TV</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvplayer.castlemedia.fr/swf/tvplayer.swf?4dadb783f0a81537187120216%20-p%20http://www.playtv.fr/television/#rouge-tv,rtmp://rougetv",10);</onClick>
</item>

<item>
<title>KTO</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://tvplayer.castlemedia.fr/swf/tvplayer.swf?4dadb783f0a81537187120216%20-p%20http://www.playtv.fr/television/#kto,rtmp://cp99495.live.edgefcs.net/live/Flash_live_KTO_TV@27823",10);</onClick>
</item>

<item>
<title>TVM_Est_Parisien</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.infomaniak.ch/livetv/player-v3.swf?cfg,rtmp://cineplume",10);</onClick>
</item>

<item>
<title>Deutsche_Welle_Europa</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://mediacenter.dw-world.de/player/flash/mediaplayer.swf,rtmpt://c13010-ls.f.core.cdn.streamfarm.net/dwworldlive-live/13010dwtveu1024/13010dwtveu1024.flv",10);</onClick>
</item>


</channel>
</rss>
