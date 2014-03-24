#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $filelink = $queryArr[0];
   $pg_tit = urldecode($queryArr[1]);
   $pg = preg_replace('/[^A-Za-z0-9_]/','_',$pg_tit);
}
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
<rss version="2.0">
<onEnter>
  setRefreshTime(1);
  first_time=1;
  ntest = 0;
  ref = 1;
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
    ntest = ntest + 1;
    if (ntest &gt; 95 &amp;&amp; ntest &lt; 100 &amp;&amp; ref == 1)
    {
      showIdle();
      info_serial = "wait...";
      ref = 0;
      postMessage("edit");
      cancelIdle();
    }
    else if (ntest &gt; 100)
    {
      topUrl = "http://127.0.0.1/cgi-bin/scripts/util/info_down.php?file=" + log_file + ",f";
      info_serial = getUrl(topUrl);
      ntest = 0;
      ref = 1;
    }
  }
  else if (info_serial == "Ready")
  {
  do_down = 0;
  setRefreshTime(-1);
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
		<itemDisplay>
		<text align="left" lines="1" fontSize="16" foregroundColor="200:200:200" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  info_serial = getItemInfo(idx, "info_serial");
					}
					getItemInfo(idx, "title");
				</script>
        </text>
		</itemDisplay>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="18" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 1 pentru Download Manager, 2 pentru download
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>print(info_serial); info_serial;</script>
		</text>
<onUserInput>
userInput = currentUserInput();
ret = "false";
if (userInput == "display" || userInput == "DISPLAY")
{
   log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".mp4.log";
   topUrl = "http://127.0.0.1/cgi-bin/scripts/util/info_down.php?file=" + log_file + ",f";
   info_serial = getUrl(topUrl);
   redrawDisplay("yes");
   setRefreshTime(100);
   ret = "false";
}
else if( userInput == "one" || userInput == "1")
{
 jumpToLink("destination");
 ret="true";
}
else if(userInput == "two" || userInput == "2")
{
showIdle();
setRefreshTime(100);
do_down=1;
file_name= "<?php echo $dir; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".srt";
log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".srt.log";
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + getItemInfo(getFocusItemIndex(),"subtitrare") + ";name=" + getItemInfo(getFocusItemIndex(),"name") + ".srt";
dummy = getUrl(topUrl);
log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".mp4.log";
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + getItemInfo(getFocusItemIndex(),"download") + ";name=" + getItemInfo(getFocusItemIndex(),"name") + ".mp4";
dummy = getUrl(topUrl);
cancelIdle();
ret="true";
}
else if (userInput == "right" || userInput == "left" || userInput == "R" || userInput == "L" || userInput == "enter" || userInput == "ENTR")
{
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
	<title><?echo $pg_tit; ?></title>
	<menu>main menu</menu>

<?php
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookie.txt");
  $html = curl_exec($ch);
  curl_close($ch);
/*
$videos = explode('flash', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1 = explode('ile=', $video);
  $t2 = explode('&', $t1[1]);
  $t3 = explode("'",$t2[0]);
  $link = urldecode($t3[0]);
  if (strpos($link,"wp-content") !==false) {
    $t2=explode("&",$t1[2]);
    $t3=explode("'",$t2[0]);
    $link = urldecode($t3[0]);
  }
*/

  $link = str_between($html,"&file=","&");
  $link = str_replace("s2.serialepe.net","s3.serialepe.net",$link);
  $srt = str_between($html,'captions.file=','&');
  //$t1=explode('"',$srt1);
  //$srt = $t1[0];
  $srt = str_replace("s2.serialepe.net","s3.serialepe.net",$srt);
  if ($link <> "") {
    $server = str_between($link,"http://","/");
    $title = $server." - ".substr(strrchr($link,"/"),1);
    $titledownload = $pg;
    $ext="flv";

    // for sdk4.... with seek
    $title="Play with seek - SDK4";
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$pg_tit.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$titledownload.'</name>
    <subtitrare>'.$srt.'</subtitrare>
   	<info_serial>'.$info.'</info_serial>
  </item>
  ';

// cu subtitrare
    $title="Play cu subtitrare";
    $f = "/usr/local/bin/home_menu";
    if (file_exists($f)) {
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($srt).'");
    url="'.$link.'";
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$pg_tit.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$titledownload.'</name>
    <subtitrare>'.$srt.'</subtitrare>
   	<info_serial>'.$info.'</info_serial>
  </item>
  ';
  } else {
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($srt).'");
    url="'.$link.'";
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$pg_tit.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$titledownload.'</name>
    <subtitrare>'.$srt.'</subtitrare>
   	<info_serial>'.$info.'</info_serial>
  </item>
  ';
  }
}
?>
</channel>
</rss>
