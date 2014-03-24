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
	itemWidthPC="25"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="25"
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
		
  	<text redraw="yes" align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(film); film;</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="22.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(cat); cat;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="28" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(regia); regia;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="33.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(actor); actor;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="39" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(durata); durata;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="44.5" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(imdb); imdb;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="52" offsetYPC="50" widthPC="43" heightPC="5" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(premiera); premiera;</script>
		</text>
		<text align="justify" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=35 offsetYPC=57 widthPC=60 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=35 offsetYPC=22.5 widthPC=15 heightPC=30>
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
					  annotation = getItemInfo(idx, "annotation");
					  img = getItemInfo(idx,"image");
					  cat = getItemInfo(idx,"cat");
					  regia = getItemInfo(idx,"regia");
					  actor = getItemInfo(idx,"actor");
					  durata = getItemInfo(idx,"durata");
					  imdb = getItemInfo(idx,"imdb");
					  premiera = getItemInfo(idx,"premiera");
                      film = getItemInfo(idx,"title");
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
	<title>filme2011.ro</title>
	<menu>main menu</menu>


<?php
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $page = $queryArr[0];
   $search = $queryArr[1];
}
//http://www.filme2011.ro/
//http://www.filme2011.ro/page/3/
if ($page==1) {
  $html = file_get_contents("http://narubian.com/filme2011/");
} else {
  $html = file_get_contents("http://narubian.com/filme2011/page/".$page."/");
}
if($page > 1) { ?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page-1).",";
if($search) { 
  $url = $url.$search; 
}
?>
<title>Previous Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina anterioara</annotation>
<image>image/left.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>


<?php } ?>

<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}

$videos = explode('<div class="post-', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
    $t1 = explode('href="', $video);
    $t2 = explode('"', $t1[1]);
    //http://mlabs.info/apps/ads/http://www.filme2011.ro/bad-teacher-2011/#
    $link = $t2[0]."#";
    $link = str_replace("http://mlabs.info/apps/ads/","",$link);
    for ($i=1;$i<5;$i++) {
    $t1 = explode('src="', $video);
    $t2 = explode('"', $t1[$i]);
    $image = $t2[0];
    if (strpos($image,".png") === false) break;
    }

    $t1=explode('title="',$video);
    $t2=explode(">",$t1[1]);
    $t3=explode("<",$t2[1]);
    $title = $t3[0];
    
    $d=str_between($video,'<div style="float:left;width:240px;"','<div style="clear:both;"');
    $t1=explode("<br />",$d);
    $cat=$t1[0];
    $cat = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$cat));
    $regia=$t1[1];
    $regia = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$regia));
    $actor=$t1[2];
    $actor = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$actor));
    $durata=$t1[3];
    $durata = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$durata));
    $imdb=$t1[4];
    $imdb = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$imdb));
    $p1=explode("</div>",$t1[5]);
    $premiera=$p1[0];
    $premiera = trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$premiera));
    $descriere = $p1[1];
	$descriere = preg_replace("/(<\/?)(\w+)([^>]*>)/e"," ",$descriere);
	$descriere = str_replace("&nbsp;","",$descriere);

    $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?'.$link.','.urlencode($title);

    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <cat>'.$cat.'</cat>
    <regia>'.$regia.'</regia>
    <actor>'.$actor.'</actor>
    <durata>'.$durata.'</durata>
    <imdb>'.$imdb.'</imdb>
    <premiera>'.$premiera.'</premiera>
    <annotation>'.$descriere.'</annotation>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
}

?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page+1).",";
if($search) { 
  $url = $url.$search; 
}
?>
<title>Next Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina urmatoare</annotation>
<image>image/right.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>

</channel>
</rss>
