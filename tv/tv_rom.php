#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//http://balancer.digi24.ro/?scope=digi24&type=rtmp&quality=hq&t=1355201126707
$l="http://www.digi24.ro/balancer.new/?scope=digi24&type=rtmp&quality=hq&t=";
$l="http://balancer.digi24.ro/?scope=digi24&type=rtmp&quality=hq&t=";
$h=file_get_contents($l);
$h=str_replace("\\","",$h);
$digi_rtmp=str_between($h,'streamer":"','"');
$digi_file=str_between($h,'file":"','"');
$l="http://www.digi24.ro/balancer.new/?scope=digisport1desk&type=rtmp&quality=hq&t=";
$l="http://balancer.digi24.ro/?scope=digisport1desk&type=rtmp&quality=hq&t=";
$h=file_get_contents($l);
$h=str_replace("\\","",$h);
$digi1_rtmp=str_between($h,'streamer":"','"');
$digi1_file=str_between($h,'file":"','"');
$l="http://www.digi24.ro/balancer.new/?scope=digisport2desk&type=rtmp&quality=hq&t=";
$l="http://balancer.digi24.ro/?scope=digisport2desk&type=rtmp&quality=hq&t=";
$h=file_get_contents($l);
$h=str_replace("\\","",$h);
$digi2_rtmp=str_between($h,'streamer":"','"');
$digi2_file=str_between($h,'file":"','"');
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  <?php
  echo 'digi_rtmp="'.$digi_rtmp.'";';
  echo 'digi_file="'.$digi_file.'";';
  echo 'digi1_rtmp="'.$digi1_rtmp.'";';
  echo 'digi1_file="'.$digi1_file.'";';
  echo 'digi2_rtmp="'.$digi2_rtmp.'";';
  echo 'digi2_file="'.$digi2_file.'";';
  ?>
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
  <title>TV Live Romania</title>



<item>
<title>Antena 2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live%20-W%20http://ivm.inin.ro/swf/player_live4.swf%20-p%20http://www.antena2.ro/live%20-y%20a2%20-x%20122410%20-w%2099fa9798751989f276ed92c5b269b7db02fd48d614e993d2f659da1a0d537dbb,rtmp://live1.gsp.ro/live",10);</onClick>
</item>

	<item>
	<title>Antena 3</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://93.115.84.226:1935/live/a3",10);</onClick>
	</item>

	<item>
	<title>Banat TV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://81.18.66.155/live/banat-tv",10);</onClick>
	</item>

	<item>
	<title>Transilvania Look</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://193.239.252.30/LookTV/ll3",10);</onClick>
	</item>

	<item>
	<title>EST TV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://81.12.152.250/live/esttv",10);</onClick>
	</item>

	<item>
	<title>WEST TV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://86.106.82.47/westtv_live/livestream.flv",10);</onClick>
	</item>

	<item>
	<title>Informatia TV</title>
	<onClick>playItemURL("http://94.60.44.130:8014/stream.flv",10);</onClick>
	</item>
	
    <item>
    <title>protv news</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-y%20mp4:live1.mp4%20-W%20http://d1.a4w.ro/customFlow/flowplayer-3.2.12.swf%20-p%20http://stirileprotv.ro/protvnews,rtmp://live.protv.ro/news/";
    titlu="rtmp://live.protv.ro/news/";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://live.protv.ro/news/</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2CRtmp-options%3A-y%2520mp4%3Alive1.mp4%2520-W%2520http%3A%2F%2Fd1.a4w.ro%2FcustomFlow%2Fflowplayer-3.2.12.swf%2520-p%2520http%3A%2F%2Fstirileprotv.ro%2Fprotvnews%2Crtmp%3A%2F%2Flive.protv.ro%2Fnews%2F</link1>
    <title1>protv+news</title1>
    </item>

    <item>
    <title>6 TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.149.7.178:8800/flv-audio-video/";
    titlu="http://89.149.7.178:8800/flv-audio-video/";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.149.7.178:8800/flv-audio-video/</annotation>
    <link1>http%3A%2F%2F89.149.7.178%3A8800%2Fflv-audio-video%2F</link1>
    <title1>6+TV</title1>
    </item>
