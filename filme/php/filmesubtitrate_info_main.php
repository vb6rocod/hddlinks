#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
  setRefreshTime(1);
</onEnter>
<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>
<mediaDisplay name="photoView" 
	fontSize="16" 
	rowCount="7"
	columnCount="3"
	sideColorBottom="10:105:150"
	sideColorTop="10:105:150"
	itemYPC="25"
	itemXPC="5"
	itemGapXPC="1" 
	itemGapYPC="1"     
	rollItems="yes"
	drawItemText="yes" 
	itemOffsetXPC="5"
	itemImageWidthPC="0.1"
	itemImageHeightPC="0.1"
	imageBorderPC="1.5"        
	forceFocusOnItem="yes"
	itemCornerRounding="yes"
	sideTopHeightPC=20
	bottomYPC=80
	sliding=yes
	showHeader=no
	showDefaultInfo=no
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
	>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="75" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    2= adauga la favorite
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="80" widthPC="100" heightPC="15" fontSize="25" backgroundColor="10:105:150" foregroundColor="100:200:255">
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
    idx -= -21;
    if(idx &gt;= itemSize)
      idx = itemSize-1;
  }
  else
  {
    idx -= 21;
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
 url="http://127.0.0.1/cgi-bin/scripts/filme/php/filmesubtitrate_info_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
}
ret;
</script>
</onUserInput>
      		
</mediaDisplay>
<channel>
	<title>filmesubtitrate.info</title>
	<menu>main menu</menu>
<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    $text= preg_replace('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    $text= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    return $text;
}
function str_title($string){
	$pos=strlen(stristr($string, 'serial'));
	if ($pos == 0) {
		$pos=strlen(stristr($string, 'online'));
	}
	if ($pos <> 0) {
	$string=substr($string,0,-$pos);
	}
	$string=str_replace("&nbsp;","",$string);
	$string=str_replace("-","",$string);
	$string=str_replace("Subtitrat","",$string);
	$string=trim($string);
	return $string;
}
$host = "http://127.0.0.1/cgi-bin";
echo '
<item>
<title>Favorite</title>
<link>'.$host.'/scripts/filme/php/filmesubtitrate_info_fav.php</link>
<annotation>Lista serialelor favorite</annotation>
<mediaDisplay name="threePartsView"/>
</item>
';
//http://www.filmesubtitrate.info/seriale-online-subtitrate-in-romana
//http://www.seriale.filmesubtitrate.info/p/seriale-online-subtitrate-in-romana.html
//
$l="http://www.seriale.filmesubtitrate.info/p/seriale-online-subtitrate-in-romana.html";
$l="http://www.fsplay.net/p/seriale-online-subtitrate-in-romana.html";
//$new_file = "D://seriale.txt";
//$fh = fopen($new_file, 'w');
//fwrite($fh, $html);
//fclose($fh);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.fsplay.net");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html=curl_exec($ch);
  curl_close($ch);
  $html= decode_entities($html);
  
//$html = str_between($html,'<tr class="trxnoi">','<div class="footer1-wrapper">');
$a=explode('<tr class="trxnoi">',$html);
$html=$a[1];
	$videos=explode('href="',$html);
	unset($videos[0]);
	$videos=array_values($videos);
	foreach($videos as $video) {
		$t1=explode('"',$video);
		$link1=trim($t1[0]);
		$t3=explode(">",$video);
		$t4=explode("<",$t3[1]);
		$title=$t4[0];
		$title=preg_replace("/onlin(.*)|sub(.*)|seri(.*)|film(.*)/si","",$title);
		$title=trim(str_replace("&nbsp;","",$title));
		$link = $host."/scripts/filme/php/filmesubtitrate_info.php?query=".$link1.",".urlencode($title);
        if (($title <> "") && (strpos($link,"html") !==false)) {
        echo '
			<item>
			<title>'.$title.'</title>
			<link>'.$link.'</link>
            <title1>'.urlencode($title).'</title1>
            <link1>'.urlencode($link1).'</link1>
			</item>
		';
		}
	}
?>
</channel>
</rss>
