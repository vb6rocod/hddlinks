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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="75" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    2= adauga la favorite
		</text>
  	<text redraw="yes" offsetXPC="76" offsetYPC="12" widthPC="20" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
  image/tv_radio.png
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
  redrawDisplay();
  "true";
}
else if (userInput == "two" || userInput == "2")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/tv/php/ohlulz_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
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
	<title>TV Live - rtmpGui</title>
	<menu>main menu</menu>
';
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function html_to_utf8 ($data)
    {
    return preg_replace("/\\&\\#([0-9]{3,10})\\;/e", '_html_to_utf8("\\1")', $data);
    }

function _html_to_utf8 ($data)
    {
    if ($data > 127)
        {
        $i = 5;
        while (($i--) > 0)
            {
            if ($data != ($a = $data % ($p = pow(64, $i))))
                {
                $ret = chr(base_convert(str_pad(str_repeat(1, $i + 1), 8, "0"), 2, 10) + (($data - $a) / $p));
                for ($i; $i > 0; $i--)
                    $ret .= chr(128 + ((($data % pow(64, $i)) - ($data % ($p = pow(64, $i - 1)))) / $p));
                break;
                }
            }
        }
        else
        $ret = "&#$data;";
    return $ret;
    }
/*
$link="http://apps.ohlulz.com/rtmpgui/list.xml";
//$html=file_get_contents($link);
$process = curl_init($link);
curl_setopt($process, CURLOPT_HTTPGET, 1);
curl_setopt($process, CURLOPT_RETURNTRANSFER,1);
curl_setopt($process,CURLOPT_CONNECTTIMEOUT,20);
$html = curl_exec($process);
curl_close($process);
$videos=explode("<stream>",$html);
*/
//if (strpos($html,"<stream>") === false) {
//if (count($videos) < 500) {
  $link="http://hdforall.googlecode.com/files/3-11-2012.xml";
  $html=file_get_contents($link);
//}
//$html=file_get_contents("H:/BB Skin V2/new/channels.xml");
$baseurl="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,";

$videos=explode("<stream>",$html);
//$videos=explode("<item>",$html);
unset($videos[0]);
$videos = array_values($videos);
$n=0;
foreach($videos as $video) {
$video=str_replace("<![CDATA[","",$video);
$video=str_replace("]]>","",$video);
$opt="";
$title=str_between($video,"<title>","</title>");
$title=trim(str_replace("'","",$title));
//$title = str_replace("&amp;","&",$title);
//$title=html_entity_decode($title,ENT_QUOTES, "UTF-8");
$title=html_to_utf8($title);
//$title=html_entity_decode($title,ENT_QUOTES, "UTF-8");
//$title=htmlentities($title, ENT_QUOTES, "UTF-8");
//$title=htmlspecialchars_decode($title, ENT_NOQUOTES);
$swf=trim(str_between($video,'<swfUrl>','</swfUrl>'));
$link=trim(str_between($video,"<link>","</link>"));
$page=trim(str_between($video,"<pageUrl>","</pageUrl>"));
$playpath=trim(str_between($video,"<playpath>","</playpath>"));
$adv = trim(str_between($video,"<advanced>","</advanced>"));
      if (($swf <> "") || ($page <> "") || ($playpath <> "") || ($adv <> "")) {
        $opt="Rtmp-options:";
        if ($swf <> "") {
          $opt=$opt."-W%20".$swf."%20";
        }
        if ($playpath <> "") {
          $opt=$opt."-y%20".$playpath."%20";
        }
        if ($page <> "") {
          $opt=$opt."-p%20".$page;
        }
        if ($adv <> "") {
          $opt=$opt."%20".str_replace(" ","%20",$adv);
        }
      }
if (($title <> "") && (strpos($link,"<") === false) && !preg_match("/filmon|wilmaa|ustream|tvsector/i",$opt)) {
$n++;
$link1=urlencode($baseurl.$opt.",".$link);
//echo $title."<br>";
$title = urlencode($title);
$title = str_replace("+"," ",$title);
$title = str_replace("%2B","+",$title);
$title = str_replace("%28","(",$title);
$title = str_replace("%29",")",$title);
$title = str_replace("%26","&",$title);
$title = str_replace("%3B",";",$title);
$title = str_replace("%2F","/",$title);
$title = str_replace("%23","#",$title);
$title = str_replace("%5B","[",$title);
$title = str_replace("%5D","]",$title);
//if ($n > 0) {
if (strpos($title,"%") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$baseurl.$opt.','.$link.'";
    titlu="'.$link.'";
    cancelIdle();
    playItemUrl(url,10);
    </script>
    </onClick>
    <annotation>'.$link.' - '.$playpath.'</annotation>
    <link1>'.$link1.'</link1>
    <title1>'.urlencode($title).'</title1>
    </item>
    ';
}
}
}
?>
</channel>
</rss>
