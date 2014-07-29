#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//error_reporting(0);
$ff="/tmp/n.txt";
$cookie="/tmp/noobroom.txt";

/*
if (!file_exists($ff)) {
$l="http://noobroom.com/";
$h=file_get_contents($l);
$t1=explode('value="',$h);
$n= count($t1);
$t2=explode('"',$t1[1]); // $t1[$n-1]
$noob=$t2[0];
if (!$noob) $noob="http://noobroom9.com";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/login.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  $h = curl_exec($ch);
  curl_close($ch);
  if (strpos($h,"200 OK") !== false) $out=$noob;
if ($n > 2 && !$out) {
  $t2=explode('"',$t1[2]);
  $noob=$t2[0];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/login.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  $h = curl_exec($ch);
  curl_close($ch);
  if (strpos($h,"200 OK") !== false) $out=$noob;
}
if ($out) {
$fh = fopen($ff, 'w');
fwrite($fh, $noob);
fclose($fh);
} else {
 die();
}
} else {
$noob=file_get_contents($ff);
}
*/
$noob="http://superchillin.com";
$fh = fopen($ff, 'w');
fwrite($fh, $noob);
fclose($fh);
include ("../../common.php");
$cookie="/tmp/noobroom.txt";
$filename="/usr/local/etc/dvdplayer/amigo.dat";
$noob_log="/usr/local/etc/dvdplayer/noob_log.dat";
if (file_exists($noob_log) && !file_exists($cookie)) {
  $handle = fopen($noob_log, "r");
  $c = fread($handle, filesize($noob_log));
  fclose($handle);
  $a=explode("|",$c);
  $a1=str_replace("?","@",$a[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a[1]);
  $post="email=".$user."&password=".$pass;
}
if (file_exists($filename) && !file_exists($cookie) && !file_exists($noob_log)) {
  $pass=file_get_contents($filename);
  $lp="http://hddlinks.p.ht/n_a.php?pass=".$pass;
  $lp="http://hddlinks.pht.ro/n_a.php?pass=".$pass;
  //echo $lp;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $lp);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $post1 = curl_exec($ch);
  curl_close($ch);
  if ($post1) $post=$post1;
}
//die();
if ($post) {
  $lp=$check."s2=".urlencode($post);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $lp);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_exec($ch);
  curl_close($ch);
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/");
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/login.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/");
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$post=$post."&recaptcha_challenge_field=03AHJ_VuuzO2g9g6IILiu2pyaterQVaBodP0EWtwOldqTajuz63nzeDsaRg_Cs617aTY_EFwWGEk2bScrak5VqgddT8mf7dDaAeq8FNQn3dyIIkeC0dZ68412_e0mDZAJCEw4MqZdXsEfZzskKSIiOIELzpZ_y6RaE4115uzZh6FLgC0PCEzdvDjGooksZbaBe4ZrTwBd4-EifnGifYL4ti-J8WSsLGj5gNnmeWRRfUIzxN1J_tYdorC9V_3IpZSavvdnozYWIC_-40UWWn6hYaLBF6Nt_VJvUw8HlUwyukVy78gUk1OrVss4&recaptcha_response_field=1002";

  $l=$noob."/login2.php";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:22.0) Gecko/20100101 Firefox/22.0');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/login.php");
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
}
$l=$noob."/kids.php";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/login.php");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  $status = str_between($html,'premium.php">','</');
  $status = str_replace("<","&lt;",$status);
  /*
  $t1=explode('premium.php',$html);
  $t2=explode(">",$t1[1]);
  $t3=explode("<",$t2[1]);
  $status=$t3[0]; //Active
  */
  if (strpos($status,"day") === false)
    $premium="";
  else
    $premium="Premium: ".$status;
$noob_serv="/tmp/noob_serv.log";
if (!file_exists($noob_serv)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $noob."/index.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_REFERER, $noob."/login.php");
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $h = curl_exec($ch);
  curl_close($ch);
  $h=str_between($h,"Select","</div");
  $out="";
  $videos = explode('href=', $h);
  unset($videos[0]);
  $videos = array_values($videos);
  foreach($videos as $video) {
    $t1=explode("s=",$video);
    $t2=explode("'",$t1[1]);
    $serv=$t2[0];
    $t1=explode(">",$video);
    $t2=explode("<",$t1[1]);
    $name_serv=$t2[0];
    $out=$out.$name_serv."\n".$serv."\n";
  }
$noob_serv="/tmp/noob_serv.log";

$fh = fopen($noob_serv, 'w');
fwrite($fh, $out);
fclose($fh);
}
$hserv=file_get_contents($noob_serv);
$serv=explode("\n",$hserv);
$nn=count($serv);
?>
<rss version="2.0">
<script>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";

  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";
  storagePath_playlist    = storagePath + "playlist.dat";

  error_info          = "";
