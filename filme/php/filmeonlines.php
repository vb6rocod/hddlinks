#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
}
$html = file_get_contents($link);
$t1=explode('div class="post-',$html);
$t2=explode('img src="',$t1[2]);
$t3=explode('"',$t2[1]);
$image=$t3[0];
//$t1=explode('<div class="the_content" align="justify">',$html);
//$t2=str_between($t1[1],"<p>","</p>");
$t2=explode("<p>",$html);
$t3=explode("<",$t2[1]);
$t2=$t3[0];
$data = preg_replace("/(<\/?)([^>]*>)/e","",$t2);
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="50" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 1 sau 2 pentru salt +- 100
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="justify" redraw="yes"
          lines="12" fontSize=16
		      offsetXPC=55 offsetYPC=45 widthPC=40 heightPC=52
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
   <?php echo $data; ?>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=20>
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
  			    if(focus==idx) "14"; else "14";
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
$t1=explode("Cuvinte cheie",$html);
$html=$t1[0];
//echo $html;
preg_match_all('/S\d{2}E\d{2}/',$html,$r);
$v=$r[0];
for ($i=0;$i<count($v)-1;$i++) {
//$vid=str_between($html,$v[$i],"</table>");
$x=explode($v[$i],$html);
$x1=explode($v[$i+1],$x[1]);
$vid=$x1[0];
//echo $vid."<BR>";
//<div class="hosts"
$videos=explode('hosts',$vid);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('href="',$video);
  $t2=explode('"',$t1[1]);
  $t3=explode("http",$t2[0]);
  $link=$t3[3];
  $t1=explode('class="',$video);
  $t2=explode('"',$t1[1]);
  $server=$t2[0];
  $title=str_replace("<br />","",$v[$i])." - Server - ".$server;
  if ($link) {
  $link = $host."/scripts/filme/php/filme_link.php?file=http".$link.",".urlencode($tit." ".$title);
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
//last
$x=explode($v[count($v)-1],$html);
$vid=$x[1];
$videos=explode('hosts',$vid);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('href="',$video);
  $t2=explode('"',$t1[1]);
  $t3=explode("http",$t2[0]);
  $link=$t3[2];
  $t1=explode('class="',$video);
  $t2=explode('"',$t1[1]);
  $server=$t2[0];
  $title=str_replace("<br />","",$v[$i])." - Server - ".$server;
  if ($link) {
  $link = $host."/scripts/filme/php/filme_link.php?file=http".$link.",".urlencode($tit." ".$title);
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

?>

</channel>
</rss>
