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
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apasati tasta "info" pentru ajutor.
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
        /usr/local/etc/www/cgi-bin/scripts/filme/image/series.png
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
else if (userInput == "display" || userInput == "DISPLAY")
{
showIdle();
cancelIdle();
ret_val=doModalRss("/usr/local/etc/www/cgi-bin/scripts/filme/php/help.rss");
ret="true";
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
	<title>Seriale TV</title>
<?php
  $f = "/usr/local/bin/home_menu";
if (!file_exists($f)) {
echo '
<item>
<title>Setări subtitrări online</title>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub.rss</link>
<annotation>Setări culoare, fundal, mărime pentru subtitrare</annotation>
<mediaDisplay name="onePartView"/>
</item>
';
} else {
echo '
<item>
<title>Setări subtitrări online</title>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub1.rss</link>
<annotation>Setări culoare, fundal, mărime pentru subtitrare</annotation>
<mediaDisplay name="onePartView"/>
</item>
';
}
?>
<!--
<item>
<title>serialepe.net</title>
<link><?php echo $host; ?>/scripts/filme/php/serialepe_main.php</link>
<annotation>http://www.serialepe.net/p/seriale-online-gratis-subtitrate.html</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>filmesubtitrate.info</title>
<link><?php echo $host; ?>/scripts/filme/php/filmesubtitrate_info_main.php</link>
<annotation>http://www.seriale.filmesubtitrate.info/p/seriale-online-subtitrate-in-romana.html</annotation>
<mediaDisplay name="photoView"/>
</item>

<item>
<title>serialepenet (cu abonament)</title>
<link><?php echo $host; ?>/scripts/filme/php/serialepenet_main.php</link>
<annotation>http://serialepenet.ro/</annotation>
<mediaDisplay name="photoView"/>
</item>
<!--
<item>
<title>turboplay (abonament)</title>
<link><?php echo $host; ?>/scripts/filme/php/turboplay_main.php</link>
<annotation>http://turboplay.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>vplus</title>
<link><?php echo $host; ?>/scripts/filme/php/vplay_main_main.php</link>
<annotation>http://vplus.ro/shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>iPlay - seriale HD (abonament)</title>
<link><?php echo $host; ?>/scripts/filme/php/iplay_seriale.php</link>
<annotation>http://iplay.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>spicetv - seriale</title>
<link><?php echo $host; ?>/scripts/filme/php/spice_series_main.php</link>
<annotation>http://www.ustv.ro/</annotation>
<media:thumbnail url="image/movies.png" />
</item>

<item>
<title>noobroom - seriale</title>
<link><?php echo $host; ?>/scripts/filme/php/noobroom_series_main.php?query=a</link>
<annotation>http://noobroom.com</annotation>
<media:thumbnail url="image/movies.png" />
</item>
<!--
<item>
<title>inviatapenet</title>
<link><?php echo $host; ?>/scripts/filme/php/inviatapenet_series.php</link>
<annotation>http://inviatapenet.gethost.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>yideo.ro</title>
<link><?php echo $host; ?>/scripts/filme/php/yideo_main.php</link>
<media:thumbnail url="image/movies.png" />
</item>
-->
<item>
<title>990</title>
<link><?php echo $host; ?>/scripts/filme/php/990_seriale_main1.php</link>
<media:thumbnail url="image/movies.png" />
</item>

<item>
<title>filmeonline - seriale</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonlines_main.php</link>
<annotation>http://www.filmeonline.org/seriale-online-subtitrate-in-romana/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>veziserialeonline</title>
<link><?php echo $host; ?>/scripts/filme/php/veziserialeonline_main.php</link>
<annotation>http://www.veziserialeonline.info/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>serialetv</title>
<link><?php echo $host; ?>/scripts/filme/php/serialetv_main.php</link>
<annotation>http://serialetv.net/seriale-online-subtitrate-in-romana</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>hdfilm</title>
<link><?php echo $host; ?>/scripts/filme/php/hdfilm_series_main.php</link>
<annotation>http://hdfilm.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>moviem</title>
<link><?php echo $host; ?>/scripts/filme/php/moviem_main.php?query=1,http://www.moviem.us/seriale-online/page/,moviem</link>
<annotation>http://moviem.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<!--
<item>
<title>seriale.subtitrate</title>
<link><?php echo $host; ?>/scripts/filme/php/seriale_subtitrate_info_l.php</link>
<annotation>http://seriale.subtitrate.info/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>cinemaro</title>
<link><?php echo $host; ?>/scripts/filme/php/cinemaro_main.php</link>
<annotation>http://www.cinemaro.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>seriale-filme</title>
<link><?php echo $host; ?>/scripts/filme/php/seriale-filme_info_main.php</link>
<annotation>http://www.seriale-filme.info/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<!--
<item>
<title>wserialetvonline</title>
<link><?php echo $host; ?>/scripts/filme/php/serialetvonline_main.php</link>
<annotation>http://www.serialetvonline.info/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>


<item>
<title>serialeonline</title>
<link><?php echo $host; ?>/scripts/filme/php/serialeonlinero_main.php</link>
<annotation>http://serialeonline.ro/index.php/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>

-->
<!--
<item>
<title>vezi-online</title>
<link><?php echo $host; ?>/scripts/filme/php/vezi-online_main.php?query=1</link>
<annotation>vezi-online.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>ufilme</title>
<link><?php echo $host; ?>/scripts/filme/php/ufilme_main.php</link>
<annotation>http://www.ufilme.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>filmeonlinerx</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonlinerx_main.php?query=1,</link>
<annotation>www.filmeonlinerx.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>seriale coreene</title>
<link><?php echo $host; ?>/scripts/filme/php/serialecoreene_main.php</link>
<annotation>http://www.serialecoreene.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<item>
<title>asiafaninfo - Drame coreene</title>
<link><?php echo $host; ?>/scripts/filme/php/asiafaninfo_main.php</link>
<annotation>http://asiafaninfo.net/drame-seriale-coreene/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>online-filmek.org (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/online-filmek_org_main.php</link>
<annotation>http://www.online-filmek.org/sorozatok-abc-sorrendben/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>online-filmek (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/online-filmek_s.php?query=1,http://online-filmek.cc/sorozatok/legfrissebb/,sorozatok</link>
<annotation>http://online-filmek.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>sorozatok.tv (lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/sorozatok_main.php</link>
<annotation>http://online-sorozatok.tv/sorozatok.php</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>moovie.cc (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/moovie_cc_s.php?query=1,</link>
<annotation>http://www.moovie.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>awesomedl</title>
<link><?php echo $host; ?>/scripts/filme/php/awesomedl_main.php</link>
<annotation>http://www.awesomedl.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>tinymkv</title>
<link><?php echo $host; ?>/scripts/filme/php/tinymkv_main.php</link>
<annotation>http://www.tinymkv.com/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
</channel>
</rss>
