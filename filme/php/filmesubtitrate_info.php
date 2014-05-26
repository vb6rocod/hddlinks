#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $pagetitle = trim(urldecode($queryArr[1]));
   $pagetitle=str_replace(urldecode("%C2%A0"),"",$pagetitle);
}
?>
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

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="80" widthPC="100" heightPC="15" fontSize="20" backgroundColor="10:105:150" foregroundColor="100:200:255">
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
ret;
</script>
</onUserInput>
      		
</mediaDisplay>
<channel>
	<title><?php echo $pagetitle; ?></title>
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
$pagelink=$link;
//$html = file_get_contents($link);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.fsplay.net");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html=curl_exec($ch);
  curl_close($ch);
  $html= decode_entities($html);
  //echo $html;
$pageimage=str_between($html,'<link rel="image_src" href="','"');
if ($pageimage=="") {
	$pageimage=str_between($html,'border="0" height="240" src="','?');
}
if ($pageimage=="") {
	$pageimage="image/movies.png";
}
$pageimage = str_replace("https","http",$pageimage);
$serial_file=substr(strrchr($link,"/"),1);
$serial_file=ltrim($serial_file,"seriale-online-");
$pos=strlen(stristr($serial_file, '-'));
if ($pos >= 1) {
	$serial=substr($serial_file,0,-$pos);
} else {
	$serial=substr($serial_file,0,-1*(strlen($serial_file)-5));
}
$t=explode(" ",$pagetitle);
$s="/";
for ($i=0;$i<count($t);$i++) {
 if (($t[$i] <> "") && (strlen($t[$i])>1) &&(!preg_match("/the|2010|2011|2012/i",$t[$i])))
    $s=$s."".$t[$i]."|";
}
$s=substr($s,0,-1);
$s=$s."/i";
//echo $s;
//10-things
if ($serial=="10") $serial="10-things";
if ($serial=="greys") $serial="grey";
//if (!$serial) $serial="-";
$find="/".$serial."|nobels"."/";
//echo $find;
$a1=explode("<tbody>",$html);
$c=count($a1);
//echo $c;
//if ($c==1) $c=2;
$m=0;
for ($k=1;$k<$c;$k++) {
$a2=explode("</tbody>",$a1[$k]);
$html=$a2[0];
$videos=explode('<li',$html);
unset($videos[0]);
$videos=array_values($videos);
foreach($videos as $video) {
    $video=str_replace('<span class="Apple-style-span" style="font-size: large;">','',$video);
	$t1=explode('href="',$video);
	$t2=explode('"',$t1[1]);
	$link=trim($t2[0]);

	$t3=explode(">",$t1[1]);
	$t4=explode("<",$t3[1]);
	$title=$t4[0];
	//echo $link."<BR>".$title."<BR>";
	//$title=preg_replace("/onlin(.*)|sub(.*)|seri(.*)|film(.*)/si","",$title);
	$title=trim(str_replace("&nbsp;","",$title));
	//case 24 s6 ep 2
	if ($title == "") {
		$t1=explode('href="',$video);
		$t2=explode('"',$t1[2]);
		$link=trim($t2[0]);
		$t3=explode(">",$t1[2]);
		$t4=explode("<",$t3[1]);
		$title=trim($t4[0]);
		$title=str_replace("&nbsp;","",$title);
	}
	//$title=preg_replace("/onlin(.*)|sub(.*)|seri(.*)|film(.*)/si","",$title);
	$title=trim(str_replace("&nbsp;","",$title));
	//if ((preg_match($find, $link) !== false) && ($link <> $queryArr[0]) && ($title <> "")  && (preg_match($s,$link))){
	//if (preg_match($s,$link)) {
 if ($title) {
	$m++;
    $link=str_replace("www.seriale.filmesubtitrate.info","www.fsplay.net",$link);
    $link=str_replace("www.filmesubtitrate.info","www.fsplay.net",$link);
		$link="http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file=".$link.",".urlencode($title);
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
 		<media:thumbnail url="'.$pageimage.'" />
 		<mediaDisplay name="threePartsView"/>
    </item>
    ';
	}
}
}
if ($c==1) {
$m=0;
$html=str_between($html,'div class="contnew','<div class');
$videos=explode('<li',$html);
unset($videos[0]);
$videos=array_values($videos);
foreach($videos as $video) {
    $video=str_replace('<span class="Apple-style-span" style="font-size: large;">','',$video);
	$t1=explode('href="',$video);
	$t2=explode('"',$t1[1]);
	$link=trim($t2[0]);

    /*
    $t1=explode("<span",$video);
	$t2=explode(">",$t1[1]);
	$t4=explode("<",$t2[1]);
	$title=$t4[0];
	*/
	$t3=explode(">",$t1[1]);
	$t4=explode("<",$t3[1]);
	$title=$t4[0];
	//echo $link."<BR>".$title."<BR>";
	//$title=preg_replace("/onlin(.*)|sub(.*)|seri(.*)|film(.*)/si","",$title);
	$title=trim(str_replace("&nbsp;","",$title));
	//case 24 s6 ep 2
	if ($title == "") {
		$t1=explode('href="',$video);
		$t2=explode('"',$t1[2]);
		$link=trim($t2[0]);
		$t3=explode(">",$t1[2]);
		$t4=explode("<",$t3[1]);
		$title=trim($t4[0]);
		$title=str_replace("&nbsp;","",$title);
	}
	//$title=preg_replace("/onlin(.*)|sub(.*)|seri(.*)|film(.*)/si","",$title);
	$title=trim(str_replace("&nbsp;","",$title));
	//if ((preg_match($find, $link) !== false) && ($link <> $queryArr[0]) && ($title <> "")  && (preg_match($s,$link))){
	//if (preg_match($s,$link)) {
	if ($title && preg_match("/ep|part/i",$link)) {
	$m++;
    $link=str_replace("www.seriale.filmesubtitrate.info","www.fsplay.net",$link);
    $link=str_replace("www.filmesubtitrate.info","www.fsplay.net",$link);
		$link="http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file=".$link.",".urlencode($title);
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
 		<media:thumbnail url="'.$pageimage.'" />
 		<mediaDisplay name="threePartsView"/>
    </item>
    ';
	}
}
}
if ($m < 1) {
   $link="http://127.0.0.1/cgi-bin/scripts/filme/php/filme_link.php?file=".$pagelink.",".urlencode($pagetitle);
    echo '
    <item>
    <title>'.$pagetitle.'</title>
    <link>'.$link.'</link>
 		<media:thumbnail url="'.$pageimage.'" />
 		<mediaDisplay name="threePartsView"/>
    </item>
    ';
}
?>
</channel>
</rss>
