#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $tit = urldecode($queryArr[1]);
}
?>
<rss version="2.0">
<onEnter>
    storagePath             = getStoragePath("tmp");
    storagePath_stream      = storagePath + "stream.dat";
    storagePath_playlist    = storagePath + "playlist.dat";
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
	itemWidthPC="80"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="80"
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
					  img = getItemInfo(idx,"image");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
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
  "true";
}
redrawDisplay();
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
	<title><?php echo $tit; ?></title>
	<menu>main menu</menu>


<?php

function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$html=file_get_contents($link);
$html=str_between($html,"</span></li></ul>","</center>");
$image="/usr/local/etc/www/cgi-bin/scripts/tv/image/tvgool.png";
$videos = explode('<p>', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0 = explode('iframe', $video);
  $t1=explode('src="',$t0[1]);
  $t2 = explode('"', $t1[1]);
  $link = $t2[0];

  $t3 = explode("<",$video);
  $title = trim($t3[0]);
  $title = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$title);
  if (!$title) $title="Rezumat";
  $t0 = explode('embed', $video);
  $t1=explode('src="',$t0[1]);
  $t2 = explode('"', $t1[1]);
  $link1 = $t2[0];
  if (strpos($link1,"videa.hu") !== false)
     $link=$link1;
  $link2="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($link);
  if ($link <> "") {
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link2.'";
        url=getUrl(movie);
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$title.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        </item>
        ';
  }
  $link="";
  $t0 = explode('embed', $video);
  $t1=explode('src="',$t0[1]);
  $t2 = explode('"', $t1[1]);
  $link = $t2[0];
  if (strpos($video,"sport1.cdp") !== false) {
    $link=str_between($video,"file=",'"');
  }
  if ($link <> "") {
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        url="'.$link.'";
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$title.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        </item>
        ';
  }
    $t1=explode("file=content",$video);
    $t2=explode("&",$t1[1]);
    $y=$t2[0];
    $t1=explode("streamer=",$video);
    $t2=explode("&",$t1[1]);
    $r=$t2[0];
    if ($y) {
        $y="mp4:content".$y;
        $link2="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-y%20".$y."%20-a%20vod/_definst_mp4%20-W%20http://www.galwayhockeyclub.com/plugins/hwdvs-videoplayer/jwflv_v5/mediaplayer.swf%20-p%20http://www.tvgool.ro,".$r;
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        url="'.$link2.'";
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$title.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        </item>
        ';
    }
}
?>


</channel>
</rss>
