#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $page = $queryArr[0];
   $search = urldecode($queryArr[1]);
}
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
	itemWidthPC="45"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="45"
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 2 pentru download, 3 pentru Download Manager
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<text align="center" redraw="yes" 
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42 
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=25>
		<script>print(img); img;</script>
		</image>
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
if (userInput == "two" || userInput == "2")
	{
     showIdle();
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
	<title>Cautare:<?php echo $search; ?></title>
	<menu>main menu</menu>


<?php
$host = "http://127.0.0.1/cgi-bin";
$cookie="D://cookie.txt";
$cookie="/tmp/cookie.txt";
$search = str_replace(' ','%20',$search);
//http://www.peteava.ro/cauta/video/funny%20clips/pagina/1
//http://www.peteava.ro/cauta/video/red/pagina/2/calitate/toate/grupare/toate/perioada/oricand/sectiuni/toate/sorteaza//directie/
$link = "http://www.peteava.ro/cauta/video/".$search."/pagina/".$page."/calitate/toate/grupare/toate/perioada/oricand/sectiuni/toate/sorteaza//directie/";
//echo $link;
//http://www.peteava.ro/cauta/video/red/pagina/2
$link = "http://www.peteava.ro/cauta/video/".$search."/pagina/".$page;

//$html = file_get_contents($link);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.peteava.ro/");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);

if($page > 1) { ?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page-1).",";
if($search) { 
  $url = $url.$search; 
}
?>
<title>Previous Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina anterioară</annotation>
<image>image/left.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>


<?php } ?>
<?php

//$videos = explode('<div class="playListAdded"', $html);
$videos=explode('div class="materialItemContainer"',$html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t1 = explode('<a href="', $video);
  $t2 = explode('"', $t1[2]);
  $link = $t2[0];
	$link = str_replace(' ','%20',$link);
	$link = str_replace('[','%5B',$link);
	$link = str_replace(']','%5D',$link); 
	$link = "http://www.peteava.ro".$link;

  for ($i=1;$i<6;$i++) {
  $t1 = explode('src="', $video);
  $t2 = explode('"', $t1[$i]);
  $image = $t2[0];
  if (strpos($image,"pixel.gif") === false) break;
  }

  $t1 = explode('title="', $video);
  $t2 = explode('"', $t1[2]);
  $title = htmlspecialchars_decode($t2[0]);


  $link = $host.'/scripts/filme/php/peteava_link.php?file='.$link;
    $name = preg_replace('/[^A-Za-z0-9_]/','_',$title).".flv";

    $f = "/usr/local/bin/home_menu";
    if (file_exists($f)) {
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getURL(url);
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$pg_tit.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$name.'</name>
  <image>'.$image.'</image>
  <annotation>'.$data.'</annotation>
  <media:thumbnail url="'.$image.'" />
  <mediaDisplay name="threePartsView"/>
  </item>
  ';
  } else {
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getURL(url);
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$pg_tit.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    </script>
    </onClick>
    <download>'.$link.'</download>
    <name>'.$name.'</name>
  <image>'.$image.'</image>
  <annotation>'.$data.'</annotation>
  <media:thumbnail url="'.$image.'" />
  <mediaDisplay name="threePartsView"/>
  </item>
  ';
  }
}

?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page+1).",";
if($search) { 
  $url = $url.$search; 
}
?>
<title>Next Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina următoare</annotation>
<image>image/right.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

</channel>
</rss>
