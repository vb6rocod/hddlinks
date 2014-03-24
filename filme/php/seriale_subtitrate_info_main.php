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
	<title>seriale.subtitrate.info</title>
	<menu>main menu</menu>

<?php
function ascii2entities($string){
    for($i=128;$i<=255;$i++){
        $entity = htmlentities(chr($i), ENT_QUOTES, 'cp1252');
        $temp = substr($entity, 0, 1);
        $temp .= substr($entity, -1, 1);
        if ($temp != '&;'){
            $string = str_replace(chr($i), '', $string);
        }
        else{
            $string = str_replace(chr($i), $entity, $string);
        }
    }
    return $string;
}
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
$host = "http://127.0.0.1/cgi-bin";
//http://seriale.subtitrate.info/index.php?menu=tv-shows
//http://seriale.subtitrate.info/tv-shows
$query = $_GET["file"];
if ($query) {
   $link=$query;
} else {
  $link="http://seriale.subtitrate.info/tv-shows";
}
$html = file_get_contents($link);
$videos = explode('<div class="video archive">', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1=explode('href="',$video);
    $t2=explode('"',$t1[1]);
    $link=$t2[0];
    $t3=explode(">",$t1[2]);
    $t4=explode("<",$t3[1]);
    $title=$t4[0];

    $t1 = explode('src=', $video);
    $t2 = explode('&', $t1[2]);
    $image = $t2[0];


    $data = trim(str_between($video,'<p>','</p>'));
    $data = preg_replace("/(<\/?)([^>]*>)/e","",$data);
    $data = str_replace("&#351;","s",$data);
    $data = str_replace("&#259;","a",$data);
    $data = str_replace("&#355;","t",$data);
    $data = str_replace("&quot;","",$data);
    $data = trim(str_replace("&nbsp;","",$data));
    $data = htmlentities($data);
     $data = str_replace("&ordm;","s",$data);
     $data = str_replace("&Ordm;","S",$data);
     $data = str_replace("&thorn;","t",$data);
     $data = str_replace("&Thorn;","T",$data);
     $data = str_replace("&icirc;","i",$data);
     $data = str_replace("&Icirc;","I",$data);
     $data = str_replace("&atilde;","a",$data);
     $data = str_replace("&Atilde;","I",$data);
     $data = str_replace("&acirc;","a",$data);
     $data = str_replace("&Acirc;","A",$data);

    if ($link <> "") {
		$link = $host.'/scripts/filme/php/seriale_subtitrate_info.php?file='.$link.",".urlencode($title);

  echo '
  <item>
  <title>'.$title.'</title>
  <link>'.$link.'</link>
  <image>'.$image.'</image>	
  <annotation>'.$data.'</annotation>
  <media:thumbnail url="'.$image.'" />
  <mediaDisplay name="threePartsView"/>
  </item>
  ';
}
}

?>

</channel>
</rss>
