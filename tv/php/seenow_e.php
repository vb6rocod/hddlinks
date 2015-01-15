#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $page = $queryArr[0];
   $search = urldecode($queryArr[1]);
   $tit = urldecode($queryArr[2]);
}
$cookie="/tmp/seenow.dat";
$filename="/usr/local/etc/dvdplayer/seenow_cont.dat";
if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a2=explode("|",$c);
  $a1=str_replace("?","@",$a2[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a2[1]);
if (!file_exists($cookie)) {
  $l="http://www.seenow.ro/login";
  $post="email=".$user."&password=".$pass."&submit=Login";
  //echo $post;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 0.5; en-us) AppleWebKit/522+ (KHTML, like Gecko) Safari/419.3');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,$l);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
}
}
$host = "http://127.0.0.1/cgi-bin";
$search1=str_replace("&","|",$search);
$link=$search.$page;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_REFERER,"http://www.seenow.ro/");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t1=explode('"',$html);
if ( count($t1) < 2 )
	$html = base64_decode($html);

  $t1=explode('textNav floatR',$html);
  if (sizeof($t1)<2) $t1=explode('class="floatR font20 grey',$html);
if (sizeof($t1)>1){
  $t2=explode(">",$t1[1]);
  $pg='Pagina curenta: '.$t2[1];
}
  $t1=explode('floatR textNav',$html);
  if (sizeof($t1)<2) $t1=explode('class="floatR font20 grey',$html);
if (sizeof($t1)>1){
  $t2=explode(">",$t1[1]);
  if ($t2[1]) $available=ucfirst(str_replace("-",".",strtolower($t2[1])));
  $available=str_replace("</p","",$available);
}
?>
<rss version="2.0">
<onEnter>
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "rec.dat";
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
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    3=Re-Logon
		</text>
  	<text align="right" offsetXPC="55" offsetYPC="3" widthPC="40" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"<?php echo $available; ?>" + sprintf("%s "," ");</script>
		</text>
  	<text align="left" redraw="yes" offsetXPC="6" offsetYPC="15" widthPC="60" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi 2 pentru modificare buffer. Buffer curent: " + buf;</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=30>
		<script>print(img); img;</script>
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="254:254:254">
    <script>annotation;</script>
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
					  annotation = getItemInfo(idx, "title");
					  img = getItemInfo(idx,"image");
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
  redrawDisplay();
  ret = "true";
}
else if (userInput == "three" || userInput == "3")
{
 url=geturl("http://127.0.0.1/cgi-bin/scripts/tv/php/seenow_del.php");
 jumptolink("logon");
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
	<logon>
	<link>
	<script>
	url="/usr/local/etc/www/cgi-bin/scripts/tv/seenow.rss";
	url;
	</script>
	</link>
	</logon>
  <channel>

    <title><?echo $tit; ?></title>
<?php
if($page > 1) { ?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page-1).",";
if($search) {
  $url = $url.urlencode($search).",".urlencode($tit);
}
?>
<title>Previous Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina anterioară</annotation>
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
function search_arr($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search_arr($subarray, $key, $value));
        }
    }

    return $results;
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



$html=str_replace("premiumBackground","itemBackground",$html);
$html=str_replace("premiumThumb","itemsThumb",$html);

$html=str_replace("floatL trailerHref","itemBackground",$html);
$html=str_replace("trailerItem","itemsThumb",$html);
$html=str_replace('title="','><>',$html);
$html=str_replace('" data-trailer-Id="','<',$html);
$html=str_replace('class="trailerDiv','a class="floatL',$html);

$html=str_replace('class="tvSpan','class="itemBackground',$html);
$html=str_replace("canaletvThumb","itemsThumb",$html);
$html=str_replace('floatL ccsSprites canaletvRightArrow','class="floatL ccsSprites RightArrow',$html);

$html=str_replace('radioA','class="itemBackground',$html);
$html=str_replace("radioThumb","itemsThumb",$html);
$html=str_replace('" rel="','<',$html);
$html=str_replace('floatL ccsSprites radioRight','class="floatL ccsSprites RightArrow',$html);


$h_var1= str_between($html,'class="floatL itemsThumb">','class="floatL ccsSprites RightArrow');
if ($h_var1)
  $html=$h_var1;
