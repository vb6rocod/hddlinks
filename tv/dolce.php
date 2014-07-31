#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<onEnter>
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
  optionsPath = cachePath + "livebuf.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    buf = "60000";
  }
  else
  {
    buf = getStringArrayAt(optionsArray, 0);
  }
  startitem = "middle";
  setRefreshTime(1);
</onEnter>
 <onExit>
  arr = null;
  arr = pushBackStringArray(arr, buf);
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
	itemWidthPC="20"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="20"
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
  	<text align="left" redraw="yes" offsetXPC="25" offsetYPC="15" widthPC="60" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi 2 pentru modificare buffer. Buffer curent: " + buf;</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="left" redraw="yes"
          lines="2" fontSize=15
		      offsetXPC=30 offsetYPC=50 widthPC=65 heightPC=10
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(acum); acum;</script>
		</text>
		<text align="left" redraw="yes"
          lines="2" fontSize=15
		      offsetXPC=30 offsetYPC=60 widthPC=65 heightPC=10
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(next); next;</script>
		</text>
		<image  redraw="yes" offsetXPC=52 offsetYPC=25 widthPC=25 heightPC=20>
  /usr/local/etc/www/cgi-bin/scripts/tv/image/dolce.jpg
		</image>
		
		<image  redraw="yes" offsetXPC=10 offsetYPC=7 widthPC=10 heightPC=10>
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
                      img = getItemInfo(idx,"image");
                      acum = getItemInfo(idx,"acum");
                      next = getItemInfo(idx,"next");
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
  annotation = " ";
  setFocusItemIndex(idx);
	setItemFocus(0);
  redrawDisplay();
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
  <title>Dolce TV</title>
<!-- Dolce TV -->
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function enc($string) {
  $local3="";
  $arg1=strlen($string);
  $arg2="mediadirect";
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
/*
$s="http://index.mediadirect.ro/getUrl?publisher=2";
$h = file_get_contents($s);
$t1=explode('server=',$h);
$t2=explode('&',$t1[1]);
$serv=$t2[0];
if ($serv == "") {
  $serv="fms1.mediadirect.ro";
}
*/
$link="http://www.dolcetv.ro/tv-live";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.dolcetv.ro");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  $html=curl_exec($ch);
  curl_close($ch);
if (strpos($html,"class") === false) {
$new_file="D://dolce.gz";
$new_file="/tmp/dolce.gz";
$fh = fopen($new_file, 'w');
fwrite($fh, $html);
fclose($fh);
$zd = gzopen($new_file, "r");
$html = gzread($zd, filesize($new_file));
gzclose($zd);
}
$html=str_replace("\\","",$html);
//echo $html."<br>";

//rtmpe://fms38.mediadirect.ro/live3?id=10668839&publisher=2/moozhd
$videos = explode('<div class="station_program_cell', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
	$t1 = explode('href="',$video);
	$t2 = explode('"',$t1[1]);
	$link="http://www.dolcetv.ro".$t2[0];
    $image = str_between($video,'background-image:url(',')');
    $title = str_between($video,'class="post">','<');
    $v=str_replace("u015e","S",$video);
    $v=str_replace("u015f","s",$v);
    $v=str_replace("u0163","t",$v);
    $v=str_replace("u0162","T",$v);
    $v=str_replace("u0103","a",$v);
    $v=str_replace("u0102","A",$v);
    $v=str_replace("u00a0"," ",$v);
    $v=str_replace("u00e2","a",$v);
    $v=str_replace("u00ce","i",$v);
    $acum = str_between($v,'acum">','<');
    $next = str_between($v,'next">','<');
    if (!preg_match("/uefa/i",$title)) {
    /*
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$host.'/scripts/tv/php/dolce_tv_link.php?file='.$link.'";
    url1=getUrl(url);
    cancelIdle();
    if (url1 != null &amp;&amp; url1 != "")
    {
    movie="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream," + url1;
    playItemUrl(movie,10);
    }
    else
    {
    playItemURL(-1, 1);
    }
    </script>
    </onClick>
    <image>'.$image.'</image>
    <acum>'.$acum.'</acum>
    <next>'.$next.'</next>
    <media:thumbnail url="'.$image.'" />
    </item>
    ';
    */
     echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     url="'.$host.'/scripts/tv/php/dolce_tv_link.php?file='.$link.'," + buf;
     url1=getUrl(url);
     movie="http://127.0.0.1/cgi-bin/scripts/util/translate2.cgi?stream," + url1;
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
    <image>'.$image.'</image>
    <acum>'.$acum.'</acum>
    <next>'.$next.'</next>
    <media:thumbnail url="'.$image.'" />
     </item>
     ';
    }
}

?>
<!-- end Dolce TV -->
</channel>
</rss>
