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
}
$html = file_get_contents($link);
$t1=explode('class="entry-thumb"',$html);
$image=str_between($t1[1],'src="','"');
$t1=explode("src=",$image);
$t2=explode("&",$t1[1]);
$image=$t2[0];
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
    storagePath             = getStoragePath("tmp");
    storagePath_stream      = storagePath + "stream.dat";
    storagePath_playlist    = storagePath + "playlist.dat";
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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=55 offsetYPC=35 widthPC=35 heightPC=50>
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
	<title><?php echo $tit; ?></title>
	<menu>main menu</menu>


<?php
	echo '
	<item>
		<title>Alege una din variantele de mai jos</title>
		<annotation>Download link</annotation>
		<mediaDisplay name="threePartsView"/>
	</item>
	';
//$html1=str_between($html,'class="su-note-shell"','</div');
//if ($html1) {
$videos = explode('/adfly_v2.php?url=', $html);
unset($videos[0]);
$videos = array_values($videos);
$i=1;
foreach($videos as $video) {		
    $t1 = explode('"', $video);
    $link=$t1[0];
    $title="Varianta ".$i;
    
    $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file='.$link.','.urlencode($title);
    $i++;
  echo '
  <item>
  <title>'.$title.'</title>
  <link>'.$link.'</link>
  <annotation>'.$data.'</annotation>
  <image>'.$image.'</image>
  <media:thumbnail url="'.$image.'" />
  <mediaDisplay name="threePartsView"/>
  </item>
  ';
}

if(preg_match_all("/(http\b.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
}
$s="/vidxden\.c|divxden\.c|vidbux\.c|movreel\.c|videoweed\.(c|e)|novamov\.(c|e)|vk\.com";
$s=$s."|movshare\.net|youtu|flvz\.com|rapidmov\.net|putlocker\.com|mixturevideo\.com|";
$s=$s."peteava\.ro\/embed|peteava\.ro\/id|content\.peteava\.ro|divxstage\.net|divxstage\.eu";
$s=$s."|vimeo\.com|googleplayer\.swf|filebox\.ro\/get_video|vkontakte\.ru|megavideo\.com|videobam\.com";
$s=$s."|fastupload\.ro|fastupload\.rol\.ro|video\.rol\.ro|zetshare\.net\/embed|ufliq\.com|stagero\.eu|ovfile\.com";
$s=$s."|trilulilu|proplayer\/playlist-controller.php|viki\.com|modovideo\.com|roshare\.info|";
$s=$s."filebox\.com|glumbouploads\.com|uploadc\.com|sharefiles4u\.com|zixshare\.com|uploadboost\.com";
$s=$s."|nowvideo\.eu|vreer\.com|180upload\.com|dailymotion\.com|nosvideo\.com|vidbull\.com/i";
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
  //echo $cur_link;
  if (preg_match($s,$cur_link)) {
    if ($cur_link <> $last_link) {
    if (!preg_match("/facebook|twitter|img\.youtube/",$cur_link)) {
      $link2="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link);
      $server = str_between($cur_link,"http://","/");
	    echo'
	    <item>
	    <title>'.$server.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link2.'";
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
        </item>
        ';
     }
     }
    }
  }
?>

</channel>
</rss>
