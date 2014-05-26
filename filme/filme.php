#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF-8' ?>";
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
		image/movies.png
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
			<text align="left" lines="1" cornerRounding=5 offsetXPC=0 offsetYPC=2 widthPC=100 heightPC=96>
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
<adultlink>
<mediaDisplay name="threePartsView"/>
<link>
  <?php echo $host; ?>/scripts/filme/php/online-moviez1.php
</link>
</adultlink>
<adultpass>
<mediaDisplay name="onePartView" />
<link>
/usr/local/etc/www/cgi-bin/scripts/adult/adult.rss
</link>
</adultpass>
<channel>
	<title>Filme Online</title>

<!--
<item>
<title>test</title>
<link>/tmp/hdd/volumes/HDD1/test.rss</link>
<annotation></annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>test</title>
<link><?php echo $host; ?>/scripts/dir.php</link>
<annotation></annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>filmeonline</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonline_main.php</link>
<annotation>http://www.filmeonline.org</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>iPlay - filme HD (abonament)</title>
<link><?php echo $host; ?>/scripts/filme/php/iplay_filme.php</link>
<annotation>http://www.iplay.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>spicetv - filme HD</title>
<link><?php echo $host; ?>/scripts/filme/php/spice_movie.php</link>
<annotation>http://www.ustv.ro/</annotation>
<media:thumbnail url="image/movies.png" />
</item>

<item>
<title>Noobroom</title>
<link><?php echo $host; ?>/scripts/filme/php/noobroom_main.php</link>
<annotation>http://noobroom.com</annotation>
<media:thumbnail url="image/movies.png" />
</item>

<item>
<title>vplus</title>
<link><?php echo $host; ?>/scripts/filme/php/vplay_main_filme.php</link>
<annotation>http://vplus.ro/movies/</annotation>
<media:thumbnail url="image/movies.png" />
</item>
<!--
<item>
<title>inviatapenet</title>
<link><?php echo $host; ?>/scripts/filme/php/inviatapenet_main.php</link>
<annotation>http://inviatapenet.gethost.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>voxfilmeonline</title>
<link><?php echo $host; ?>/scripts/filme/php/voxfilmeonline_main.php</link>
<annotation>http://voxfilmeonline.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>totul-hd</title>
<link><?php echo $host; ?>/scripts/filme/php/totul-hd_main.php</link>
<annotation>http://www.totul-hd.info/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>divxonline</title>
<link><?php echo $host; ?>/scripts/filme/php/divxonline_main.php</link>
<annotation>http://divxonline.biz</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>filmehd</title>
<link><?php echo $host; ?>/scripts/filme/php/filmehd_main.php</link>
<annotation>http://filmehd.net/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>hdfilm</title>
<link><?php echo $host; ?>/scripts/filme/php/hdfilm.php?query=1,http://www.hdfilm.ro/index.php?p=filme</link>
<annotation>http://hdfilm.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>filmhd</title>
<link><?php echo $host; ?>/scripts/filme/php/filmhd_main.php</link>
<annotation>http://www.filmhd.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>filmehd-online</title>
<link><?php echo $host; ?>/scripts/filme/php/filmehd-online_main.php</link>
<annotation>http://www.filmehd-online.net/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>onlinehd</title>
<link><?php echo $host; ?>/scripts/filme/php/onlinehd_main.php</link>
<annotation>http://www.onlinehd.info</annotation>
<mediaDisplay name="threePartsView"/>
</item>


