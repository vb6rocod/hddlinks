#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $tit = urldecode($queryArr[1]);
}
$html = file_get_contents($link);
$image = "http://www.990.ro/".str_between($html,"<img src='","'");
$html = str_between($html,"Servere disponibile","</table>");
?>
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
	itemWidthPC="55"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="55"
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
  	<text align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  Folosiţi PREV şi NEXT ca PageUp şi PageDown
		</text>
		<image offsetXPC=71 offsetYPC=30 widthPC=20 heightPC=40><?php echo $image; ?></image>
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
      majorContext = getPageInfo("majorContext");
      
      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);
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
$videos = explode("<tr>", $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
    $t1 = explode("href='", $video);
    //echo $t1[1];
    $t2 = explode("'", $t1[1]);
    //$t3=explode("http",$t2[0]);
    $link = $t2[0];
    $t3 = explode("<h3>",$video);
    $t4 = explode("</h3>",$t3[1]);
    $title1 = $t4[0];
    //$link = str_replace("-download","",$link);
    //$link = str_replace("desene-animate2","player-desene",$link);
    if ($link <> "") {
	    //$link = "http://www.990.ro/".$link;
			$title = $title1;
	    $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file='.urlencode($link).','.urlencode($tit);
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <media:thumbnail url="'.$image.'" />
    </item>
    ';
  }
}
?>
</channel>
</rss>
