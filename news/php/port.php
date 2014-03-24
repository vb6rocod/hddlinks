#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  myID=1;
  titleArray = null;
  canalArray = null;
</onEnter>

<onRefresh>
  setRefreshTime(-1);
    url = "http://127.0.0.1/cgi-bin/scripts/news/php/program_tv.php?file="+myID;

    dlok = loadXMLFile(url);
    if (dlok != null)
    {
    	itemSize = getXMLElementCount("channel","item");
    	if(itemSize == 0)
    	  postMessage("return");
    	print("Item Size = ", itemSize);

    	pageTitle = getXMLText("channel", "title_pg");


    	count=0;
    	while(itemSize != 0)
    	{
    	  title     = getXMLText("channel","item",count,"title");
    	  canal        = getXMLText("channel","item",count,"canal");
    	  titleArray  = pushBackStringArray(titleArray, title);
    	  canalArray    = pushBackStringArray(canalArray, canal);

    	  count += 1;
    	  if (count == itemSize)
    	  {
    		  break;
    	  }
    	}
    	print("title array =", titleArray);
    	redrawDisplay();
    }
</onRefresh>
<onExit>
setRefreshTime(-1);
</onExit>
<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
    sideColorLeft="0:0:0"
	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="20"
	itemYPC="25"
	itemWidthPC="22"
	itemHeightPC="8"
	capXPC="20"
	capYPC="25"
	capWidthPC="22"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
    itemGap="0"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	sliding="no"
  menuXPC=5
  menuYPC=25
  menuWidthPC=14
  menuHeightPC=8
  menuPerPage=8
idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
		
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemSize;</script>
		</text>
		<text align="left" redraw="yes"
          lines="12" fontSize=15
		      offsetXPC=42 offsetYPC=30 widthPC=53 heightPC=48
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=10 offsetYPC=7 widthPC=10 heightPC=10>
  /usr/local/etc/www/cgi-bin/scripts/news/image/program_tv.png
		</image>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
  <onUserInput>
    <script>
ret = "false";
userInput = currentUserInput();
majorContext = getPageInfo("majorContext");
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
  annotation = " ";
  print("new idx: "+idx);
  setFocusItemIndex(idx);

  redrawDisplay();
  ret = "true";
}
else if((userInput == "two" || userInput == "enter" || userInput == "ENTR")  &amp;&amp; majorContext == "items")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/dolce_prog.php?file=" + getItemInfo(idx,"canal");
annotation = getURL(url_canal);
cancelIdle();
redrawDisplay();
ret = "true";
}
else if (userInput == "right" &amp;&amp; majorContext == "items")
{
  ret = "true";
}
else if (userInput == "right" &amp;&amp; majorContext == "menu")
{
  redrawDisplay();
  ret = "false";
}
else
{
annotation = " ";
redrawDisplay();
ret = "false";
}

      ret;
    </script>
  </onUserInput>
	<itemDisplay>
		<image offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
			<script>
				idx1 = getFocusItemIndex();
				idx2 = getQueryItemIndex();
				if (idx1 == idx2)
				{
					"image/IMAGE_NEWRSS_MENU_BTFOC.bmp";
				}
				else
				{
					"";
				}
			</script>
		</image>
 		<text offsetXPC=0 offsetYPC=25 widthPC=100 heightPC=50 fontSize=15 backgroundColor=-1:-1:-1 foregroundColor=200:200:200>
			<script>
                getStringArrayAt(titleArray , -1);
			</script>
		</text>
	</itemDisplay>
	</mediaDisplay>
	
	<item_template>
  <canal>
    <script>
      getStringArrayAt(canalArray , -1);
    </script>
  </canal>
		<mediaDisplay  name="threePartsView" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
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



<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function c($title) {
     $title = htmlentities($title);
     $title = str_replace("&ordm;","s",$title);
     $title = str_replace("&Ordm;","S",$title);
     $title = str_replace("&thorn;","t",$title);
     $title = str_replace("&Thorn;","T",$title);
     $title = str_replace("&icirc;","i",$title);
     $title = str_replace("&Icirc;","I",$title);
     $title = str_replace("&atilde;","a",$title);
     $title = str_replace("&Atilde;","I",$title);
     $title = str_replace("&ordf;","S",$title);
     $title = str_replace("&acirc;","a",$title);
     $title = str_replace("&Acirc;","A",$title);
     $title = str_replace("&oacute;","o",$title);
     $title = str_replace("&amp;", "&",$title);
     return $title;
}
$id = $_GET["file"];
$link="http://port.ro/pls/tv/tv.prog";
$html = file_get_contents($link);
$t1=explode('chNumberCombo',$html);
$t2=explode('<optgroup',$t1[0]);
if ($id==0) {
$html=$t1[0];
$pg="Toate";
} else {
$html=$t2[$id];
$a=explode('label="',$html);
$b=explode('"',$a[1]);
$pg=$b[0];
}
echo '
<submenu>
<title>Toate</title>
  <onClick>
    titleArray = null;
    canalArray = null;
    urlArray = null;
    myID = 0;
    setRefreshTime(1);
  </onClick>
</submenu>
';
$h=$t1[0];
$videos=explode('label="',$h);
unset($videos[0]);
$videos = array_values($videos);
$n=1;
foreach($videos as $video) {
$b=explode('"',$video);
$c=c($b[0]);
echo '
<submenu>
<title>'.$c.'</title>
  <onClick>
    titleArray = null;
    canalArray = null;
    urlArray = null;
    myID = '.$n.';
    setRefreshTime(1);
  </onClick>
</submenu>
';
$n++;
}
?>
<channel>
	<title>
	  <script>pageTitle;</script>
	</title>

<itemSize>
	<script>itemSize;</script>
</itemSize>

</channel>
</rss>
