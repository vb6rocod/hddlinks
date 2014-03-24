#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>
<mediaDisplay name="photoView"
	fontSize="16"
	rowCount="7"
	columnCount="3"
	sideColorBottom="10:105:150"
	sideColorTop="10:105:150"
	itemYPC="25"
	itemXPC="5"
	itemGapXPC="1"
	itemGapYPC="1"
	rollItems="yes"
	drawItemText="yes"
	itemOffsetXPC="5"
	itemImageWidthPC="0.1"
	itemImageHeightPC="0.1"
	imageBorderPC="1.5"
	forceFocusOnItem="yes"
	itemCornerRounding="yes"
	sideTopHeightPC=20
	bottomYPC=80
	sliding=yes
	showHeader=no
	showDefaultInfo=no
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
	>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="85" widthPC="100" heightPC="10" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
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
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx) 
					{
					  annotation = getItemInfo(idx, "title");
					}
				</script>
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
    idx -= -21;
    if(idx &gt;= itemSize)
      idx = itemSize-1;
  }
  else
  {
    idx -= 21;
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
<channel>
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
}
$tit= str_replace("\'","'",$tit);
echo '
	<title>'.$tit.'</title>
	';
$html = file_get_contents($link);
/**
$html1 = str_between($html,"ista episoadelor",'<div style="clear: both;">');
if ($html1 == "") {
   $html1 = str_between($html,'<div class="post-wrapper">','<div id="commentwrap">');
}
**/
$html1 = str_between($html,'<span class="post-title">','<div style="clear: both;">');
$n=1;
$seasons = explode('<table',$html1);
unset($seasons[0]);
$seasons = array_values($seasons);
foreach($seasons as $season) {
$img = str_between($season,'src="','"');
$img = str_replace(' ','%20',$img);
$videos = explode('<a', $season);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1 = explode('href="', $video);
  $t2 = explode('"', $t1[1]);
  $link = $t2[0];

  $t1 = explode('">', $video);
  $t2 = explode('<', $t1[1]);
  $title1 = trim($t2[0]);
  $title = $n.".".$title1;
  $title2 =$tit."-".$n.".".$title1;

	if (($link <> "") && ($title1 <> "")){
		$link = "http://127.0.0.1/cgi-bin/scripts/filme/php/serialepe_link.php?file=".$link.",".urlencode($title2);
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
 		<media:thumbnail url="'.$img.'" />
 		<mediaDisplay name="threePartsView"/>
    </item>
    ';
	}
}
$n++;
}
?>
</channel>
</rss>