</script>
<onEnter>
  cachePath = getStoragePath("key");
  optionsPath = cachePath + "noobroom.dat";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    subtitle = "on";
     server = "-1";
     sserver="Default";
     hhd = "0";
     shd = "SD";
  }
  else
  {
    subtitle = getStringArrayAt(optionsArray, 0);
    server = getStringArrayAt(optionsArray, 1);
    hhd = getStringArrayAt(optionsArray, 2);
  }
  if (subtitle == " " || subtitle == "" || subtitle == null)
    subtitle = "on";
  if (server == " " || server == "" || server == null)
    {
    server = "-1";
    sserver="Default";
    }
  if (hhd == " " || hhd == "" || hhd == null)
    {
     hhd = "0";
     shd="SD";
    }
    if (hhd == "0")
      shd="SD";
    else if (hhd == "1")
      shd="HD";
    else if (hhd == "2")
      shd="MP4";
    else if (hhd == "3")
      shd="HMP4";
    if (server == "-1")
      sserver="Defaut";
<?php
for ($k=0;$k<$nn-1;$k=$k+2) {
$n=$k/2;
echo '
    else if (server == "'.$n.'")
      sserver="'.$serv[$k].'";
      ';
}
?>
setRefreshTime(1);
</onEnter>
<onExit>
  arr = null;
  arr = pushBackStringArray(arr, subtitle);
  arr = pushBackStringArray(arr, server);
  arr = pushBackStringArray(arr, hhd);
  print("arr=",arr);

  writeStringToFile(optionsPath, arr);
</onExit>

<onRefresh>
    itemCount = getPageInfo("itemCount");
    setRefreshTime(-1);
    redrawdisplay();
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
    <script>getPageInfo("pageTitle") + " (" + itemCount + ")";</script>
		</text>
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="40" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    info=server load
		</text>
  	<text align="right" offsetXPC="55" offsetYPC="3" widthPC="40" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"<?php echo $premium; ?>" + sprintf("%s "," ");</script>
		</text>
  	<text redraw="yes" offsetXPC="86" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s", focus-(-1));</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="80" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=favorite, 2= download,0=dl. manager,4/6= jump -+100,5=Setare subtitrare
		</text>
	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"3= Subtitrare: " + subtitle + " 7=Server: " + sserver + " 9=SD/HD/MP4/HMP4:" + shd;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=30 widthPC=30 heightPC=50>
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
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
					  img = getItemInfo(idx, "image");
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
else if (userInput == "two" || userInput == "2")
	{
     showIdle();
     url=getItemInfo(getFocusItemIndex(),"download") + server + "," + hhd + ",0";
     movie=getUrl(url);
     cancelIdle();
	 topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + movie + ";name=" + getItemInfo(getFocusItemIndex(),"name");
	 dlok = loadXMLFile(topUrl);
	 "true";
}
else if (userInput == "zero" || userInput == "0")
   {
    jumpToLink("destination");
    "true";
}
else if (userInput == "five" || userInput == "5")
   {
    jumpToLink("sub");
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
else if(userInput == "seven" || userInput == "7")
{
<?php
echo '
if (server == "-1")
  {
    server = "0";
    sserver="'.$serv[0].'";
  }
  ';
for ($k=0;$k<$nn-3;$k=$k+2) {
$n=$k/2;
echo '
else if (server == "'.$n.'")
  {
    server = "'.($n+1).'";
    sserver="'.$serv[$k+2].'";
  }
';
}
echo '
else if (server == "'.(($nn-3)/2).'")
  {
    server = "-1";
    sserver="Default";
  }
';
?>
else
  {
    server= "-1";
    sserver="Default";
  }
}
else if(userInput == "nine" || userInput == "9")
{
if (hhd == "0")
 {
  hhd = "1";
  shd = "HD";
 }
else if(hhd == "1")
 {
  hhd = "2";
  shd = "MP4";
 }
else if(hhd == "2")
 {
  hhd = "3";
  shd = "HMP4";
 }
else if(hhd == "3")
 {
  hhd = "0";
  shd = "SD";
 }
}
else if (userInput == "display" || userInput == "DISPLAY")
{
showIdle();
movie_info="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_serv_load.php";
dummy = getURL(movie_info);
cancelIdle();
ret_val=doModalRss("/usr/local/etc/www/cgi-bin/scripts/filme/php/noob_serv_load.rss");
ret="true";
}
else if (userInput == "one" || userInput == "1")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_k_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
}
redrawdisplay();
ret;
</script>
  </onUserInput>
		
	</mediaDisplay>
	
	<item_template>
		<mediaDisplay  name="threePartsView" idleImageWidthPC="10" idleImageHeightPC="10">
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
	url="/usr/local/etc/www/cgi-bin/scripts/filme/php/noobroom.rss";
	url;
	</script>
	</link>
	</logon>
