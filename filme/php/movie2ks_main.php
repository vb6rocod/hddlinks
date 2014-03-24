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
	itemWidthPC="30"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="30"
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
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=30>
		image/movies.png
		</image>
		<!--
		<text align="left" redraw="yes"
          lines="7" fontSize=17
		      offsetXPC=35 offsetYPC=55 widthPC=60 heightPC=35
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
        Servers:vidxden.c, divxden.c, vidbux.c, movreel.c, videoweed.(c, e), novamov.(c, e), vk.com, movshare.net, videobb.c, youtube.c, flvz.com, rapidmov.net, putlocker.com, videozer.com, vimeo.com, googleplayer.swf, vkontakte.ru, megavideo.com, videobam.com, divxstage.net, divxstage.eu, stream2k.com, sockshare.com, xvidstage.com, nolimitvideo.com, stage666.net, rapidload.org, vidstream.us, 2gb-hosting.com, dimshare.com, movdivx.com, sharevideo22.com, dr9000.com, altervideo.net, royalvids.eu
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
	<title>www.movie2k.to - series</title>
	<menu>main menu</menu>

<item>
<title>Latest updates</title>
<link>http://127.0.0.1/cgi-bin/scripts/filme/php/movie2ks_cat1.php?query=http://www.movie2k.to/tvshows-updates.html,Latest+updates</link>
<annotation>Latest updates</annotation>
<mediaDisplay name="threePartsView"/>
</item>


<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
echo '
<item>
<title>Favorite list</title>
<link>'.$host.'/scripts/filme/php/movie2ks_fav.php</link>
<annotation>Favorite list</annotation>
<mediaDisplay name="threePartsView"/>
</item>
';
   $title="0-9";
   $link="http://www.movie2k.to/tvshows-all-1.html";
   $link = $host."/scripts/filme/php/movie2ks_sez.php?query=".$link.",".urlencode($title);
  	echo '
    	<item>
    		<title>'.$title.'</title>
    		<link>'.$link.'</link>
				<annotation>'.$title.'</annotation>
				<mediaDisplay name="threePartsView"/>
    	</item>
    	';
for ($i=65;$i<91;$i++) {
   $title=chr($i);
   $link="http://www.movie2k.to/tvshows-all-".chr($i).".html";
   $link = $host."/scripts/filme/php/movie2ks_sez.php?query=".$link.",".urlencode($title);
  	echo '
    	<item>
    		<title>'.$title.'</title>
    		<link>'.$link.'</link>
				<annotation>'.$title.'</annotation>
				<mediaDisplay name="threePartsView"/>
    	</item>
    	';
}
?>

</channel>
</rss>
