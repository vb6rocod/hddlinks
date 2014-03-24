#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
}
$html = file_get_contents($link);
$image = "http://www.990.ro/".str_between($html,"src='..","'");
?>
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="50" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 1 sau 2 pentru salt +- 100
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
else if(userInput == "one" || userInput == "1")
{
    idx = Integer(getFocusItemIndex());
    idx -= -100;
    if(idx &gt;= itemCount)
    idx = itemCount-1;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  redrawDisplay();
  "true";
}
else if(userInput == "two" || userInput == "2")
{
    idx = Integer(getFocusItemIndex());
    idx -= 100;
    if(idx &lt; 0)
      idx = 0;

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
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://www.990.ro/seriale2-10140-10393-Hell-on-wheels--online-Pilot-download.html
//http://www.990.ro/player-seriale-10140-10393-Hell-on-wheels--online-Pilot-.html
//$html = str_between($html,"<table border='0' cellpadding='0' cellspacing='0' width='100%'>","</table>");
$videos = explode("div style='position:relative; float:left; border:0px solid #000;'", $html);
unset($videos[0]);
$videos = array_values($videos);
$n=0;
foreach($videos as $video) {
    $t1 = explode("a href='", $video);
    $t2 = explode("'", $t1[1]);
    $link = $t2[0];    
    $t3 = explode(">",$t1[1]);
    $t4 = explode("<",$t3[1]);
    $title1 = trim($t4[0]);
    //$link = str_replace("download","sfast",$link);
    $link = str_replace("seriale2","player-serial",$link);
    $t1=explode("-",$link);
    $link=$t1[0]."-".$t1[1]."-".$t1[2]."-".$t1[3]."-sfast.html";
    //$link = str_replace(",","*",$link);
    //http://www.990.ro/player-seriale-88-7216-Stargate-Atlantis-Poarta-stelara-Atlantis-online-Rising-.html
    //http://www.990.ro/player-seriale-redirect-serial.php?id=88&idul=7216&v=1
    //http://www.990.ro/player-seriale-redirect-serial.php?id=88&idul=7217&v=1
    //$link = ltrim($link,"player-seriale-");
    $t1=explode("<div",$video);
    $t2=explode(">",$t1[1]);
    $t3=explode("<",$t2[1]);
    $title2=trim(str_replace(",","",$t3[0]));

    //$link="player-seriale-redirect-serial.php?id=".$id."@idul=".$idul."@v=1";

      $link = "http://www.990.ro/".$link;
      $link=str_replace(",","%2C",$link);
      $title=$title2." - ".$title1;
      $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file='.urlencode($link).",".urlencode($title);
   if ($title2) {
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
