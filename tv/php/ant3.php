#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' ?>"; ?>
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $titlu = urldecode($queryArr[1]);
}
?>
<rss version="2.0">
<onEnter>
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "rec.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    buf = "60000";
  }
  else
  {
    buf = getStringArrayAt(optionsArray, 0);
  }
  startitem = "middle";
  setRefreshTime(1);
</onEnter>
 <onExit>
  arr = null;
  arr = pushBackStringArray(arr, buf);
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
	itemWidthPC="85"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="85"
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
  	<text align="left" redraw="yes" offsetXPC="6" offsetYPC="15" widthPC="60" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apasati 2 pentru download, 3 pentru download manager
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
	if( userInput == "two")
	{
        url=getItemInfo(getFocusItemIndex(),"download");
        movie=getUrl(url);
        cancelIdle();
        topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + movie + ";name=" + getItemInfo(getFocusItemIndex(),"name");
		dlok = loadXMLFile(topUrl);
		"true";
	}
if (userInput == "three" || userInput == "3")
   {
    jumpToLink("destination");
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
<destination>
	<link>http://127.0.0.1/cgi-bin/scripts/util/level.php
	</link>
</destination>
<channel>
	<title><?php echo $titlu; ?></title>
	<menu>main menu</menu>


<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$host = "http://127.0.0.1/cgi-bin";
$html = file_get_contents($link);
$year=date("Y");
$month=date("n");
$search="calendar_show_inregistrari.php?year=".$year."&month=".$month;
$t1=explode($search,$html);
$t2=explode("'",$t1[1]);
$link="http://www.antena3.ro/".$search.$t2[0];
$h=file_get_contents($link);

$videos = explode("<td", $h);
unset($videos[0]);
$videos = array_reverse($videos);
//Joi, 01 Jul 2010
foreach($videos as $video) {    
  $t1=explode('href="',$video);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  $t3=explode(">",$t1[1]);
  $t4=explode("<",$t3[1]);
  $title="Din data de ".$t4[0].".".date("m").".".date("Y");
    if ($link) {
    $link="http://www.antena3.ro".$link;
    $link="http://127.0.0.1/cgi-bin/scripts/tv/php/antena1_link.php?file=".urlencode($link);
    $name = preg_replace('/[^A-Za-z0-9_]/','_',$titlu." - ".$title).".mp4";
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getUrl(url);
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$name.'</name>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
	}
  }
/////

$month=date("n");
if ($month==1)
  $month=12;
else
  $month=$month-1;
$year=date("Y");
if ($month==12)
  $year=$year-1;
$search="calendar_show_inregistrari.php?year=".$year."&month=".$month;
$t1=explode($search,$html);
$t2=explode("'",$t1[1]);
$link="http://www.antena3.ro/".$search.$t2[0];
$h=file_get_contents($link);

$videos = explode("<td", $h);
unset($videos[0]);
$videos = array_reverse($videos);
//Joi, 01 Jul 2010
foreach($videos as $video) {
  $t1=explode('href="',$video);
  $t2=explode('"',$t1[1]);
  $link=$t2[0];
  $t3=explode(">",$t1[1]);
  $t4=explode("<",$t3[1]);
  $title="Din data de ".$t4[0].".".$month.".".$year;
    if ($link) {
    $link="http://www.antena3.ro".$link;
    $link="http://127.0.0.1/cgi-bin/scripts/tv/php/antena1_link.php?file=".urlencode($link);
    $name = preg_replace('/[^A-Za-z0-9_]/','_',$titlu." - ".$title).".mp4";
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getUrl(url);
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$name.'</name>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
	}
  }
?>
</channel>
</rss>  
