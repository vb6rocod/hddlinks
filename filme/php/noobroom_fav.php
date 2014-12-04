#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);
$host = "http://127.0.0.1/cgi-bin";
$noob_serv="/tmp/noob_serv.log";
$hserv=file_get_contents($noob_serv);
$serv=explode("\n",$hserv);
$nn=count($serv);
$ff="/tmp/n.txt";
if (!file_exists($ff)) {
$l="http://noobroom.com/";
$h=file_get_contents($l);
$t1=explode('value="',$h);
$n= count($t1);
$t2=explode('"',$t1[$n-1]);
$noob=$t2[0];
$fh = fopen($ff, 'w');
fwrite($fh, $noob);
fclose($fh);
} else {
$noob=file_get_contents($ff);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $$noob."/func.js");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$noob);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
$t1=explode('src="',$h);
$t2=explode("'",$t1[1]);
$baseimg=$t2[0];
$baseimg=$noob."/2img/";
$baseimg="http://107.6.170.83/~nooboard/2img/";
?>
<rss version="2.0">
<onEnter>
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "noobroom.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    subtitle = "on";
     server = "-1";
     sserver="Default";
     hhd = "0";
     shd = "SD";
  }
  else
  {
    subtitle = getStringArrayAt(optionsArray, 0);
    server = getStringArrayAt(optionsArray, 1);
    hhd = getStringArrayAt(optionsArray, 2);
  }
  if (subtitle == " " || subtitle == "" || subtitle == null)
    subtitle = "on";
  if (server == " " || server == "" || server == null)
    {
    server = "-1";
    sserver="Default";
    }
  if (hhd == " " || hhd == "" || hhd == null)
    {
     hhd = "0";
     shd="SD";
    }
  startitem = "middle";
    if (hhd == "0")
      shd="SD";
    else if (hhd == "1")
      shd="HD";
    else if (hhd == "2")
      shd="MP4";
    else if (hhd == "3")
      shd="HMP4";
    if (server == "-1")
      sserver="Defaut";
<?php
for ($k=0;$k<$nn-1;$k=$k+2) {
$n=$k/2;
echo '
    else if (server == "'.$n.'")
      sserver="'.$serv[$k].'";
      ';
}
?>
setRefreshTime(1);
</onEnter>
<onExit>
  arr = null;
  arr = pushBackStringArray(arr, subtitle);
  arr = pushBackStringArray(arr, server);
  arr = pushBackStringArray(arr, hhd);
  print("arr=",arr);

  writeStringToFile(optionsPath, arr);
