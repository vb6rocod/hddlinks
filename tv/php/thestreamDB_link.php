#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
}
$link="http://www.thestreamdb.com/stream/".$link;
$html=file_get_contents($link);
$t1=explode('SRC="',$html);
$t2=explode('"',$t1[1]);
$img=trim($t2[0]);
if (strpos($img,"http") === false) {
$img="http://www.thestreamdb.com".$img;
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
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
		
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    2= adauga la favorite, 3 = sterge de la favorite
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=61 offsetYPC=30 widthPC=30 heightPC=35>
  <?php echo $img; ?>
		</image>
		<idleImage> image/POPUP_LOADING_01.png </idleImage>
		<idleImage> image/POPUP_LOADING_02.png </idleImage>
		<idleImage> image/POPUP_LOADING_03.png </idleImage>
		<idleImage> image/POPUP_LOADING_04.png </idleImage>
		<idleImage> image/POPUP_LOADING_05.png </idleImage>
		<idleImage> image/POPUP_LOADING_06.png </idleImage>
		<idleImage> image/POPUP_LOADING_07.png </idleImage>
		<idleImage> image/POPUP_LOADING_08.png </idleImage>

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
  ret="true";
}
else if (userInput == "two" || userInput == "2")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/tv/php/thestreamDB_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1") + "*" + "<?php echo $img; ?>";
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
}
else if (userInput == "three" || userInput == "3")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/tv/php/thestreamDB_add.php?mod=delete*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1") + "*" + "<?php echo $img; ?>";
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
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
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$baseurl="http://127.0.0.1/cgi-bin/translate?stream,";
$baseurl="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,";
$title=$tit;
$videos = explode('<link>', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1 = explode('<', $video);
    $link=$t1[0];
    $link=str_replace('"',"",$link);
    $link=trim($link);
    $p=explode(":",$link);
    $protocol=$p[0];
    $opt="";
    if (preg_match("/rtmp/",$protocol)) {
      //Rtmp-options:
      $t1=explode(" ",$link);
      $l=$t1[0];
      preg_match("/(swfurl=)(.*)/i",$link,$m);
      $t2=explode(" ",$m[2]);
      $swf=trim($t2[0]);

      preg_match("/(pageUrl=)(.*)/i",$link,$m);
      $t2=explode(" ",$m[2]);
      $page=trim($t2[0]);

      preg_match("/(playpath=)(.*)/i",$link,$m);
      $t2=explode(" ",$m[2]);
      $playpath=$t2[0];
      preg_match("/(app=)(.*)/i",$link,$m);
      $t2=explode(" ",$m[2]);
      $app=$t2[0];
      preg_match("/(tcUrl=)(.*)/i",$link,$m);
      $t2=explode(" ",$m[2]);
      $tcUrl=$t2[0];
      $link=$l;

      if (($swf <> "") || ($page <> "") || ($playpath <> "") || ($app <> "")) {
        $opt="Rtmp-options:";
        if ($swf <> "") {
          $opt=$opt."-W%20".$swf."%20";
        }
        if ($playpath <> "") {
          $opt=$opt."-y%20".$playpath."%20";
        }
        if ($app <> "") {
          $opt=$opt."-a%20".$app."%20";
        }
        if ($tcUrl <> "") {
          $opt=$opt."-t%20".$tcUrl."%20";
        }
        if ($page <> "") {
          $opt=$opt."-p%20".$page;
        }
      }
    }
    $link1=urlencode($baseurl.$opt.",".$link);
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    movie="'.$baseurl.$opt.','.$link.'";
    cancelIdle();
    playItemURL(movie, 10);
    </script>
    </onClick>
    <annotation>'.$link.'</annotation>
    <image>'.$img.'</image>
    <link1>'.$link1.'</link1>
    <title1>'.urlencode($title).'</title1>
    <media:thumbnail url="'.$img.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
}

?>

</channel>
</rss>
