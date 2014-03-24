#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="left" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=45
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=62 offsetYPC=30 widthPC=20 heightPC=20>
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
<title>TV Live from weeb.tv (Polski)</title>
<?php

function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function getRewriteString($string) {
    $string    = htmlentities($string);
    $string    = preg_replace("/&amp;(.)(acute|cedil|circ|ring|tilde|uml|horn);/", "$1", $string);
    return $string;
}
function getRewriteString1($string) {
    $string    = htmlentities($string);
    $string    = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml|horn|);/", "$1", $string);
    return $string;
}
function c($title) {
     $title = str_replace("&ordm;","s",$title);
     $title = str_replace("&Ordm;","S",$title);
     $title = str_replace("&thorn;","t",$title);
     $title = str_replace("&Thorn;","T",$title);
     $title = str_replace("&icirc;","i",$title);
     $title = str_replace("&Icirc;","I",$title);
     $title = str_replace("&atilde;","a",$title);
     $title = str_replace("&Atilde;","I",$title);
     $title = str_replace("&ordf;","S",$title);
     $title = str_replace("&acirc;","a",$title);
     $title = str_replace("&Acirc;","A",$title);

     return $title;
}
$link="http://weeb.tv/channels/live";
$host = "http://127.0.0.1/cgi-bin";
$html = file_get_contents($link);
$videos = explode('fieldset onclick=', $html);
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1 = explode("href='", $video);
    $t2 = explode("'", $t1[1]);
    $link = urlencode($t2[0]);

    $t1 = explode('src="', $video);
    $t2 = explode('"', $t1[1]);
    $image = $t2[0];

    $t1 = explode('title="', $video);
    $t2 = explode('"', $t1[1]);
    $t3=explode(">",$t1[1]);
    $t4=explode("<",$t3[1]);
    $title=$t4[0];
    $description = str_replace("&nbsp;","",$t2[0]);
    //$description = str_replace("&amp;","&",$description);
    //$description = getRewriteString($description);
    //rtmp://46.105.110.156/live/2/live
    //rtmp://46.105.113.103/live/1/live new ????
    //tp://weeb.tv/online/Menda/TVN
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$host.'/scripts/tv/php/weeb_link.php?file='.$link.'";
    id=getUrl(url);
    movie="http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://static.weeb.tv/player.swf%20-p%20http://weeb.tv/online,rtmp://46.105.110.156/live/" + id + "/live";
    cancelIdle();
    playItemUrl(movie,10);
    </script>
    </onClick>
    <annotation>'.$description.'</annotation>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    </item>
    ';
}

?>

</channel>
</rss>
