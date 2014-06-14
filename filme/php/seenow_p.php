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
	itemWidthPC="50"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="50"
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
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
		image/movies.png
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
	<title>seenow</title>
	<menu>main menu</menu>
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$host = "http://127.0.0.1/cgi-bin";
$link="http://www.seenow.ro/trailere";
$title="Toate filmele";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=,'.$link.','.urlencode($title).'</link>
    <annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/filme-hollywood-25-pagina-";
$title="Filme Hollywood";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
    <annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/filme-premium-27-pagina-";
$title="Filme Premium";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/filmbox-filme-128-pagina-";
$title="Filmbox Filme";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/filmbox-seriale-129-pagina-";
$title="Filmbox Seriale";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/filme-romanesti-23-pagina-";
$title="Filme Romanesti";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link = "http://www.seenow.ro/disney-movies-on-demand-5187-pagina-";
$title= "Disney Movies";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
    <annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/axn-now-447-pagina-1";
$title="AXN Now";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/desene-animate-3032-pagina-";
$title="Desene Animate";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/lifestyle-38-pagina-";
$title="Lifestyle";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/bollywood-26-pagina-";
$title="Bollywood";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/documentare-2701-pagina-";
$title="Documentare (FreeZone)";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/documentare-17-pagina-";
$title="Documentare";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/emisiuni-tv-78-pagina-";
$title="Emisiuni TV";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
$link="http://www.seenow.ro/emisiuni-tv-2697-pagina-";
$title="Emisiuni TV (FreeZone)";
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$host.'/scripts/filme/php/seenow_f.php?query=1,'.$link.','.urlencode($title).'</link>
	<annotation>'.$title.'</annotation>
	<mediaDisplay name="threePartsView"/>
	</item>
	';
?>
</channel>
</rss>
