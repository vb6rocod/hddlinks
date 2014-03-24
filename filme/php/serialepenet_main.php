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

<mediaDisplay name="photoView"
	fontSize="16"
	rowCount="8"
	columnCount="3"
	sideTopHeightPC="0"
	sideBottomHeightPC="0"
	sideColorBottom="10:105:150"
	sideColorTop="10:105:150"
	centerXPC="5"
	centerYPC="25"
	centerHeightPC="65"
	itemGapXPC="1"
	itemGapYPC="1"
	rollItems="yes"
	drawItemText="yes"
	itemImageWidthPC="0.1"
	itemImageHeightPC="0.1"
	imageBorderPC="1.5"
	forceFocusOnItem="yes"
	itemCornerRounding="yes"
	sliding=yes
	showHeader=no
	showDefaultInfo=no
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
	>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
		<!--<image offsetXPC=5 offsetYPC=2 widthPC=20 heightPC=16>
		  <script>channelImage;</script>
		</image>-->
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
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
    idx -= -24;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 24;
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
<script>
    channelImage = "/usr/local/etc/www/cgi-bin/scripts/filme/image/series.png";
  </script>

<channel>
	<title>serialepenet.ro</title>
	<menu>main menu</menu>

<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
error_reporting(0);
include ("../../common.php");
$pass = trim(file_get_contents("/usr/local/etc/dvdplayer/serialepe1.txt"));
//cod=asbghtyi&activare=Activeaza
if ($pass) {
$lp=$check."s1=".$pass;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $lp);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_exec($ch);
  curl_close($ch);
}
echo '
<item>
<title>Favorite</title>
<link>'.$host.'/scripts/filme/php/serialepenet_fav.php</link>
<annotation>Lista serialelor favorite</annotation>
</item>
';
// Pe Litere
$html = file_get_contents("http://serialepenet.ro/lista_seriale");
$videos = explode('views-summary views-summary-unformatted', $html);

unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
   $t1=explode('href="',$video);
   $t2=explode('"',$t1[1]);
   $link="http://serialepenet.ro".$t2[0];
   $t3=explode(">",$t1[1]);
   $t4=explode("<",$t3[1]);
   $title="Litera: ".$t4[0];
   $link = $host."/scripts/filme/php/serialepenet_lit.php?file=".$link.",".urlencode($title);
    echo '
    <item>
    <title>'.$title.'</title>
    <annotation>'.$title.'</annotation>
    <link>'.$link.'</link>
    </item>
    ';
}
//
// Categorie
$t1=explode('<h3>Categorii</h3>',$html);
$html=$t1[1];
$videos = explode('<span class="field-content">', $html);

unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
   $t1=explode('href="',$video);
   $t2=explode('"',$t1[1]);
   $link="http://serialepenet.ro".$t2[0];
   $t3=explode(">",$t1[1]);
   $t4=explode("<",$t3[1]);
   $title=$t4[0];
   $link = $host."/scripts/filme/php/serialepenet_cat.php?file=".$link.",".urlencode($title);
    echo '
    <item>
    <title>'.$title.'</title>
    <annotation>'.$title.'</annotation>
    <link>'.$link.'</link>
    </item>
    ';
}
?>
</channel>
</rss>
