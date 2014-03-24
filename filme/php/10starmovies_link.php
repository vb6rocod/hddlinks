#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
$queryarr = explode(",",$query);
$episodeLink = $queryarr[0];
$serieTitle = urldecode($queryarr[1]);
$pg = preg_replace('/[^A-Za-z0-9_]/','_',$serieTitle);
//play movie
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/";
   $dir_log = "/tmp/usbmounts/sda1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/";
   $dir_log = "/tmp/usbmounts/sdb1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/";
   $dir_log = "/tmp/usbmounts/sdc1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/";
   $dir_log = "/tmp/usbmounts/sda2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/";
   $dir_log = "/tmp/usbmounts/sdb2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc2/download/";
   $dir = "/tmp/usbmounts/sdc2/download/log/";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/";
   $dir_log = "/tmp/hdd/root/log/";
} else {
     $dir = "";
     $dir_log = "";
}
// end
?>
<?php echo "<?xml version='1.0' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
    storagePath             = getStoragePath("tmp");
    storagePath_stream      = storagePath + "stream.dat";
    storagePath_playlist    = storagePath + "playlist.dat";
  setRefreshTime(1);
  first_time=1;
</onEnter>
 <onExit>
 setRefreshTime(-1);
 </onExit>
<onRefresh>
  if(first_time == 1)
  {
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
  first_time=0;
  }
  else if (do_down == 1)
  {
    topUrl = "http://127.0.0.1/cgi-bin/scripts/util/info_down.php?file=" + log_file + ",f";
    info_serial = getUrl(topUrl);
  }
</onRefresh>
<mediaDisplay name="threePartsView"
	itemBackgroundColor="0:0:0"
	backgroundColor="0:0:0"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	sideColorRight="0:0:0"
	itemImageXPC="5"
	itemXPC="20"
	itemYPC="20"
	itemWidthPC="70"
	capWidthPC="70"
	unFocusFontColor="101:101:101"
	focusFontColor="255:255:255"
	showHeader="no"
	showDefaultInfo="yes"
	bottomYPC="90"
	infoYPC="100"
	infoXPC="0"
	popupXPC = "40"
  popupYPC = "55"
  popupWidthPC = "22.3"
  popupHeightPC = "5.5"
  popupFontSize = "13"
	popupBorderColor="28:35:51"
	popupForegroundColor="255:255:255"
 	popupBackgroundColor="28:35:51"
  idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", getFocusItemIndex()-(-1))+itemCount;</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="75" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apasati 1 pentru download manager, 2 pentru download
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>print(info_serial); info_serial;</script>
		</text>
<onUserInput>
userInput = currentUserInput();
ret = "false";
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
  ret = "true";
}
else if(userInput == "two" || userInput == "2")
{
tip=getItemInfo(getFocusItemIndex(),"tip");
showIdle();
if (tip == "1")
{
url =  getItemInfo(getFocusItemIndex(),"download");
movie=getUrl(url);
info_serial="link:" + movie;
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + movie + ";name=" + getItemInfo(getFocusItemIndex(),"name");
}
else if (tip == "2")
{
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + getItemInfo(getFocusItemIndex(),"download") + ";name=" + getItemInfo(getFocusItemIndex(),"name");
}
dummy = getUrl(topUrl);
cancelIdle();
do_down=1;
file_name= getItemInfo(getFocusItemIndex(),"title");
log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".log";
setRefreshTime(10000);
ret="true";
}
else if (userInput == "three" || userInput == "3")
{
 url="<?php echo $dir; ?>" + getItemInfo(getFocusItemIndex(),"name");
 playItemurl(url,10);
 ret="true";
}
else if(userInput == "four" || userInput == "4")
{
showIdle();
url =  getItemInfo(getFocusItemIndex(),"download");
info_serial="link:" + url;
redrawdisplay();
tip=getItemInfo(getFocusItemIndex(),"tip");
if (tip == "1")
{
movie=getUrl(url);
info_serial="movie:" + movie;
}
cancelIdle();
redrawdisplay();
ret="true";
}
else if (userInput == "one" || userInput == "1")
{
jumpToLink("destination");
ret="true";
}
else
{
info_serial=" ";
setRefreshTime(-1);
do_down=0;
ret="false";
}
ret;
</onUserInput>
</mediaDisplay>
<destination>
	<link>http://127.0.0.1/cgi-bin/scripts/util/level.php
	</link>
</destination>
<channel>
<?php
echo "<title>".$serieTitle."</title>"
;
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$host = "http://127.0.0.1/cgi-bin";
$content = file_get_contents($episodeLink);
$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
$input = str_replace($newlines, "", $content);
//http://www.watch-24-online-free.com/play_source.php?id=200703026
$videos = explode("javascript:load_source_new(",$input);
preg_match("/<h5>Available Sources<\/h5>(.*)<\/div>/U", $input, $div);
$videos = explode("javascript:load_source_new(",$div[1]);
unset($videos[0]);
$videos = array_values($videos);
$i=1;
foreach($videos as $video) {
  $t1=explode(",",$video);
  $id=$t1[0];
  $l =  substr($episodeLink,0,strrpos($episodeLink,"/"))."/play_source.php?id=".$id;
  $t1=explode('alt="play"',$video);
  $t2=explode('>',$t1[1]);
  $t3=explode('<',$t2[1]);
  $source=$t3[0];
  $s="/vidxden|divxden|vidbux|movreel|videoweed|novamov|vk";
  $s=$s."|movshare|videobb|youtube|flvz|rapidmov|putlocker|";
  $s=$s."videozer|sockshare|vimeo|vkontakte|megavideo/i";
  if (preg_match($s,$source)) {
    $link="http://127.0.0.1/cgi-bin/scripts/filme/php/10starmovies_link1.php?file=".urlencode($l);
        $title=$source." [".$i."]";
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link.'";
        url=getUrl(movie);
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$serieTitle.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$pg.'.flv</name>
        </item>
        ';
        $i++;
  }
}
?>
</channel>
</rss>

