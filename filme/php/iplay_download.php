#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<onEnter>
  first="0";
  n=0;
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "iplay_b.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    buf = "60000";
    subtitle = "on";
  }
  else
  {
    buf = getStringArrayAt(optionsArray, 0);
    subtitle = getStringArrayAt(optionsArray, 1);
  }
  if (subtitle == " " || subtitle == "" || subtitle == null)
    subtitle = "on";
  startitem = "middle";
  info="";
  setRefreshTime(1);
</onEnter>

<onExit>
  arr = null;
  arr = pushBackStringArray(arr, buf);
  arr = pushBackStringArray(arr, subtitle);
  print("arr=",arr);

  writeStringToFile(optionsPath, arr);
 setRefreshTime(-1);
</onExit>
<onRefresh>
if (first == "0")
{
  setRefreshTime(-1);
  first="1";
  itemCount = getPageInfo("itemCount");
  ref=0;
}
else if (download=="1")
{
showIdle();
info1=getUrl("http://127.0.0.1/cgi-bin/scripts/util/info_rtmp.php");
cancelIdle();
if (info1 == "downloading...")
{
info=info1 + " " + n*10 + " sec.";
n=n+1;
}
else
{
   info=info1;
   download="2";
}
}
else if (download=="2")
{
 info="finish job...";
 setRefreshTime(-1);
}
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
		
  	<text align="center" redraw="yes" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" redraw="yes" offsetXPC="6" offsetYPC="15" widthPC="75" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>print(info); info;</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=50>
         <script>print(image); image;</script>
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi: 1= modificare buffer. Buffer: " + buf + "  8= Subtitrare on/off. Subtitrare: " + subtitle;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="80" widthPC="30" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(an); an;</script>
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
					  image = getItemInfo(idx, "image");
					  an =  getItemInfo(idx, "an");
					  name=getItemInfo(idx,"name");
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
else if(userInput == "nine" || userInput == "9")
{
    idx = Integer(getFocusItemIndex());
    idx -= -100;
    if(idx &gt;= itemCount)
    idx = itemCount-1;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "seven" || userInput == "7")
{
    idx = Integer(getFocusItemIndex());
    idx -= 100;
    if(idx &lt; 0)
      idx = 0;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if (userInput == "two" || userInput == "2")
{
n=0;
ShowIdle();
info="Start downloading...";
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/iplay_srt.php?file=" + getItemInfo(getFocusItemIndex(),"id") + "," + getItemInfo(getFocusItemIndex(),"download") + "," + getItemInfo(getFocusItemIndex(),"name");
dummy = getUrl(topUrl);
cancelIdle();
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download1.cgi?link=" + getItemInfo(getFocusItemIndex(),"download") + ";name=" + getItemInfo(getFocusItemIndex(),"name");
dummy = getUrl(topUrl);
download="1";
setRefreshTime(10000);
ret="true";
}
else if (userInput == "three" || userInput == "3")
{
 n=0;
 topUrl="http://127.0.0.1/cgi-bin/scripts/util/info_rtmp.cgi";
 dummy=getUrl(topUrl);
 info= "Stop download";
 setRefreshTime(-1);
ret = "true";
}
else if (userInput == "one" || userInput == "1")
{
		if (buf == "60000")
           buf = "40000";
		else if (buf == "40000")
           buf = "20000";
        else if (buf == "20000")
          buf = "10000";
        else if (buf == "10000")
          buf = "8000";
        else if (buf == "8000")
          buf = "6000";
        else if (buf == "6000")
          buf = "4000";
        else if (buf == "4000")
          buf = "2000";
        else if (buf == "2000")
          buf = "1000";
        else if (buf == "1000")
          buf = "500";
        else if (buf == "500")
          buf = "400";
        else if (buf == "400")
          buf = "300";
        else if (buf == "300")
          buf = "200";
        else if (buf == "200")
          buf = "100";
        else if (buf == "100")
          buf = "0";
        else if (buf == "0")
          buf = "60000";
        else
		 buf = "60000";
  ret = "true";
}
else if (userInput == "eight" || userInput == "8")
{
if (subtitle == "off")
  subtitle = "on";
else if (subtitle == "on")
  subtitle = "off";
else
  subtitle = "on";
ret = "true";
}
else
{
info=" ";
n=0;
setRefreshTime(-1);
ret="false";
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
	<title>iplay - download</title>
	<menu>main menu</menu>
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function xml_fix($string) {
    $v=str_replace("\u015e","S",$string);
    $v=str_replace("\u015f","s",$v);
    $v=str_replace("\u0163","t",$v);
    $v=str_replace("\u0162","T",$v);
    $v=str_replace("\u0103","a",$v);
    $v=str_replace("\u0102","A",$v);
    $v=str_replace("\u00a0"," ",$v);
    $v=str_replace("\u00e2","a",$v);
    $v=str_replace("\u021b","t",$v);
    $v=str_replace("\u201e","'",$v);
    $v=str_replace("\u201d","'",$v);
    $v=str_replace("\u0219","s",$v);
    $v=str_replace("\u00ee","i",$v);
    $v=str_replace("\u00ce","I",$v);
    $v=str_replace("\u2019","'",$v);
    $v=str_replace("\/","/",$v);
    return $v;
}
$f = "/usr/local/bin/home_menu";

if (file_exists("/tmp/hdd/root/filme.txt"))
 $l="/tmp/hdd/root/filme.txt";
elseif (file_exists("/tmp/hdd/volumes/HDD1/filme.txt"))
 $l="/tmp/hdd/volumes/HDD1/filme.txt";
elseif (file_exists("/usr/local/etc/filme.txt"))
 $l="/usr/local/etc/filme.txt";
else
 $l = "";
if (file_exists($l)) {
$h=file_get_contents($l);
$t=explode("|",$h);
$c=count($t);
for ($i=0;$i<$c;$i=$i+5) {
 $title=$t[$i];
 $down = $t[$i+4];
 $id=$t[$i+1];
 $image=$t[$i+2];
 $an=$t[$i+3];
 $t1=explode("/",$down);
 $save=$t1[1];
 echo'
 <item>
 <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url2="http://127.0.0.1/cgi-bin/scripts/util/iplay1_xml.php?file='.$id.','.urlencode($down).'" + "," + buf + "," + subtitle;
    url1=getURL(url2);
    url="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream," + url1;
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$t.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    ';
    if (file_exists($f)) {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
    ';
    } else {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    ';
    }
    echo '
    </script>
    </onClick>
 <image>'.$image.'</image>
 <an>'.$an.'</an>
 <id>'.$id.'</id>
 <download>'.$down.'</download>
 <name>'.$save.'</name>
 </item>
 ';
}
}

?>

</channel>
</rss>
