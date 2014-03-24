#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>
<mediaDisplay name="threePartsView"
	itemBackgroundColor="0:0:0"
	backgroundColor="0:0:0"
	sideLeftWidthPC="0"
	itemImageXPC="5"
	itemXPC="20"
	itemYPC="20"
	itemWidthPC="65"
	capWidthPC="70"
	unFocusFontColor="101:101:101"
	focusFontColor="255:255:255"
	popupXPC = "40"
  popupYPC = "55"
  popupWidthPC = "22.3"
  popupHeightPC = "5.5"
  popupFontSize = "13"
	popupBorderColor="28:35:51"
	popupForegroundColor="255:255:255"
 	popupBackgroundColor="28:35:51"
idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		<backgroundDisplay>
			<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
			image/mele/backgd.jpg
			</image>
		</backgroundDisplay>
		<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
		image/mele/rss_title.jpg
		</image>
		<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
  <script>getPageInfo("pageTitle");</script>
		</text>
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
			    idx -= -5;
			    if(idx &gt;= itemCount)
			      idx = itemCount-1;
			  }
			  else
			  {
			    idx -= 5;
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
$cat =  $_GET["cat"];
echo '
  <title>'.$cat.'</title>
  ';
  //http://live.1hd.ro/ondemand.php?categ=Divertisment
$link = "http://live.1hd.ro/ondemand.php?categ=".$cat;
$html = file_get_contents($link);

$videos = explode('class="slide-wrapper"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  //playondemand.php?server=193.238.58.18&playfile=Ramnic_0.m4v&subtitrare=&
  $server = str_between($video,"server=","&");
  $file = str_between($video,"playfile=","&");
  //$file = str_replace(" ","%20",$file);
  $link = "rtmp://".$server."/vod/".$file;
  $link = "http://127.0.0.1/cgi-bin/translate?stream,Content-type:video/mp4,".$link;
  $title = str_between($video,"<h2>","</h2>");
      echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <enclosure type="video/mp4" url="'.$link.'"/>
    </item>
    ';
}
?>
</channel>
</rss>