<!--
    <item>
    <title>Etalon</title>
    <onClick>
    <script>
    showIdle();
    url="http://82.137.6.131:8080";
    titlu="http://82.137.6.131:8080";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://82.137.6.131:8080</annotation>
    <link1>http%3A%2F%2F82.137.6.131%3A8080</link1>
    <title1>Etalon</title1>
    </item>


    <item>
    <title>OLTENIA 3TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.38.104.4:8080/O3TV.flv";
    titlu="http://89.38.104.4:8080/O3TV.flv";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.38.104.4:8080/O3TV.flv</annotation>
    <link1>http%3A%2F%2F89.38.104.4%3A8080%2FO3TV.flv</link1>
    <title1>OLTENIA+3TV</title1>
    </item>
-->
    <item>
    <title>PVTV(pescuit si vanatoare)</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live%20-W%20http://live.pvtv.ro/live-old/player.swf%20-p%20http://live.pvtv.ro/%20-y%20rtmp,rtmp://stream.pvtv.ro/live";
    titlu="rtmp://stream.pvtv.ro/live";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://stream.pvtv.ro/live</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2CRtmp-options%3A-a%2520live%2520-W%2520http%3A%2F%2Flive.pvtv.ro%2Flive-old%2Fplayer.swf%2520-p%2520http%3A%2F%2Flive.pvtv.ro%2F%2520-y%2520rtmp%2Crtmp%3A%2F%2Fstream.pvtv.ro%2Flive</link1>
    <title1>PVTV%28pescuit+si+vanatoare%29</title1>
    </item>

    <item>
    <title>Romania TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://rtvflash.smcmobile.ro:8010/rtv.flv";
    titlu="http://rtvflash.smcmobile.ro:8010/rtv.flv";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://rtvflash.smcmobile.ro:8010/rtv.flv</annotation>
    <link1>http%3A%2F%2Frtvflash.smcmobile.ro%3A8010%2Frtv.flv</link1>
    <title1>Romania+TV</title1>
    </item>

    <item>
    <title>WEST TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://86.106.82.47/westtv_live/livestream";
    titlu="rtmp://86.106.82.47/westtv_live/livestream";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://86.106.82.47/westtv_live/livestream</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2C%2Crtmp%3A%2F%2F86.106.82.47%2Fwesttv_live%2Flivestream</link1>
    <title1>WEST+TV</title1>
    </item>


    <item>
    <title>Moldova 1</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://212.0.211.109/live/livestream";
    titlu="rtmp://212.0.211.109/live/livestream";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://212.0.211.109/live/livestream</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2C%2Crtmp%3A%2F%2F212.0.211.109%2Flive%2Flivestream</link1>
    <title1>Moldova+1</title1>
    </item>

    <item>
    <title>BALTI TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://194.165.39.17/live/btv.stream";
    titlu="rtmp://194.165.39.17/live/btv.stream";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://194.165.39.17/live/btv.stream</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2C%2Crtmp%3A%2F%2F194.165.39.17%2Flive%2Fbtv.stream</link1>
    <title1>BALTI+TV</title1>
    </item>


    <item>
    <title>BUSUIOC</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://46.55.25.186/live/direct";
    titlu="rtmp://46.55.25.186/live/direct";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>rtmp://46.55.25.186/live/direct</annotation>
    <link1>http%3A%2F%2F127.0.0.1%2Fcgi-bin%2Fscripts%2Futil%2Ftranslate.cgi%3Fstream%2C%2Crtmp%3A%2F%2F46.55.25.186%2Flive%2Fdirect</link1>
    <title1>BUSUIOC</title1>
    </item>
<!--
    <item>
    <title>TVR1</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1200";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1200</annotation>
    </item>

    <item>
    <title>PRO TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1220";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1220</annotation>
    </item>

    <item>
    <title>PRO CINEMA</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1230";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1230</annotation>
    </item>

    <item>
    <title>ACASA</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1240";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1240</annotation>
    </item>

    <item>
    <title>ANTENA1</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1260";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1260</annotation>
    </item>

    <item>
    <title>KANAL D</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1290";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1290</annotation>
    </item>

    <item>
    <title>PRIMA</title>
    <onClick>
    <script>
    showIdle();
    url="http://89.45.164.123:1360";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://89.45.164.123:1360</annotation>
    </item>
