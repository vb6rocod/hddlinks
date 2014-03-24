#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$search = $_GET["query"];
?>
<rss version="2.0">
<onEnter>
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "iplay_b.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    buf = "60000";
    subtitle = "on";
  }
  else
  {
    buf = getStringArrayAt(optionsArray, 0);
    subtitle = getStringArrayAt(optionsArray, 1);
  }
  if (subtitle == " " || subtitle == "" || subtitle == null)
    subtitle = "on";
  startitem = "middle";
  setRefreshTime(1);
</onEnter>
<onExit>
  arr = null;
  arr = pushBackStringArray(arr, buf);
  arr = pushBackStringArray(arr, subtitle);
  print("arr=",arr);

  writeStringToFile(optionsPath, arr);
</onExit>

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

		<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=50>
         <script>print(image); image;</script>
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi: 2= modificare buffer. Buffer: " + buf + "  3= Subtitrare on/off. Subtitrare: " + subtitle;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="60" offsetYPC="80" widthPC="30" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(an); an;</script>
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
					  image = getItemInfo(idx, "image");
					  an =  getItemInfo(idx, "an");
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

  "true";
}
else if (userInput == "two" || userInput == "2")
{
		if (buf == "60000")
           buf = "40000";
		else if (buf == "40000")
           buf = "20000";
        else if (buf == "20000")
          buf = "10000";
        else if (buf == "10000")
          buf = "8000";
        else if (buf == "8000")
          buf = "6000";
        else if (buf == "6000")
          buf = "4000";
        else if (buf == "4000")
          buf = "2000";
        else if (buf == "2000")
          buf = "1000";
        else if (buf == "1000")
          buf = "500";
        else if (buf == "500")
          buf = "400";
        else if (buf == "400")
          buf = "300";
        else if (buf == "300")
          buf = "200";
        else if (buf == "200")
          buf = "100";
        else if (buf == "100")
          buf = "0";
        else if (buf == "0")
          buf = "60000";
        else
		 buf = "60000";
  ret = "true";
}
else if (userInput == "three" || userInput == "3")
{
if (subtitle == "off")
  subtitle = "on";
else if (subtitle == "on")
  subtitle = "off";
else
  subtitle = "on";
ret = "true";
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
	<title><?php echo $search; ?></title>
	<menu>main menu</menu>


<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function xml_fix($string) {
    $v=str_replace("\u015e","S",$string);
    $v=str_replace("\u015f","s",$v);
    $v=str_replace("\u0163","t",$v);
    $v=str_replace("\u0162","T",$v);
    $v=str_replace("\u0103","a",$v);
    $v=str_replace("\u0102","A",$v);
    $v=str_replace("\u00a0"," ",$v);
    $v=str_replace("\u00e2","a",$v);
    $v=str_replace("\u021b","t",$v);
    $v=str_replace("\u201e","'",$v);
    $v=str_replace("\u201d","'",$v);
    $v=str_replace("\u0219","s",$v);
    $v=str_replace("\u00ee","i",$v);
    $v=str_replace("\u00ce","I",$v);
    $v=str_replace("\u2019","'",$v);
    $v=str_replace("\/","/",$v);
    return $v;
}
function enc($string) {
  $local3="";
  $arg1=strlen($string);
  $arg2="equinox2";
  $arg2="pwodoiucvbnkp";
  $l_arg2=strlen($arg2);
  $local4=0;
  while ($local4 < $arg1) {
    $m1=ord($string[$local4]);
    $m2=ord($arg2[$local4 % $l_arg2]);
    $local3=$local3.chr($m1 ^ $m2);
    $local4++;
  }
  return $local3;
}
//print_item($title,$rtmp,$y,$sub,$id,$image,$year);
function print_item($title,$rtmp,$mp4,$sub,$id,$img,$y) {
    $f = "/usr/local/bin/home_menu";
    $title=xml_fix($title);
    if (file_exists($f)) {
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url2="http://127.0.0.1/cgi-bin/scripts/util/iplay1_xml.php?file='.$rtmp.','.$mp4.','.$sub.'" + "," + buf + "," + subtitle;
    url1=getURL(url2);
    url="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream," + url1;
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
    </script>
    </onClick>
    <movie>'.$id.'</movie>
    <image>'.$img.'</image>
    <an>'.$y.'</an>
  </item>
  ';
  } else {
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url2="http://127.0.0.1/cgi-bin/scripts/util/iplay1_xml.php?file='.$rtmp.','.$mp4.','.$sub.'" + "," + buf + "," + subtitle;
    url1=getURL(url2);
    url="http://127.0.0.1/cgi-bin/scripts/util/translate1.cgi?stream," + url1;
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    </script>
    </onClick>
    <movie>'.$id.'</movie>
    <image>'.$img.'</image>
    <an>'.$y.'</an>
  </item>
  ';
  }
}
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";

$search = str_replace(' ','+',$search);
//http://videobox.iplay.ro/search?q=two
  $link="http://videobox.iplay.ro/search?q=".$search;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
/////////////////
$videos = explode('<div class="movieCell ">', $html);

unset($videos[0]);
$videos = array_values($videos);
$n=0;
foreach($videos as $video) {
    $t1 = explode('id="', $video);
    $t2 = explode('"', $t1[1]);
    $link = $t2[0];
    $link=str_replace(" ","+",$link);   //????
    $t1=base64_decode($link);
    $link=enc($t1);
    $link=str_replace("\/","/",$link);

    $mp4=urlencode(str_between($link,'stream":"','"'));
    $sub=str_between($link,'subtitle":"','"');
    $sub=str_replace(" ","%20",$sub);
    $sub=str_replace("\'","%27",$sub);
    $rtmp=str_between($link,'server":"','"');


    $t1 = explode('src="', $video);
    $t2 = explode('"', $t1[1]);
    $image = $t2[0];
    //http://videobox.iplay.ro/media/movie/cover/123x182/1573.jpg
    $t = substr(strrchr($image, "/"), 1);
    $t1=explode(".",$t);
    $id=$t1[0];

    $title = trim(str_between($video,'movieCellTitle">','<'));
    if (strpos($sub,"default.xml") !== false) $title=$title." (*)";
    $year = trim(str_between($video,'movieCellYear">','<'));

        print_item($title,$rtmp,$mp4,$sub,$id,$image,$year);
    $n++;
}

?>
</channel>
</rss>
