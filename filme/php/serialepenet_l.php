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
   $link = $queryArr[0];
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
  ntest = 0;
  ref = 1;
  first_time=1;
  setRefreshTime(1);
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
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    5=Setare subtitrare
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
do_down=1;
file_name= getItemInfo(getFocusItemIndex(),"title");
log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".mp4.log";
setRefreshTime(100);
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/xml_srt1.php?file=" + getItemInfo(getFocusItemIndex(),"subtitrare") + "," + getItemInfo(getFocusItemIndex(),"name");
info_serial = getUrl(topUrl);
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
else if (userInput == "five" || userInput == "5")
   {
    jumpToLink("sub");
    "true";
}
ret;
</onUserInput>
</mediaDisplay>
<destination>
	<link>http://127.0.0.1/cgi-bin/scripts/util/level.php
	</link>
</destination>
<?php
  $f = "/usr/local/bin/home_menu";
if (!file_exists($f)) {
echo '
<sub>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub.rss</link>
<mediaDisplay name="onePartView"/>
</sub>
';
} else {
echo '
<sub>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub1.rss</link>
<mediaDisplay name="onePartView"/>
</sub>
';
}
?>
<channel>
	<title><?echo $pg_tit; ?></title>
	<menu>main menu</menu>

<?php
//error_reporting(0);
include ("../../common.php");
$pass = trim(file_get_contents("/usr/local/etc/dvdplayer/serialepe1.txt"));
//cod=asbghtyi&activare=Activeaza
$post = "cod=".$pass."&activare=Activeaza";
$cookie = "/tmp/serialepenet.txt";
if (!file_exists($cookie)) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $link);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
$html = curl_exec($ch);
curl_close($ch);
$t1=explode("Urmareste online serialul",$html);
$t2=explode("<",$t1[1]);
$info=trim($t2[0]);
} else {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $link);
//curl_setopt($ch, CURLOPT_REFERER, "http://serialepenet.ro/andromeda/sezon_1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
$html = curl_exec($ch);
curl_close($ch);
$t1=explode("Urmareste online serialul",$html);
$t2=explode("<",$t1[1]);
$info=trim($t2[0]);
}
/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_REFERER, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
$html = curl_exec($ch);
curl_close($ch);
$t1=explode("Urmareste online serialul",$html);
$t2=explode("<",$t1[1]);
$info=trim($t2[0]);
*/
//echo $html;
/*
$html=urldecode(str_between($html,"document.write(unescape('","+unescape"));
$t1=explode('src="',$html);
$t2=explode("'",$t1[1]);
$part1=$t2[0];
$part2=$t2[2];
$l=$part1.$part2;
*/
//http://s5.serialepenet.ro:81/video/368419523d9dcada5b2efc3156a910ac/51b3fd22/2/58556.mp4?start=0
$t1=explode('iframe src="',$html);
$t2=explode('"',$t1[1]);
$l=trim($t2[0]);