<!-- end -->
<!--
    <item>
    <title>TVR INFO</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40084";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40084</annotation>
    </item>

    <item>
    <title>TVR 3</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40003";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40003</annotation>
    </item>

    <item>
    <title>TVR Cultural</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40020";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40020</annotation>
    </item>

    <item>
    <title>U-TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40026";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40026</annotation>
    </item>

    <item>
    <title>1 Music Channel</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40030";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40030</annotation>
    </item>

    <item>
    <title>TVR Cluj</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40097";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40097</annotation>
    </item>

    <item>
    <title>TVR Targu Mures</title>
    <onClick>
    <script>
    showIdle();
    url="http://93.113.204.18:40157";
    titlu=url;
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>http://93.113.204.18:40157</annotation>
    </item>
<!-- end -->
	<item>
	<title>Oltenia TV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,http://77.36.61.158:7081",10);</onClick>
	</item>
	
	<item>
	<title>TV KIT</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,http://86.126.136.126:8061",10);</onClick>
	</item>

	<item>
	<title>VEST TV RESITA</title>
	<onClick>playItemURL("http://89.35.144.234/live.flv",10);</onClick>
	</item>

	<item>
	<title>BIT  TV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://89.32.216.2/flvplayback/ts_4_4130_4129",10);</onClick>
	</item>
	
	<item>
	<title>MDI TV Live</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-a%20live%20-y%20livestream%20-W%20http://www.mditv.ro:801/swfs/StrobeMediaPlayback.swf%20-p%20http://www.mditv.ro:801/live1.html,rtmp://89.33.78.174:1935/live",10);</onClick>
	</item>
	
	<item>
	<title>Sport.ro</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://assets.acasatv.ro/assets/flvplayer/player.swf%20-p%20http://www.sport.ro/live/show-player/id_stream/ibu1,rtmp://live.sport.ro/live1/mp4:live1.mp4",10);</onClick>
	</item>

	<item>
	<title>InfoPescar TV Live</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.infopescar.tv/pvtv.htm,rtmp://ak.neoflux.co.uk:1935/infopescar/rtmp",10);</onClick>
	</item>
     <!--
	<item>
	<title>OTV</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.infopescar.tv/pvtv.htm,rtmp://ak.neoflux.co.uk:1935/otv/rtmp",10);</onClick>
	</item>
    -->
	<item>
	<title>Digi24</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + digi_file + "," + digi_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>

	<item>
	<title>Digi24 Iasi</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + "digi24iasilive" + "," + digi_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>
	
	<item>
	<title>Digi24 Timisoara</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + "digi24timislive" + "," + digi_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>
	
	<item>
	<title>Digi24 Oradea</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + "digi24oradealive" + "," + digi_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>
	<item>
	<title>DigiSport 1 (numai in reteaua RDS)</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + digi1_file + "," + digi1_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>
	
	<item>
	<title>DigiSport 2 (numai in reteaua RDS)</title>
	<onClick>
	<script>
    movie = "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.digi24.ro/static_dev/public_theme_v3/mediaplayer/player.swf%20-p%20http://www.digi24.ro%20-y%20" + digi2_file + "," + digi2_rtmp;
    playitemurl(movie,10);
    </script>
    </onClick>
	</item>

    <item>
    <title>Event TV</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://93.114.44.21:1936/live/eventtv",10);</onClick>
    </item>

    <item>
    <title>Avocat TV</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://89.32.216.2/flvplayback/ts_8_4162_4161",10);</onClick>
    </item>

    <item>
    <title>Nova TV Brasov</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://86.123.165.135/live/myStream",10);</onClick>
    </item>
    
    <item>
    <title>TVH 2.0</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,mms://86.34.169.52:8080/",10);</onClick>
    </item>
    
    <item>
    <title>TvM</title>
    <onClick>playItemURL("http://tvm.ambra.ro",10);</onClick>
    </item>
    <!--
    <item>
    <title>Telestar</title>
    <onClick>playItemURL("http://89.121.255.114:8081/stream.flv",10);</onClick>
    </item>
     -->
    <item>
    <title>Sangeorz tv</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,,http://89.121.218.146:8080",10);</onClick>
    </item>
    <!--
	<item>
	<title>absolutTV (Arges)</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-p%20http://www.ustream.tv,rtmp://flash75.ustream.tv:1935/ustreamVideo/6504622/streams/live_1",10);</onClick>
	</item>
    -->
    <item>
    <title>Salajeanul TV</title>
    <onClick>playItemURL("http://94.52.213.67:8084/stream.flv",10);</onClick>
    </item>
    <!--
    <item>
    <title>DAReghin TV</title>
    <onClick>playItemURL("http://194.176.179.13:8081",10);</onClick>
    </item>

    <item>
    <title>Focus News</title>
    <onClick>playItemURL("http://94.177.25.132:8085/stream.flv",10);</onClick>
    </item>
    
    <item>
    <title>FocusTV ZALAU</title>
    <onClick>playItemURL("http://94.52.213.35:8084/stream.flv",10);</onClick>
    </item>
    
    <item>
    <title>Popular TV</title>
    <onClick>playItemURL("http://94.177.25.132:8084/stream.flv",10);</onClick>
    </item>
    -->
