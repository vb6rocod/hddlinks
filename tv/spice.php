#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
?>
<rss version="2.0">
<script>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";

  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";
  storagePath_playlist    = storagePath + "playlist.dat";
  error_info          = "";
</script>
<onEnter>
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "spice_server.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
    server = "Da";
  else
    server = getStringArrayAt(optionsArray, 0);
  startitem = "middle";
  setRefreshTime(1);
</onEnter>
<onExit>
setRefreshTime(-1);
  arr = null;
  arr = pushBackStringArray(arr, server);
  print("arr=",arr);

  writeStringToFile(optionsPath, arr);
</onExit>
<onRefresh>
    itemCount = getPageInfo("itemCount");
    setRefreshTime(-1);
    redrawdisplay();
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
	itemWidthPC="30"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="30"
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
	idleImageXPC="80" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="25" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"2=Server Dinamic: " + server;</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<text align="left" redraw="yes"
          lines="18" fontSize=15
		      offsetXPC=38 offsetYPC=25 widthPC=57 heightPC=65
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>

		<!--
		<image  redraw="yes" offsetXPC=52 offsetYPC=25 widthPC=25 heightPC=10>
  /usr/local/etc/www/cgi-bin/scripts/tv/image/dolce.jpg
		</image>
         -->
		<image  redraw="yes" offsetXPC=10 offsetYPC=7 widthPC=10 heightPC=10>
		<script>print(img); img;</script>
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=modifica aspect la vizionare, dreapta pentru program
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
  annotation = " ";
  setFocusItemIndex(idx);
  setItemFocus(0);
  ret = "true";
}
else if (userInput == "video_play" || userInput == "play") {
  showIdle();
  url1=getItemInfo(getFocusItemIndex(),"url");
  url2="http://127.0.0.1/cgi-bin/scripts/tv/spice_link.php?file=" + url1 + "," + server;
  url=getUrl(url2);
  movie="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream," + url;
  cancelIdle();
  playitemurl(movie,10);
  ret = "true";
}
else if(userInput == "right" || userInput == "R")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/spice_prog.php?file=" + getItemInfo(idx,"url");
annotation = getURL(url_canal);
cancelIdle();
ret = "true";
}
else if (userInput == "two" || userInput == "2")
{
 if (server == "Nu")
   server = "Da";
 else if (server == "Da")
   server = "Nu";
  ret = "true";
}
else
{
annotation = " ";
ret = "false";
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
<channel>
	<title>spicetv.ro TV</title>
	<menu>main menu</menu>
<?php
//username|pass
$filename = "/usr/local/etc/dvdplayer/spice.txt";
$cookie="D://spice.txt";
$cookie="/tmp/spice1.txt";
if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a=explode("|",$c);
  $a1=str_replace("?","@",$a[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a[1]);
if (!file_exists($cookie)) {
  $l="http://www.spicetv.ro/user/login";
  $post="email=".$user."&pass=".$pass."&submit=Login";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
}
}
  $link="http://www.spicetv.ro/tv-online";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);

$logout=str_between($html,'title="Logout">','</a>');
if (!$logout) {
exec("rm -f /tmp/spice.txt");
$link = "/usr/local/etc/www/cgi-bin/scripts/tv/spice.rss";
$description="Pentru a accesa acest site trebuie să aveţi un cont pe spicetv.ro. Completaţi userul şi parola în acest formular şi apoi apăsaţi Return, Return după care accesaţi din nou această pagină.Folositi ? pentru @ in caz ca nu aveti aceasta tasta.";

	  echo '
	  <item>
	  <title>Logare</title>
	  <link>'.$link.'</link>
	  <annotation>'.$description.'</annotation>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
}
$rtmp="rtmp://109.163.236.119:1935/live";
$app="live";
$html=str_between($html,'ul class="overview','</ul');
$videos = explode('<li>', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
   $t1=explode('href="',$video);
   $t2=explode('"',$t1[1]);
   $link=$t2[0];
   
   $t1=explode('title="',$video);
   $t2=explode('"',$t1[1]);
   $title=$t2[0];
   
   $tip=str_between($video,"<span>","</span>");
   if ($tip == "GRATUIT") $title=$title." - ".$tip;
   
   $t1=explode('src="',$video);
   $t2=explode('"',$t1[1]);
   $image=$t2[0];

     echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     url3="http://127.0.0.1/cgi-bin/scripts/tv/spice_link.php?file='.$link.'" +  "," + server;
     url=geturl(url3);
     movie="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream," + url;
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
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <image>'.$image.'</image>
     <url>'.$link.'</url>
     </item>
     ';
}

?>
</channel>
</rss>