<destination>
	<link>http://127.0.0.1/cgi-bin/scripts/util/level.php
	</link>
</destination>
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
	<title>Kids</title>
	<menu>main menu</menu>


<?php
//echo $l;
//echo $post;
if (!file_exists("/usr/local/etc/dvdplayer/amigo.dat")) {
echo '
<item>
<title>Amigo COD</title>
<onClick>
<script>
optionsPath="/usr/local/etc/dvdplayer/amigo.dat";
pass = readStringFromFile(optionsPath);
if (pass == null)
{
 keyword = getInput();
 if (keyword != null)
 {
  url1="http://127.0.0.1/cgi-bin/scripts/filme/php/amigo.php?pass=" + keyword;
  msg=getUrl(url1);
  if (msg=="ok")
  {
   writeStringToFile(optionsPath, keyword);
  }
 }
}
 </script>
</onClick>
 </item>
 ';
}
if (strpos($status,"day") === false && !file_exists($cookie)) {
$link = "/usr/local/etc/www/cgi-bin/scripts/filme/php/noobroom.rss";

	  echo '
	  <item>
	  <title>Logare</title>
	  <link>'.$link.'</link>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
}
  $title="Filme favorite";
  $link = $host."/scripts/filme/php/noobroom_k_fav.php";
  echo '
  <item>
  <title>'.$title.'</title>
  <link>'.$link.'</link>
  <image></image>
  </item>
  ';
$link="http://hdforall.uphero.com/srt/";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  $html_s = curl_exec($ch);
  curl_close($ch);
  if ($html_s) $videos = explode("<li>", $html_s);
if (!$html_s) {
$link="http://nobsub.googlecode.com/hg/m/list.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  $html_s = curl_exec($ch);
  curl_close($ch);
  if ($html_s) {
   $videos = explode(",", $html_s);
   $videos = array_values($videos);
   foreach($videos as $video) {
     $srt[$video]="exista";
   }
}
} else {
unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t1=explode('>',$video);
  $t2=explode('<',$t1[1]);
  $t3=explode('.',$t2[0]);
  $id_srt=trim($t3[0]);
  if (strpos($video,".srt") !== false) $srt[$id_srt]="exista";
}
}
$videos = explode('<table>', $html);
unset($videos[0]);
$videos = array_values($videos);
//$videos = array_reverse($videos);
foreach($videos as $video) {
  $t1=explode("href='/?", $video);
  $t2=explode("'",$t1[1]);
  $link=$t2[0];


  $t3 = explode('>', $t1[2]);
  $t2 = explode('<', $t3[1]);
  $title = trim($t2[0]);
  $title=str_replace("&amp;","&",$title);
  $title=str_replace("&","&amp;",$title);
  $title=str_replace("\'","'",$title);
  $name = preg_replace('/[^A-Za-z0-9_]/','_',$title).".mp4";
  $t1=explode("src='",$video);
  $t2=explode("'",$t1[1]);
  if (strpos($t2[0],"http")=== false)
    $img=$noob."/".$t2[0];
  else
    $img=$t2[0];
   if (!$srt[$link])
      $title1=$title." (*)";
   else
      $title1=$title;
   $link1="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_link.php?file=".$link.",no,";
   if ($title) {
     echo '
     <item>
     <title>'.$title1.'</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/filme/php/noobroom_link.php?file='.$link.'" + "," + subtitle + "," + server + "," + hhd + ",0";
     movie=geturl(url);
     cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
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
    $f = "/usr/local/bin/home_menu";
    if (file_exists($f)) {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer22.rss");
    ';
    } else {
    echo '
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
    ';
    }
    echo '
     </script>
     </onClick>
    <download>'.$link1.'</download>
    <title1>'.urlencode($title).'</title1>
    <link1>'.urlencode($link).'</link1>
    <name>'.$name.'</name>
    <movie>'.$link.'</movie>
    <image>'.$img.'</image>
    <annotation>'.$title.'</annotation>
     </item>
     ';
   }
}
?>

</channel>
</rss>