<item>
<title>seriale.filmesubtitrate</title>
<link><?php echo $host; ?>/scripts/filme/php/filmesubtitrate.php?query=,http://www.fsplay.net/filme-online-subtitrate</link>
<annotation>http://www.seriale.filmesubtitrate.info/filme-online-subtitrate</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>990</title>
<link><?php echo $host; ?>/scripts/filme/php/990_filme_main.php</link>
<annotation>http://www.990.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>radioarad</title>
<link><?php echo $host; ?>/scripts/filme/php/radioarad_main.php</link>
<annotation>http://www.radioarad.net/filme</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>filmeonline.cc</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonlinecc_main.php</link>
<annotation>http://www.filmeonline.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>vezi-online</title>
<link><?php echo $host; ?>/scripts/filme/php/vezi-online_filme.php?query=1,http://vezi-online.net/lista-filme/</link>
<annotation>http://vezi-online.net/filme</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>malovatz-city.ucoz</title>
<link><?php echo $host; ?>/scripts/filme/php/malovatz_main.php</link>
<annotation>http://malovatz-city.ucoz.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>filmeonline2013</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonline2013_main.php</link>
<annotation>http://www.filmeonline2013.biz/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>frapex</title>
<link><?php echo $host; ?>/scripts/filme/php/frapex_main.php</link>
<annotation>http://frapex.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>eurotube</title>
<link><?php echo $host; ?>/scripts/filme/php/eurotube_main.php</link>
<annotation>http://eurotube.do.am</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>filmeonline3d</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonline3d_main.php</link>
<annotation>http://www.filmeonline3d.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>filme-bune</title>
<link><?php echo $host; ?>/scripts/filme/php/filme-bune_main.php</link>
<annotation>http://www.filme-bune.net/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>cr3ative-zone</title>
<link><?php echo $host; ?>/scripts/filme/php/cr3ative-zone_main.php</link>
<annotation>http://cr3ative-zone.ucoz.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<!--
<item>
<title>peţeavă</title>
<link><?php echo $host; ?>/scripts/filme/peteava.php</link>
<annotation>http://www.peteava.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>peţeavă - user movies</title>
<link><?php echo $host; ?>/scripts/filme/peteava_user.php</link>
<annotation>http://www.peteava.ro/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>onlythefilm</title>
<link><?php echo $host; ?>/scripts/filme/php/onlythefilm_main.php</link>
<annotation>http://www.onlythefilm.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>filmelive</title>
<link><?php echo $host; ?>/scripts/filme/php/filmelive_main.php</link>
<annotation>http://www.filmelive.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>1filme</title>
<link><?php echo $host; ?>/scripts/filme/php/1filme_main.php</link>
<annotation>http://www.1filme.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>filme-online-gratis</title>
<link><?php echo $host; ?>/scripts/filme/php/filme-online-gratis_main.php</link>
<annotation>http://filme-online-gratis.com/blog/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<!--
<item>
<title>filmeonlinegratis</title>
<link><?php echo $host; ?>/scripts/filme/php/filmeonlinegratis_main.php</link>
<annotation>http://www.filmeonlinegratis.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>xvidonline</title>
<link><?php echo $host; ?>/scripts/filme/php/xvidonline.php</link>
<annotation>http://xvidonline.org/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>moviesample</title>
<link><?php echo $host; ?>/scripts/filme/php/moviesample.php</link>
<annotation>http://www.moviesample.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<!--
<item>
<title>filmede10</title>
<link><?php echo $host; ?>/scripts/filme/php/filmede10_net_main.php</link>
<annotation>http://www.filmede10.net/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>seriale-filme - movies</title>
<link><?php echo $host; ?>/scripts/filme/php/seriale-filme_filme_info.php</link>
<annotation>http://www.seriale-filme.info/movies</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>westernmania - filme Western</title>
<link><?php echo $host; ?>/scripts/filme/php/westernmania.php</link>
<annotation>http://www.westernmania.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<!--
<item>
<title>DolceTv - filme gratis</title>
<link><?php echo $host; ?>/scripts/filme/php/dolce_filme.php?page=1</link>
<annotation>http://www.dolcetv.ro/filme</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>jurnaltv - filme şi seriale documentare</title>
<link><?php echo $host; ?>/scripts/filme/php/jurnaltv_main.php</link>
<annotation>http://www.jurnaltv.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>documentare - filme şi seriale documentare</title>
<link><?php echo $host; ?>/scripts/filme/php/documentare_main.php</link>
<annotation>http://documentare.org</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->

<item>
<title>documentare.digitalarena - filme şi seriale documentare</title>
<link><?php echo $host; ?>/scripts/filme/php/digitalarena_main.php</link>
<annotation>http://documentare.digitalarena.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<!--
<item>
<title>filmedocumentare - filme şi seriale documentare</title>
<link><?php echo $host; ?>/scripts/filme/php/filmedocumentare_main.php</link>
<annotation>http://filmedocumentare.com/</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>filmekmagyarul</title>
<link><?php echo $host; ?>/scripts/filme/php/filmekmagyarul_main.php</link>
<annotation>http://www.filmekmagyarul.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>moovie.cc (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/moovie.php?query=1,</link>
<annotation>http://www.moovie.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>megaweb.ucoz.com (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/megaweb.php?query=1,</link>
<annotation>http://megaweb.ucoz.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>onlinefilmletoltes.eu (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/onlinefilmletoltes_main.php</link>
<annotation>http://onlinefilmletoltes.eu</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>online-filmek (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/online-filmek.php?query=1,http://online-filmek.cc/filmek/osszes/legfrissebb/,filmek</link>
<annotation>http://online-filmek.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>moovie.cc (in lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/moovie_cc.php?query=1,</link>
<annotation>http://www.moovie.cc</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<!--
<item>
<title>movie2k - movies</title>
<link><?php echo $host; ?>/scripts/filme/php/movie2k_main.php</link>
<annotation>http://www.movie2k.to</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->


</channel>
</rss>