<!--
	<item>
	<title>InfoPescar PVTV Live</title>
	<onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.infopescar.tv/pvtv.htm,rtmp://ak.neoflux.co.uk:1935/pvtv/rtmp",10);</onClick>
	</item>
-->
<!--
   <item>
    <title>Showtime International</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://86.104.190.92:10",10);</onClick>
  </item>
-->
   <item>
    <title>Tele M</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://telem.telem.ro:8780/telem_live.flv",10);</onClick>
  </item>

   <item>
    <title>Prahova TV</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.prahovatv.ro/player/player.swf%20-T%206c69766568642e747620657374652063656c206d616920746172652121%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.prahovatv.ro/,rtmp://89.45.186.26:1935/live/prahovatv",10);</onClick>
  </item>
   <!--
   <item>
    <title>Publika TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://91.230.214.52/livepkgr/livestream?adbe-live-event=liveevent",10);</onClick>
  </item>
    -->
   <item>
    <title>Jurnal TV - Rep. Moldova</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://ch0.jurnaltv.md/channel0.flv",10);</onClick>
  </item>
<!--
   <item>
    <title>Light Channel</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,rtmp://streamer1.adventhost.de/salive/romanian",10);</onClick>
  </item>
-->
<!--
   <item>
    <title>MegaTV - Braila</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://89.36.72.7:8080/",10);</onClick>
  </item>
-->
   <item>
    <title>Muscel TV</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://musceltvlive.muscel.ro:8080/",10);</onClick>
  </item>
<!--
   <item>
    <title>NCN - Cluj</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://ncn.simpliq.net:8090/ncn.flv",10);</onClick>
  </item>

   <item>
    <title>ACCES TV Targu Jiu</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://82.77.72.47:8050/live.flv",10);</onClick>
  </item>
-->
   <item>
    <title>TV eMARAMURES</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://195.28.2.42:8083/stream.flv",10);</onClick>
  </item>
<!--
   <item>
    <title>RTV Online - Televiziunea pentru toti gorjenii!</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,http://www.rtvonline.ro:8080/online.flv",10);</onClick>
  </item>


    <item>
    <title>GigaTV</title>
    <onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://178.157.82.84/gigatv/gigatv",10);</onClick>
    </item>
-->
<item>
<title>Antena 1</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live%20-W%20http://ivm.inin.ro/swf/player_live4.swf%20-p%20http://www.a1.ro/tv/live.html%20-y%20a1%20-x%20122410%20-w%2099fa9798751989f276ed92c5b269b7db02fd48d614e993d2f659da1a0d537dbb,rtmp://live1.gsp.ro/live",10);</onClick>
</item>

<item>
<title>Antena 2</title>
<onClick>playItemURL("http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live%20-W%20http://ivm.inin.ro/swf/player_live4.swf%20-p%20http://www.antena2.ro/live%20-y%20a2%20-x%20122410%20-w%2099fa9798751989f276ed92c5b269b7db02fd48d614e993d2f659da1a0d537dbb,rtmp://live1.gsp.ro/live",10);</onClick>
</item>
</channel>
</rss>
