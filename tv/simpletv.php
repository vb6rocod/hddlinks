#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<?php
echo '
<rss version="2.0">
<script>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";

  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";
  storagePath_playlist    = storagePath + "playlist.dat";

  error_info          = "";
</script>
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
	itemWidthPC="80"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="80"
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="55" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    2= Add to favorite, 4/6 jump +- 100, 7/9 jump +- 500
		</text>
  	<text redraw="yes" offsetXPC="75" offsetYPC="12" widthPC="20" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
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
titlu="";
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
  "true";
}
else if(userInput == "nine" || userInput == "9")
{
    idx = Integer(getFocusItemIndex());
    idx -= -500;
    if(idx &gt;= itemCount)
    idx = itemCount-1;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "seven" || userInput == "7")
{
    idx = Integer(getFocusItemIndex());
    idx -= 500;
    if(idx &lt; 0)
      idx = 0;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "six" || userInput == "6")
{
    idx = Integer(getFocusItemIndex());
    idx -= -100;
    if(idx &gt;= itemCount)
    idx = itemCount-1;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "four" || userInput == "4")
{
    idx = Integer(getFocusItemIndex());
    idx -= 100;
    if(idx &lt; 0)
      idx = 0;

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if (userInput == "two" || userInput == "2")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/tv/php/ohlulz_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 ret="true";
}
redrawDisplay();
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
	<title>Playlist from database.eu.pn</title>
	<menu>main menu</menu>
';
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$link="http://www.database.eu.pn/index.php/database/exportsimpletv";
$link="http://www.vlcplaylist.eu.pn/index.php/database/exportsimpletv";
$link="http://www.oneplaylist.eu.pn/index.php/database/exportsimpletv";
$html=file_get_contents($link);

$html=str_between($html,'style="color','</div>');
//echo $html;
$video = explode('<br />', $html);
$c=count($video);
//echo $c."<BR>";
//3873
for ($i=0;$i<$c;$i++) {
//for ($i=1500;$i<2001;$i++) {

  $rtmp="";
  if(strtoupper(substr($video[$i], 0, 7)) === "#EXTINF") {
   $t1=explode(",",$video[$i]);
   $title=trim($t1[1]);
   $next = $video[$i + 1];
   if (strpos($next,"rtmp-raw=") === false) {
    if (preg_match("/http|mms/i",$next)) {
     if (strpos($next,".m3u8") === false) {
       $link=trim($next);
       if (preg_match("/playpath|swfUrl|pageUrl/i",$link)) $link="";
       $rtmp=$link;
     }
     if (preg_match("/mms/i",$link))
       $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
    }
   } else {
     $t1=explode("rtmp-raw=",$next);
     $l=trim(str_replace("live=1","",$t1[1]));
     $t1=explode(" ",$l);
     $rtmp = $t1[0];
     $opt=substr($l,strlen($rtmp));
     $opt=preg_replace("/swfurl=/i","-W ",$opt);
     $opt=preg_replace("/playpath=/i","-y ",$opt);
     $opt=preg_replace("/app=/i","-a ",$opt);
     $opt=preg_replace("/pageUrl=/i", "-p ",$opt);
     $opt=preg_replace("/token=/i", "-T ",$opt);
     $opt=preg_replace("/swfsize=/i","-x ",$opt);
     $opt=preg_replace("/swfhash=/i","-w ",$opt);
     $opt=str_replace("<playpath>"," -y ",$opt);
     $opt=str_replace("<swfUrl>"," -W ",$opt);
     $opt=str_replace("<pageUrl>"," -p ",$opt);
     //

     $opt="Rtmp-options:".trim($opt);
     $opt=str_replace(" ","%20",$opt);
     $link = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,".$opt.",".$rtmp;
   }
    $title=urlencode($title);
    $title=str_replace("%28","(",$title);
    $title=str_replace("%29",")",$title);
    $title=str_replace("%3A",":",$title);
    $title=str_replace("+"," ",$title);

    $title=urldecode($title);
    $title=str_replace(">>BAN THIS<<","",$title);
    //$title=str_replace("+","_",$title);
   if (strpos($title,"/") !== false) $rtmp="";
   if (strpos($title,">") !== false) $rtmp="";
   if (strpos($title,"<") !== false) $rtmp="";
   if (strpos($link,">") !== false) $rtmp="";
   if (strpos($link,"<") !== false) $rtmp="";
   if ($rtmp) {
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    titlu="'.$rtmp.'";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>'.$rtmp.'</annotation>
    <link1>'.urlencode($link).'</link1>
    <title1>'.urlencode($title).'</title1>
    </item>
    ';
  }
  }
}

?>
</channel>
</rss>
