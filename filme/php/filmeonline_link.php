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
$t1=explode('div class="post-',$html);
$image=str_between($t1[2],'img src="','"');
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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=55 offsetYPC=35 widthPC=35 heightPC=30>
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
//$html=str_between($html,'table id="variante"','div class="shr-bookmarks');
//http://www.filmeonline.org/watch
//$html=urlencode($html);
//echo $html;
$videos = explode('href="', $html);
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {		
    $t1 = explode('"', $video);
    //http://adf.ly/402271/http://www.filmeonline.org/watch/p3VYMr3xs1KGdd/?y3bkcirnu0le
    //http://adf.ly/402271/http://www.filmeonline.org/watch/706oj432Q37cbUk/?xf65xgjm0vi5d
    //http://www.filmeonline.org/go/?http://www.filmeonline.org/watch/706oj432Q37cbUk/?xf65xgjm0vi5d
    $t2=explode("http",$t1[0]);
    if ($t2[3] <> "") {
       $link = "http".$t2[3];
       //if (strpos($t2[2],"filmeonlinenoi.org/go/") !== false) $link="";
       //$link=""; //dublura
    } else {
       $link = "http".$t2[1];
    }
    $link=str_replace("&","&amp;",$link);
    $t1 = explode('title="', $video);
    $t2 = explode('"',$t1[1]);
    $title = $t2[0];
    if (strpos($title,"-") !== false) {
      $t=explode("-",$title);
      $title=trim($t[1]);
    }
    $link=str_replace("#038;","",$link);
    //$link=urldecode($link);
    //http://adf.ly/402271/http://www.filmeonlinenoi.org/watch/N7SwWy7UpUSgtUg/?oid=70909082&#038;id=167151813&#038;hash=694b6dd18039c283&#038;hd=1
		if ($link <> "") {
		if (strpos($link,"http://www.filmeonlinenoi.org/watch") !==false) {
			$link = $host."/scripts/filme/php/filme_link.php?file=".urlencode($link).",".urlencode($tit);
    	echo '
    	<item>
    		<title>'.$title.'</title>
    		<link>'.$link.'</link>
    		<media:thumbnail url="'.$image.'" />
			<annotation>'.$title.'</annotation>
			<mediaDisplay name="threePartsView"/>
    	</item>
    	';
    }
    }
}

?>

</channel>
</rss>
