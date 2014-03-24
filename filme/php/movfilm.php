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
   $tit = urldecode($queryArr[1]);
   $image=urldecode($queryArr[2]);
}
$html = file_get_contents($link);
/*
$t1=explode('<table align="center" width="100%"border="1" bordercolor="#000000">',$html);
$t2=explode('src="',$t1[1]);
$t3=explode('"',$t2[1]);
$image=$t3[0];
if (strpos($html,"Film Info:") !== false) {
$description=str_between($html,"Film Info:","<br />");
} else {
$description=str_between($html,"Film Inhalt:","<br />");
}
$description = preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$description);
*/
$description = $tit;
?>
<rss version="2.0">
<onEnter>
    storagePath             = getStoragePath("tmp");
    storagePath_stream      = storagePath + "stream.dat";
    storagePath_playlist    = storagePath + "playlist.dat";
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
	itemWidthPC="40"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="40"
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
    Press: 2 for download, 3 for download manager
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="justify" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<?php echo $description; ?>
		</text>
		<image  redraw="yes" offsetXPC=66 offsetYPC=22.5 widthPC=15 heightPC=30>
  <?php echo $image; ?>
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
	<title><?php echo $tit; ?></title>
	<menu>main menu</menu>


<?php
	echo '
	<item>
		<title>Servers</title>
		<mediaDisplay name="threePartsView"/>
	</item>
	';
if(preg_match_all("/(http\b.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
}
/*
$s="/vidxden|divxden|vidbux|movreel|videoweed|novamov|vk";
$s=$s."|movshare|videobb|youtube|flvz|rapidmov|putlocker|";
$s=$s."videozer";
$s=$s."|vimeo|vkontakte|megavideo|videobam";
$s=$s."|divxstage|stream2k|sockshare|xvidstage";
$s=$s."|nolimitvideo|stage666|rapidload|vidstream|2gb-hosting";
$s=$s."|dimshare|movdivx|sharevideo22|dr9000|altervideo|royalvids";
$s=$s."|skyload|rapidvideo|uploadc|uploadville|zurvid|flashx";
$s=$s."|sharefiles4u/i";
*/
$s="/vidxden\.c|divxden\.c|vidbux\.c|movreel\.c|videoweed\.(c|e)|novamov\.(c|e)|vk\.com";
$s=$s."|movshare\.net|videobb\.c|youtube\.c|flvz\.com|rapidmov\.net|putlocker\.com|";
$s=$s."videozer\.com|peteava\.ro\/embed|peteava\.ro\/id|content\.peteava\.ro";
$s=$s."|vimeo\.com|googleplayer\.swf|filebox\.ro\/get_video|vkontakte\.ru|megavideo\.c|videobam\.com";
$s=$s."|divxstage\.net|divxstage\.eu|stream2k\.com\/playerjw\/vConfig|sockshare\.com|xvidstage\.com";
$s=$s."|nolimitvideo\.com|stage666\.net\/|rapidload\.org|vidstream\.us|2gb-hosting\.com";
$s=$s."|dimshare\.com|movdivx\.com|sharevideo22\.com|dr9000\.com|altervideo\.net|royalvids\.eu";
$s=$s."|skyload\.net|rapidvideo\.com|uploadc\.com|uploadville\.com|zurvid\.com|flashx\.tv";
$s=$s."|sharefiles4u\.com/i";
//http://movfilm.net/publ/stream/movshare/mothman_die_ruckkehr/3-1-0-288
//http://movfilm.net/publ/stream/movshare/in_time_deine_zeit_lauft_ab/3-1-0-386
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
  if (preg_match($s,$cur_link)) {
    if ($cur_link <> $last_link) {
      if (!preg_match("/facebook|twitter|img\.youtube/",$cur_link)) {
        //$link="http://127.0.0.1/cgi-bin/scripts/filme/php/filme1_link.php?file=".urlencode($cur_link).",".urlencode($tit);
        //if (strpos($cur_link,"movfilm.net") === false) {
        $server = str_between($cur_link,"http://","/");
        //} else {
        //$server = str_between($cur_link,"http://movfilm.net/publ/stream/","/");
        //}
        $last_link=$cur_link;
        $title=$server;

    $name = preg_replace('/[^A-Za-z0-9_]/','_',$tit).".flv";
    $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link1.php?file=".urlencode($cur_link);
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
        streamArray = pushBackStringArray(streamArray, "'.$tit.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$name.'</name>
        </item>
        ';
/*
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
*/
    }
}
}
}
?>

</channel>
</rss>