/*
$t1=explode("?id=",$l);
$t2=explode("&",$t1[1]);
$t3=explode("&s=",$l);
$t4=explode("&",$t3[1]);
$link="http://".$t4[0].".serialepenet.ro:81/storage/".$t2[0].".mp4";
$l=str_replace("&amp;","&",$l);
*/
//http://serialepenet.ro/476-embed-236/?id=23300&t=5327046b&s=s1&m=54355972676def9882fa19f96950a782&w=739&h=411
//http://serialepenet.ro/476-embed-236/?id=23300&t=53270936&s=s1&m=46386907e3b86bd2634e4f7bb30b6ddd&amp;w=739&amp;h=411
if ($l <> "") {
//$l=str_replace("&amp;","&",$l);
//echo $l."<BR>".urlencode($l)."<BR>";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
//curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8","Accept-Language: ro-ro,ro;q=0.8,en-us;q=0.6,en-gb;q=0.4,en;q=0.2","Accept-Encoding: gzip, deflate"));
curl_setopt($ch, CURLOPT_REFERER, $link);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
$html = curl_exec($ch);
curl_close($ch);
if (strpos($html,"href") === false) {
    $new_file="D://dolce.gz";
    $new_file="/tmp/dolce.gz";
    exec ("rm -f /tmp/dolce");
    $fh = fopen($new_file, 'w');
    fwrite($fh, $html);
    fclose($fh);
    exec("/usr/local/etc/www/cgi-bin/scripts/funzip /tmp/dolce.gz > /tmp/dolce");
    sleep(1);
    $html=file_get_contents("/tmp/dolce");
}
//echo $html;
$t1=explode("file=",$html);
$t2=explode("&",$t1[1]);
$link=$t2[0]."?start=0";

//http://s2.serialepenet.ro:81/storage/1994.mp4
//http://serialepenet.ro/476-embed-236/?id=4288&t=51a1a0b4&s=s3&m=65bc70d7016bd40303e10f52c3eab6b2&amp;w=739&amp;h=411
$t1=explode("file=",$html);
$t2=explode("&",$t1[2]);
$srt=$t2[0];
} else {
$link="";
}
if ($link <> "") {
$server = str_between($link,"http://","/");
$title = $server." - ".substr(strrchr($link,"/"),1);
$titledownload = $pg;
$ext="mp4";
    $title="Play cu subtitrare";
    $f = "/usr/local/bin/home_menu";
    if (file_exists($f)) {
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/xml_xml.php?file='.urlencode($srt).'");
    url="http://127.0.0.1/cgi-bin/scripts/util/mail.cgi?'.$link.'";
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
    <download>http://127.0.0.1/cgi-bin/scripts/util/mail.cgi?'.$link.'</download>
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
    dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/xml_xml.php?file='.urlencode($srt).'");
    url="http://127.0.0.1/cgi-bin/scripts/util/mail.cgi?'.$link.'";
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
    <download>http://127.0.0.1/cgi-bin/scripts/util/mail.cgi?'.$link.'</download>
    <name>'.$titledownload.'</name>
    <subtitrare>'.$srt.'</subtitrare>
   	<info_serial>'.$info.'</info_serial>
  </item>
  ';
  }
/*
$pct = substr($srt, -4, 1);
if (($srt <> "") && ($pct == ".") && (strpos($srt,".xml") !==false)) {
   echo '
  	<item>
  	<title>Subtitrare</title>
  	<download>'.$srt.'</download>
     <name>'.$titledownload.'.xml</name>
  	 <info_serial>Descarcă subtitrarea (cu tasta 2) şi aşteaptă până apare "Ready"</info_serial>
  	 </item>
   	';
}
*/
}
// utils
   echo '
   <item>
   <title>Setare parolă - abonament</title>
   <onClick>
   <script>
     res=getUrl("http://127.0.0.1/cgi-bin/scripts/filme/php/serialepenet_del.php");
	 keyword = getInput();
	 if (keyword != null)
	 {
        storagePath = "/usr/local/etc/dvdplayer/serialepe1.txt";
        arr = null;
        arr = pushBackStringArray(arr, keyword);
        writeStringToFile(storagePath, arr);
	 }
   </script>
   </onClick>
   <info_serial>Necesită abonament pe serialepenet.ro!</info_serial>
   </item>
   ';
/*
   echo '
   <item>
   <title>Conversie subtitrare (xml-srt) - după download subtitrare</title>
   <onClick>
   <script>
        showIdle();
		topUrl = "http://127.0.0.1/cgi-bin/scripts/util/xml_srt.php";
		dummy = getUrl(topUrl);
		cancelIdle();
   </script>
   </onClick>
   <info_serial>Conversie la toate subtitrările din format xml în format srt</info_serial>
   </item>
   ';
    $link = "http://127.0.0.1/cgi-bin/scripts/util/util1.cgi";
  	echo '
    <item>
  	<title>Stop download (numai pentru metoda săgeată dreapta-download)</title>
  	<link>'.$link.'</link>
  	<enclosure type="text/txt" url="'.$link.'"/>
  	<info_serial>Stop download (numai pentru metoda săgeată dreapta-download)</info_serial>
  	</item>
      ';
*/
?>
</channel>
</rss>
