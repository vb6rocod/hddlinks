#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$link="http://vremea.meteoromania.ro/";
$html = file_get_contents($link);
$t1=explode('id="image_rotate"',$html);
$t2=explode('src="',$t1[1]);
$t3=explode('"',$t2[3]);
$img="http://vremea.meteoromania.ro/".$t3[0];
$t4=explode('span class="titlu">',$t1[1]);
$t5=explode('<',$t4[3]);
$desc=$t5[0];
$t1=explode('value="file=',$html);
$t2=explode('&',$t1[1]);
$t3=explode("&streamer=",$html);
$t4=explode('&',$t3[1]);
$video=$t4[0].$t2[0];
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
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>

		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=45 widthPC=30 heightPC=30>
  <?php echo $img; ?>
		</image>
  	<text  redraw="yes" align="center" lines="3" offsetXPC="60" offsetYPC="25" widthPC="30" heightPC="15" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Prognoza meteo în ţară pentru ziua de mâine: <?php echo $desc; ?>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi: 1=primul 2=mijloc 3=ultimul. REV/NEXT salt o pagină (8)
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
if (userInput == "one" || userInput == "1")
{
  idx=0;
  setFocusItemIndex(idx);
  setItemFocus(0);
  redrawDisplay();
  "true";
}
if (userInput == "two" || userInput == "2")
{
  idx=Integer(itemCount / 2);
  setFocusItemIndex(idx);
  setItemFocus(0);
  redrawDisplay();
  "true";
}
if (userInput == "three" || userInput == "3")
{
  idx = itemCount-1;
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
<title>Vremea în România</title>
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
if ($video <> "") {
echo '
<item>
<title>Video - Prognoza meteo - Avertizări meteo</title>
<onClick>
<script>
movie="http://127.0.0.1/cgi-bin/translate?stream,,'.$video.'";
playItemUrl(movie,10);
</script>
</onClick>
</item>
';
}
$videos = explode('<option', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('value="',$video);
  $t2=explode('"',$t1[1]);
  $id=$t2[0];
  $t3=explode(">",$t1[1]);
  $t4=explode("<",$t3[1]);
  $title=trim($t4[0]);
  $r_title=str_replace(" ","_",$title);
  $link="http://127.0.0.1/cgi-bin/scripts/news/php/w.php?q=".$r_title.",".$id;
  echo '
  <item>
  <title>'.$title.'</title>
  <link>'.$link.'</link>
  </item>
  ';
}
  
?>
</channel>
</rss>