else {
  $html=str_between($html,'list: [',']');
  $html=xml_fix($html);
}
if ($h_var1)
 $videos = explode('a class="floatL', $html);
else
 $videos=explode('item_id":',$html);
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
 if ($h_var1) {
  $t1=explode('href="',$video);
  $t2=explode('"',$t1[1]);
  $l=$t2[0];
  $rest = substr($l, 0, -2);
  $id = substr(strrchr($rest, "-"), 1);
  if (strpos($video,'idpl') !== false)
	$id = str_between($video,'id="idpl','"');
//  if (strpos($video,' data-id') !== false)
//	$id = str_between($video,' data-id="','"');

  $t1=explode('src="',$video);
  $t2=explode('"',$t1[1]);
  $image=$t2[0];

  $t1=explode('class="itemBackground',$video);
  $t2=explode(">",$t1[1]);
  $t3=explode("<",$t2[2]);
  $title=$t3[0];
} else {
  $t1=explode('url":"',$video);
  $t2=explode('"',$t1[1]);
  $t3=$t2[0];
  $t4=explode("#",$t3);
  $l=$t4[0];
  $rest = substr($l, 0, -2);
  $id = substr(strrchr($rest, "-"), 1);
  if (strpos($video,'idpl') !== false)
	$id = str_between($video,'id="idpl','"');
//  if (strpos($video,' data-id') !== false)
//	$id = str_between($video,' data-id="','"');

  $t1=explode('thumbnail_path":"',$video);
  $t2=explode('"',$t1[1]);
  $image=$t2[0];

  $t1=explode('item_title":"',$video);
  //$t2=explode(">",$t1[1]);
  $t3=explode('"',$t1[1]);
  $title=$t3[0];
  $title=str_replace('"','',$title);
}
  $rest = substr($search1, 0, -8);
  $pg_id = substr(strrchr($rest, "-"), 1);
  if (! is_numeric($id) ) {
  $l="http://www.seenow.ro/smarttv/placeholder/list/id/".$pg_id."/start/0/limit/999";
  $h=file_get_contents($l);
  $p=json_decode($h,1);

  $items=$p['items'];
  $items = array_values($items);
  $h=search_arr($items, 'thumbnail', $image);
  if ($h) {
		$id="";
		$arr=$h[0];
		if (array_key_exists("willStartPlayingUrl",$arr)) {
			$t1=$arr['willStartPlayingUrl'];
			$t2=explode('/',$t1);
			$id=$t2[sizeof($t2)-1];
		} else
		if (array_key_exists("streamUrl",$arr)) {
			$t1=$arr['streamUrl'];
			$t2=explode('=',$t1);
			$id=$t2[sizeof($t2)-1];
		}
  }
}
  if (! is_numeric($id) ) {
    if ($h_var1)
    $t0 = explode('href="',$video);
    else
    $t0 = explode('url":"',$video);
    $t1 = explode('"', $t0[1]);
    $l = "http://www.seenow.ro".$t1[0];
    $link = substr($l, 0, -1);
	$rest = substr($l, 0, -2);
	$id = substr(strrchr($rest, "-"), 1);
	$link=$host."/scripts/tv/php/seenow_e.php?query=1,".urlencode($link).",".urlencode($title);
	echo '
	<item>
	<title>'.$title.'</title>
	<link>'.$link.'</link>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
  } else {
	//$link="tvrplus_e_link.php?file=".urlencode($id)."&pg_id=".urlencode($pg_id)."&title=".urlencode($title);
    $f = "/usr/local/bin/home_menu";
     echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     url="'.$host.'/scripts/tv/php/seenow_e_link.php?file='.$id.','.$pg_id.','.urlencode($title).'," + buf;
     movie=getUrl(url);
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
        ';
        if (file_exists($f)) {
        echo '
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
        ';
        } else {
        echo '
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
        ';
        }
        echo '
     </script>
     </onClick>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
     </item>
     ';
     }

}
?>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page+1).",";
if($search) {
  $url = $url.urlencode($search).",".urlencode($tit);
}
?>
<item>
<title>Next Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina următoare</annotation>
<image>image/right.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
</channel>
</rss>
