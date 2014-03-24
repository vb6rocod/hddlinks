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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=30>
  <script>print(img); img;</script>
		</image>
		<text align="left" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=60 offsetYPC=55 widthPC=35 heightPC=40
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
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
					  img = getItemInfo(idx, "image");
					  annotation = getItemInfo(idx, "annotation");
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
	<title>Discover Germany</title>
	<menu>main menu</menu>

<?php
include ("../../common.php");
$l="http://mediacenter.dw.de/english/podcasts/";
$l="http://mediacenter.dw.de/ajax/english/related/item/969121/";
$l = "http://mediacenter.dw.de/english/video/?programm=7856&pageNr=1";
//http://www.dw.de/program/discover-germany/s-7856-9798
$l="http://www.dw.de/program/discover-germany/s-7856-9798";
$h=file_get_contents($l);
$n=0;
$t1=explode('getPublicationDate',$h);
//$h=$t1[1];
//echo $h;
//print_r (json_decode($h));
$videos=explode('getPublicationDate',$h);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $v=str_replace("\\","",$video);
 $t1=explode('title":"',$video);
 $t2=explode('"',$t1[1]);
 $title=$t2[0];
 $title=fix_s($title);
 
 $t1=explode('original":{"src":"',$v);
 $t2=explode('"',$t1[1]);
 $img=$t2[0];
 
 $t1=explode('getDescription":"',$video);
 $t2=explode('"',$t1[1]);
 $descriere=$t2[0];
 $descriere = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$descriere);
 $descriere = fix_s($descriere);
 
 $t1=explode('file_name',$v);
 $t2=explode('value="',$t1[1]);
 $t3=explode('"',$t1[1]);
 $link=$t3[0];    //dg/dg20140228_gesamt_sd mp4:dg/dg20140228_gesamt_sd_avc.mp4
 $y="mp4:".$link."_avc.mp4";
 //rtmp://tv-od.dw.de/flash/mp4:dg/dg20130525_maerchenkoenig_sd_avc.mp4
 //mp4:dg/dg20130525_maerchenkoenig_sd_avc.mp4
 $t1=explode('getDirectAvLink":"',$v);
 $t2=explode('"',$t1[1]);
 $opt=$t2[0];
 if (strpos($opt,"http") === false) {
 $opt="Rtmp-options:-W%20http://www.dw.de/js/jwplayer/player.swf%20-y%20".$y.",rtmp://tv-od.dw.de/flash/";
 $opt="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream,".$opt;
 }
    if ($n > 0) {
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        url="'.$opt.'";
        storagePath = getStoragePath("tmp");
        storagePath_stream = storagePath + "stream.dat";
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
        <image>'.$img.'</image>
        <annotation>'.$descriere.'</annotation>
        </item>
        ';
     }
     $n++;
}
 
?>


</channel>
</rss>



