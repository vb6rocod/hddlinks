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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<image  redraw="yes" offsetXPC=52 offsetYPC=25 widthPC=20 heightPC=40>
		<script>print(img); img;</script>
		</image>
 	     <text  redraw="yes" align="left" offsetXPC="52" offsetYPC="70" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(premiera); premiera;</script>
		</text>
 	     <text  redraw="yes" align="left" offsetXPC="52" offsetYPC="75" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(gen); gen;</script>
		</text>
 	     <text  redraw="yes" align="left" offsetXPC="52" lines="2" offsetYPC="80" widthPC="43" heightPC="10" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(actori); actori;</script>
		</text>
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
					  annotation = getItemInfo(idx, "title");
					  img = getItemInfo(idx,"image");
					  premiera = getItemInfo(idx,"premiera");
					  gen = getItemInfo(idx,"gen");
					  actori = getItemInfo(idx,"actori");
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
	<title>westernmania.net</title>
	<menu>main menu</menu>


<?php
//http://www.westernmania.net
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$link = $_GET["file"];
if($link) {
  $link=urldecode($link);
  //http://www.westernmania.net/search?updated-max=2011-10-20T11%3A38%3A00%2B02%3A00&max-results=7
  //http://www.westernmania.net/search?updated-max=2011-10-20T11:38:00+02:00&max-results=7
  $p1=explode("?",$link);
  $part2=str_replace(":","%3A",$p1[1]);
  $part2=str_replace("+","%2B",$part2);
  $link=$p1[0]."?".$part2;
  $html = file_get_contents($link);
  $t1=explode("a class='blog-pager-newer-link",$html);
  $t2=explode("href='",$t1[1]);
  $t3=explode("'",$t2[1]);
  $prev_link=urlencode($t3[0]);
  $t1=explode("a class='blog-pager-older-link",$html);
  $t2=explode("href='",$t1[1]);
  $t3=explode("'",$t2[1]);
  $next_link=urlencode($t3[0]);
  $url=$sThisFile."?file=".$prev_link;
  if ($prev_link <> "") {
  echo '
  <item>
  <title>Previous Page</title>
   <link>'.$url.'</link>
   <annotation>Pagina anterioară</annotation>
   <image>image/left.jpg</image>
   <mediaDisplay name="threePartsView"/>
   </item>
   ';
   }
} else {
  $html = file_get_contents("http://www.westernmania.net");
  $t1=explode("a class='blog-pager-older-link",$html);
  $t2=explode("href='",$t1[1]);
  $t3=explode("'",$t2[1]);
  $next_link=urlencode($t3[0]);
}

function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}

$videos = explode('post-title entry-title', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1 = explode("href='", $video);
    $t2 = explode("'", $t1[1]);
    $link_film = $t2[0];
    
    $t3=explode(">",$t1[1]);
    $t4=explode("<",$t3[1]);
    $title=$t4[0];

    $t1 = explode('src="', $video);
    $t2 = explode('"', $t1[1]);
    $image = $t2[0];
    
    $t1=explode("Premiera",$video);
    $t2=explode("<",$t1[1]);
    $premiera = "Premiera:".$t2[0];
    
    $t1=explode("Gen",$video);
    $t2=explode("<",$t1[1]);
    $gen="Gen:".$t2[0];
    
    $t1=explode("Actori",$video);
    $t2=explode("<",$t1[1]);
    $actori="Actori:".$t2[0];

    $link_film = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?'.$link_film.','.urlencode($title);

    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link_film.'</link>
    <premiera>'.$premiera.'</premiera>
    <gen>'.$gen.'</gen>;
    <actori>'.$actori.'</actori>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
}
  $url=$sThisFile."?file=".$next_link;
  echo '
  <item>
  <title>Next Page</title>
   <link>'.$url.'</link>
   <annotation>Pagina următoare</annotation>
   <image>image/right.jpg</image>
   <mediaDisplay name="threePartsView"/>
   </item>
   ';
?>

</channel>
</rss>