</onExit>

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
    5=Setare subtitrare, info=server load
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="70" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=sterge, 2= download,0=dl. manager,4/6= jump -+100, right for more...
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
	<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=50>
         <script>print(image); image;</script>
		</image>
	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"3= Subtitrare: " + subtitle + " 7=Server: " + sserver + " 9=SD/HD/MP4/HMP4:" + shd;</script>
		</text>
   	<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="80"  heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <widthPC>
			<script>
				if (an == "" || an == null ) "0";
				else "30";
			</script>
		   </widthPC>
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
  annotation = " ";
  setFocusItemIndex(idx);
  setItemFocus(0);
  ret = "true";
}
else if (userInput == "three" || userInput == "3")
{
if (subtitle == "off")
  subtitle = "on";
else if (subtitle == "on")
  subtitle = "off";
else
  subtitle = "on";
ret = "true";
}
else if (userInput == "two" || userInput == "2")
	{
     showIdle();
     url=getItemInfo(getFocusItemIndex(),"download") + server + "," + hhd + ",0";
     movie=getUrl(url);
     cancelIdle();
	 topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + movie + ";name=" + getItemInfo(getFocusItemIndex(),"name");
	 dlok = loadXMLFile(topUrl);
	 "true";
}
else if (userInput == "zero" || userInput == "0")
   {
    jumpToLink("destination");
    "true";
}
else if (userInput == "five" || userInput == "5")
   {
    jumpToLink("sub");
    "true";
}
else if(userInput == "six" || userInput == "6")
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
else if(userInput == "four" || userInput == "4")
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
else if(userInput == "seven" || userInput == "7")
{
<?php
echo '
if (server == "-1")
  {
    server = "0";
    sserver="'.$serv[0].'";
  }
  ';
for ($k=0;$k<$nn-3;$k=$k+2) {
$n=$k/2;
echo '
else if (server == "'.$n.'")
  {
    server = "'.($n+1).'";
    sserver="'.$serv[$k+2].'";
  }
';
}
echo '
else if (server == "'.(($nn-3)/2).'")
  {
    server = "-1";
    sserver="Default";
  }
';
?>
else
  {
    server= "-1";
    sserver="Default";
  }
}
else if(userInput == "nine" || userInput == "9")
{
if (hhd == "0")
 {
  hhd = "1";
  shd = "HD";
 }
else if(hhd == "1")
 {
  hhd = "2";
  shd = "MP4";
 }
else if(hhd == "2")
 {
  hhd = "3";
  shd = "HMP4";
 }
else if(hhd == "3")
 {
  hhd = "0";
  shd = "SD";
 }
}
else if (userInput == "right" || userInput == "R")
{
movie=getItemInfo(getFocusItemIndex(),"movie");
showIdle();
movie_info="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_det.php?file=" + movie;
dummy = getURL(movie_info);
cancelIdle();
ret_val=doModalRss("/usr/local/etc/www/cgi-bin/scripts/filme/php/movie_detail.rss");
ret="true";
}
else if (userInput == "display" || userInput == "DISPLAY")
{
showIdle();
movie_info="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_serv_load.php";
dummy = getURL(movie_info);
cancelIdle();
ret_val=doModalRss("/usr/local/etc/www/cgi-bin/scripts/filme/php/noob_serv_load.rss");
ret="true";
}
else if (userInput == "one" || userInput == "1")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_add.php?mod=delete*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
}
redrawdisplay();
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

    <title>Noobroom - favorite</title>

<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
if (file_exists("/data"))
  $f= "/data/noobroom.dat";
else
  $f="/usr/local/etc/noobroom.dat";
if (file_exists($f)) {
$html=file_get_contents($f);
$videos=explode("<item>",$html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $l=str_between($video,"<link>","</link>");
  //echo $l."<BR>";
  $title=urldecode(str_between($video,"<title>","</title>"));
  $arr[]=array($title, $l);
}
asort($arr);
foreach ($arr as $key => $val) {
  $l=$arr[$key][1];
  $title=$arr[$key][0];
   $title=str_replace("&amp;","&",$title);
   $title=str_replace("&","&amp;",$title);
   $title=str_replace("\'","'",$title);

    $link=$l;
    $name = preg_replace('/[^A-Za-z0-9_]/','_',$title).".mp4";
	$year="";
    $link1="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_link.php?file=".$link.",no,";
    $image="http://174.120.232.227/~usahowie/2img/".$link.".jpg";
    $image="http://199.192.217.10/~nooboard/2img/".$link.".jpg";
    $image="http://coral-gate-286.appspot.com/img/".$link.".jpg";
    $image=$noob."/2img/".$link.".jpg";
    //http://107.6.170.83/~nooboard/2img/
    $image="http://199.192.217.10/~nooboard/2img/".$link.".jpg";
    $image=$baseimg.$link.".jpg";
    //$title=str_replace("&","&amp;",$title);
    echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_link.php?file='.$l.'" + "," + subtitle + "," + server + "," + hhd + ",0";
     movie=geturl(url);
     cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    ';
    $f = "/usr/local/bin/home_menu";
    if (file_exists($f)) {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer22.rss");
    ';
    } else {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    ';
    }
    echo '
     </script>
     </onClick>
    <download>'.$link1.'</download>
    <title1>'.urlencode($title).'</title1>
    <link1>'.urlencode($l).'</link1>
    <name>'.$name.'</name>
    <movie>'.$l.'</movie>
    <image>'.$image.'</image>
	<an>'.$year.'</an>
     </item>
     ';
}
}
?>


</channel>
</rss>                                                                                                                             
