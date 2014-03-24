#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
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
	itemWidthPC="20"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="20"
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="70" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=modifica aspect, dreapta pentru program...
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="left" redraw="yes"
          lines="20" fontSize=15
		      offsetXPC=30 offsetYPC=25 widthPC=70 heightPC=75
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
					  adn = getItemInfo(idx, "adn");
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
  "true";
}
else if(userInput == "right" || userInput == "R")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/dolce_prog.php?file=" + getItemInfo(idx,"id");
annotation = getURL(url_canal);
cancelIdle();
redrawDisplay();
ret = "true";
}
else
{
annotation = " ";
ret = "false";
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
  <title>TV Romania</title>
<?php
/*
$l1="tv_rom3.rss";
$h1=file_get_contents($l1);
$videos = explode('<item', $h1);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $title=str_between($video,"<title>","</title>");
  $id=str_between($video,'<id>','</id>');
  $a[$title]=$id;
}
*/
$a["Antena 1"]="10017";
$a["B1"]="10022";
$a["CNN"]="10115";
$a["Discovery Channel"]="10020";
$a["Diva TV"]="10027";
$a["Kanal D"]="10097";
$a["Minimax"]="10023";
$a["N 24 +"]="10048";
$a["National TV"]="10031";
$a["Prima TV"]="10005";
$a["Sport 1 / Megamax"]="";
$a["Top Shop"]="10202";
$a["TVH2.0"]="10029";
$a["TVR 1"]="10001";
$a["TVR 2"]="10002";
$l="http://portaltv.ro/iptvro.php";
$s="http://127.0.0.1/cgi-bin/translate?stream,,";
$html=file_get_contents($l);
$videos = explode('<li', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
 $t1=explode('idq=',$video);
 $t2=explode("'",$t1[1]);
 $link=$t2[0];
 //echo $link;
 $t3=explode(">",$t1[1]);
 $t4=explode("<",$t3[1]);
 $title=$t4[0];
 if (strpos($title,"RO") !== false) {
 $t1=explode("RO",$title);
 $title=trim($t1[1]);
 }
 if (strpos($link,"portaltv") !== false) $title="";
 if (strpos($link,"rtsp") === false && strpos($link,"m3u8") === false && $title)
 {
 $id=$a[$title];
 if (strpos($link,"mms") !== false)
   $link=$s.$link;
  echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     movie="'.$link.'";
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id>'.$a[$title].'</id>
     <adn>'.$link1.'</adn>
     </item>
     ';
 }
}
?>
</channel>
</rss>
