#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
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
		<text align="justify" redraw="yes"
          lines="8" fontSize=17
		      offsetXPC=55 offsetYPC=58 widthPC=40 heightPC=38
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="55" offsetYPC="52" widthPC="15" heightPC="5" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(durata); durata;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="72" offsetYPC="52" widthPC="30" heightPC="5" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(pub); pub;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(titlu); titlu;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=25>
  <script>print(img); img;</script>
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
                      img = getItemInfo(idx,"image");
					  annotation = getItemInfo(idx, "annotation");
					  durata = getItemInfo(idx, "durata");
					  pub = getItemInfo(idx, "pub");
					  titlu = getItemInfo(idx, "title");
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
	if( userInput == "two")
	{
     url="<?php echo $host; ?>" + "/scripts/clip/php/myvideo_link.php?file=" + getItemInfo(getFocusItemIndex(),"download");
     movie=getUrl(url);
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
	<title>myvideo.ro</title>
	<menu>main menu</menu>


<?php
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $page = $queryArr[0];
   $search = $queryArr[1];
}
if($page) {
	$html = file_get_contents("http://www.myvideo.ro/Videouri_A-Z?lpage=".$page."&searchWord=&searchOrder=1");
} else {
  $page = 1;
	$html = file_get_contents("http://www.myvideo.ro/Videouri_A-Z?lpage=".$page."&searchWord=&searchOrder=1");
}


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
<annotation>Pagina anterioara</annotation>
<image>image/left.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>


<?php } ?>

<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
include ("../../common.php");
//$videos = explode("<td class='body sTLeft", $html);
$videos = explode("div class='body floatLeft fRand",$html);
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
		$id = str_between($video,"watch/","/");

    $t1 = explode("longdesc='", $video);
    $t2 = explode("'", $t1[1]);
    $image = $t2[0];
    //http://is3.myvideo.de/ro/movie23/bf/8570844.mp4
    //http://is3.myvideo.de/ro/19/8569375.mp4/
    //http://img5.myvideo.de/web/144/movie23/57/thumbs/8570809_2.jpg
    //http://img3.myvideo.de/web/144/movie23/bf/thumbs/8570844_1.jpg
    //http://i2.myv-img.de/mv/web/144/movie34/eb/thumbs/9160363_1.jpg
    //http://is2.myvideo.de/ro/movie34/eb/9160363.mp4
    //http://i4.myv-img.de/mv/web/144/movie33/b2/thumbs/9161536_1.jpg
    //http://is4.myvideo.de/ro/movie33/b2/9161536.flv
    //http://is3.myvideo.de/mv/144/movie33/e7/9161554.mp4
    
    $t3=explode("_",$image);
    $link=$t3[0].".mp4";
    $link=str_replace("/thumbs","",$link);
    $link=str_replace("/web","",$link);
    $link=str_replace("/i","/is",$link);
    $link=str_replace("myv-img","myvideo",$link);
    //echo $link;
    //http://img3.myvideo.de/144/movie23/bf/8570844.mp4

    $t1=explode("/",$link);
    $link="http://".$t1[2]."/ro/".$t1[5]."/".$t1[6]."/".$t1[7];
    //echo $link;
    $t1=explode("href='",$video);
    $t2=explode("'",$t1[2]);
    //$link="http://www.myvideo.ro".$t2[0];

    $t1 = explode("title='", $video);
    $t2 = explode("'", $t1[2]);
    $title = fix_s($t2[0]);
    //$title=html_entity_decode($title,ENT_QUOTES, "UTF-8");
    
    $t1=explode("span class='vViews'",$video);
    //$t2=explode('onmousemove="ST(event, this);',$t1[1]);
    $t3=explode('>',$t1[1]);
    $t4=explode('<',$t3[1]);
    $durata=trim($t4[0]);
    
    $t1=explode("class='sCenter vAdded'>",$video);
    $t2=explode("<",$t1[1]);
    $pub="Data:".$t2[0];
    $name = preg_replace('/[^A-Za-z0-9_]/','_',$title).".flv";
    if ($image && $title) {
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    showIdle();
    url="'.$host.'/scripts/clip/php/myvideo_link.php?file='.$link.'";
    movie=getUrl(url);
    cancelIdle();
    playItemUrl(movie,10);
    </onClick>
    <download>'.$link.'</download>
    <name>'.$name.'</name>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <durata>'.$durata.'</durata>
    <pub>'.$pub.'</pub>
    <media:thumbnail url="'.$image.'" />
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
<annotation>Pagina urmatoare</annotation>
<image>image/right.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

</channel>
</rss>
