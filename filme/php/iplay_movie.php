#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $page = $queryArr[0];
   $tip = $queryArr[1];
}
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
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    5=Setare subtitrare
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="60" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi dreapta pentru mai multe....
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
else if (userInput == "right" || userInput == "R")
{
movie=getItemInfo(getFocusItemIndex(),"movie");
img=getItemInfo(getFocusItemIndex(),"image");
showIdle();
movie_info="http://127.0.0.1/cgi-bin/scripts/filme/php/iplay_movie_det.php?file=" + movie + "," + <?php echo $page; ?> + "," + <?php echo $tip; ?>;
dummy = getURL(movie_info);
cancelIdle();
ret_val=doModalRss("/usr/local/etc/www/cgi-bin/scripts/filme/php/movie_detail.rss");
ret="true";
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
else if (userInput == "five" || userInput == "5")
   {
    jumpToLink("sub");
    "true";
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
	<searchLink>
	  <link>
	    <script>"<?php echo $host; ?>/scripts/filme/php/iplay_movie_s.php?query=" + urlEncode(keyword);</script>
	  </link>
	</searchLink>
	<gotopage>
	  <link>
	    <script>
        "<?php echo $host; ?>/scripts/filme/php/iplay_movie.php?query=" + urlEncode(keyword) + "," + "<?php echo $tip; ?>";
        </script>
	  </link>
	</gotopage>
<?php
  $f = "/usr/local/bin/home_menu";
if (!file_exists($f)) {
echo '
<sub>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub.rss</link>
<mediaDisplay name="onePartView"/>
</sub>
';
} else {
echo '
<sub>
<link>/usr/local/etc/www/cgi-bin/scripts/util/sub1.rss</link>
<mediaDisplay name="onePartView"/>
</sub>
';
}
?>
<channel>

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
$filename = "/usr/local/etc/dvdplayer/iplay.txt";
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";
if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a=explode("|",$c);
  $a1=str_replace("?","@",$a[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a[1]);
if (!file_exists($cookie)) {
  $l="http://videobox.iplay.ro/user/login";
  $post="email=".$user."&password=".$pass."&remember_me=1";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://videobox.iplay.ro/user/login");
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
}
}
if ($tip=="0") //recente
  $link="http://videobox.iplay.ro/movies/index/sort/created/dir/desc/page/".$page;
else if ($tip=="1") // top rating
  $link="http://videobox.iplay.ro/movies/index/sort/rating/dir/desc/page/".$page;
else if ($tip=="2") //alfabetic
  $link="http://videobox.iplay.ro/movies/index/sort/title/dir/asc/page/".$page;
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$c1=explode('class="paginatorPage"',$html);
$c2=count($c1);
$t1=explode('>',$c1[$c2-1]);
$t2=explode('<',$t1[1]);
$totpages=$t2[0];
echo '
	<title>iPlay - filme - pagina '.$page.'/',$totpages.'</title>
	<menu>main menu</menu>
';
if($page > 1) { ?>

<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page-1).",".$tip;
?>
<title>Previous Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina anterioară</annotation>
<image>image/left.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>


<?php } ?>
<?php
$videos = explode('<div class="movieCell ">', $html);
if (count($videos) > 0) {
echo '
<item>
<title>Salt la pagina ...</title>
<onClick>
  keyword = getInput();
  if (keyword != null)
  {
    jumpToLink("gotopage");
  }
</onClick>
</item>
';
}

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

if ($n == 0) {
exec("rm -f /tmp/iplay.txt");
$link = "/usr/local/etc/www/cgi-bin/scripts/filme/php/iplay.rss";
$description="Pentru a accesa acest site trebuie să aveţi un cont pe iplay.ro. Completaţi userul şi parola în acest formular şi apoi apăsaţi Return, Return după care accesaţi din nou această pagină.Folositi ? pentru @ in caz ca nu aveti aceasta tasta.";

	  echo '
	  <item>
	  <title>Logare</title>
	  <link>'.$link.'</link>
	  <annotation>'.$description.'</annotation>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
}

?>
<item>
<?php
$sThisFile = 'http://127.0.0.1'.$_SERVER['SCRIPT_NAME'];
$url = $sThisFile."?query=".($page+1).",".$tip;
?>
<title>Next Page</title>
<link><?php echo $url;?></link>
<annotation>Pagina următoare</annotation>
<image>image/right.jpg</image>
<mediaDisplay name="threePartsView"/>
</item>
</channel>
</rss>
