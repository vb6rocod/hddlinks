#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
error_reporting(0);
$filelink = $_GET["file"];
$t1=explode(",",$filelink);
$filelink = urldecode($t1[0]);
//echo $filelink;
$filelink = str_replace("*",",",$filelink);
$filelink = str_replace("@","&",$filelink); //seriale.subtitrate.info
  if (strpos($filelink,"adf.ly") !== false) {
    $t1=explode("http",$filelink);
    $filelink="http".$t1[2];
  }
$pg = urldecode($t1[1]);
if ($pg == "") {
   $pg_title = "Link";
} else {
  $pg_title = $pg;
  $pg = preg_replace('/[^A-Za-z0-9_]/','_',$pg);
}
$titledownload=$pg;
//play movie
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/";
   $dir_log = "/tmp/usbmounts/sda1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/";
   $dir_log = "/tmp/usbmounts/sdb1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/";
   $dir_log = "/tmp/usbmounts/sdc1/download/log/";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/";
   $dir_log = "/tmp/usbmounts/sda2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/";
   $dir_log = "/tmp/usbmounts/sdb2/download/log/";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc2/download/";
   $dir = "/tmp/usbmounts/sdc2/download/log/";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   $dir = "/tmp/hdd/volumes/HDD1/download/";
   $dir_log = "/tmp/hdd/root/log/";
} else {
     $dir = "";
     $dir_log = "";
}
// end
?>
<?php echo "<?xml version='1.0' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
    storagePath             = getStoragePath("tmp");
    storagePath_stream      = storagePath + "stream.dat";
    storagePath_playlist    = storagePath + "playlist.dat";
  setRefreshTime(1);
  first_time=1;
</onEnter>
 <onExit>
 setRefreshTime(-1);
 </onExit>
<onRefresh>
  if(first_time == 1)
  {
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
  first_time=0;
  }
  else if (do_down == 1)
  {
    topUrl = "http://127.0.0.1/cgi-bin/scripts/util/info_down.php?file=" + log_file + ",f";
    info_serial = getUrl(topUrl);
  }
</onRefresh>
<mediaDisplay name="threePartsView"
	itemBackgroundColor="0:0:0"
	backgroundColor="0:0:0"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	sideColorRight="0:0:0"
	itemImageXPC="5"
	itemXPC="20"
	itemYPC="20"
	itemWidthPC="70"
	capWidthPC="70"
	unFocusFontColor="101:101:101"
	focusFontColor="255:255:255"
	showHeader="no"
	showDefaultInfo="yes"
	bottomYPC="90"
	infoYPC="100"
	infoXPC="0"
	popupXPC = "40"
  popupYPC = "55"
  popupWidthPC = "22.3"
  popupHeightPC = "5.5"
  popupFontSize = "13"
	popupBorderColor="28:35:51"
	popupForegroundColor="255:255:255"
 	popupBackgroundColor="28:35:51"
  idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="18" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Press: 1 for download manager, 2 for download
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>print(info_serial); info_serial;</script>
		</text>
<onUserInput>
userInput = currentUserInput();
ret = "false";
if(userInput == "two" || userInput == "2")
{
tip=getItemInfo(getFocusItemIndex(),"tip");
showIdle();
if (tip == "1")
{
url =  getItemInfo(getFocusItemIndex(),"download");
movie=getUrl(url);
info_serial="link:" + movie;
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + movie + ";name=" + getItemInfo(getFocusItemIndex(),"name");
}
else if (tip == "2")
{
topUrl = "http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link=" + getItemInfo(getFocusItemIndex(),"download") + ";name=" + getItemInfo(getFocusItemIndex(),"name");
}
dummy = getUrl(topUrl);
cancelIdle();
do_down=1;
file_name= getItemInfo(getFocusItemIndex(),"title");
log_file="<?php echo $dir_log; ?>" + getItemInfo(getFocusItemIndex(),"name") + ".log";
setRefreshTime(10000);
ret="true";
}
else if (userInput == "three" || userInput == "3")
{
 url="<?php echo $dir; ?>" + getItemInfo(getFocusItemIndex(),"name");
 playItemurl(url,10);
 ret="true";
}
else if(userInput == "four" || userInput == "4")
{
showIdle();
url =  getItemInfo(getFocusItemIndex(),"download");
info_serial="link:" + url;
redrawdisplay();
tip=getItemInfo(getFocusItemIndex(),"tip");
if (tip == "1")
{
movie=getUrl(url);
info_serial="movie:" + movie;
}
cancelIdle();
redrawdisplay();
ret="true";
}
else if (userInput == "one" || userInput == "1")
{
jumpToLink("destination");
ret="true";
}
else
{
info_serial=" ";
setRefreshTime(-1);
do_down=0;
ret="false";
}
ret;
</onUserInput>
</mediaDisplay>
<destination>
	<link>http://127.0.0.1/cgi-bin/scripts/util/level.php
	</link>
</destination>
<channel>
<?php
echo "<title>".$pg_title."</title>"
;
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function cv($s) {
  $g=ord("g");
  $c=ord($s);
  if ($c < 58) {
    $c=$s;
  } else {
    if ($c > 116) {
     $c=$c-$g + 16 + 6;
    } else {
     $c=$c-$g + 16;
    }
  }
return $c;
}
function get_unpack($k,$char_rep,$pos_link,$h) {
  $g=ord("g");
  $f=explode("return p}",$h);
  $e=explode("'.split",$f[$k]);
  $t=$e[0];
  $a=explode(";",$t);
  //print_r($a); //for debug only
  $w=explode("|",$a[$char_rep]); //char list for replace
  $t1=explode("'",$a[$pos_link]); // where is final link
  $fl= $t1[3];
  $fl=str_replace("10","u",$fl);
  $fl=str_replace("11","v",$fl);
  $fl=str_replace("12","w",$fl);
  $fl=str_replace("13","x",$fl);
  $fl=str_replace("14","y",$fl);
  $fl=str_replace("15","z",$fl);
  $r="";
  for ($i=0;$i<strlen($fl)-1;$i++) {
      if (preg_match("/[A-Za-z0-9_]/",$fl[$i])) {
         $m=$w[cv($fl[$i])];
         if ($m=="") $m=$fl[$i];
         $r=$r.$m;
      } else {
        $r=$r.$fl[$i];
      }
  }
  return $r;
}
if (preg_match("/loads7/i",$filelink)) {
   $filelink = str_replace(" ","+",$filelink);
}
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
if (preg_match("/awesomedl/i",$filelink)) {
  $t1=explode("Watch Online:",$html);
  $html=$t1[1];
}
if (preg_match("/filmbazis1\.org/",$filelink)) {
  $id=substr(strrchr($filelink, "/"), 1);
  /*
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $h1 = curl_exec($ch);
  curl_close($ch);
  $id=str_between($h1,"movie_id:","|");
  */
  //$id="19476";
  $l="http://www.filmbazis.org/movies.php";
  $post="type=get_movie_links&query=movie_id:229511|season:0";
  $post="type=get_movie_links&query=movie_id:".$id."|season:0";
  //$post="type=get_movie_links&query=movie_id:19476|season:0"
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $l);
     curl_setopt ($ch, CURLOPT_POST, 1);
     curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
     curl_setopt ($ch, CURL_REFERER,$filelink);
     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
     $html = curl_exec($ch);
     curl_close($ch);
     //echo $html;
}
if (strpos($filelink,"http://filmvilag.com/go/") !==false) {
 //http://filmvilag.com/go/sorozat/18522
 $html=file_get_contents($filelink);
}
//echo $html;
/**################ All links ################**/
$s="/adf\.ly|vidxden\.c|divxden\.c|vidbux\.c|movreel\.c|videoweed\.(c|e)|novamov\.(c|e)|vk\.com|fcore\.eu";
$s=$s."|movshare\.net|youtube\.c|flvz\.com|rapidmov\.net|putlocker\.com|played\.to|primeshare\.tv|";
$s=$s."peteava\.ro\/embed|peteava\.ro\/id|content\.peteava\.ro|180upload\.com|vidto\.me|putme\.org";
$s=$s."|vimeo\.com|googleplayer\.swf|filebox\.ro\/get_video|vkontakte\.ru|megavideo\.c|videobam\.com";
$s=$s."|divxstage\.net|divxstage\.eu|stream2k\.com|sockshare\.com|xvidstage\.com|gorillavid\.in|donevideo\.com";
$s=$s."|nolimitvideo\.com|stage666\.net\/|rapidload\.org|vidstream\.us|2gb-hosting\.com|youwatch\.org";
$s=$s."|dimshare\.com|movdivx\.com|sharevideo22\.com|dr9000\.com|altervideo\.net|royalvids\.eu";
$s=$s."|skyload\.net|rapidvideo\.com|uploadc\.com|uploadville\.com|zurvid\.com|flashx\.tv|ufliq\.com|ovfile\.com";
$s=$s."|sharefiles4u\.com|filebox\.com|glumbouploads\.com|ginbig\.com|divxbase\.com|allmyvideos\.net";
$s=$s."|gorillavid\.in|streamcloud\.eu|zalaa\.com|vreer\.com|zixshare\.com|veervid\.com|uploadboost\.com";
$s=$s."|ufliq\.com|muchshare\.net|nowvideo\.eu|vidbull\.com|nosvideo\.com|dailymotion\.com|purevid\.com|modovideo\.com|mooshare\.biz|streamin\.to|divxstream\.net/i";
if(preg_match_all("/(http\b.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
}
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
  if (preg_match($s,$cur_link)) {
    if ($cur_link <> $last_link) {
        if (strpos($cur_link,"adf.ly") !== false) {
          $t1=explode("http",$cur_link);
          $cur_link1=$t1[2];
          if ($cur_link1) $cur_link="http".$cur_link1;
          if (!$cur_link1) {
           $h1=file_get_contents($cur_link);
           $cur_link=str_between($h1,"var url = '","'");
           if (!$cur_link) $cur_link=str_between($h1,"var zzz = '","'");
          }
          if (!preg_match($s,$cur_link)) $cur_link="twitter";
        }
        if (strpos($cur_link,"linkbucks") !== false) {
          $t1=explode("/url/",$cur_link);
          $cur_link=$t1[1];
        }
      if (!preg_match("/facebook|twitter|img\.youtube/",$cur_link)) {
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link1.php?file=".urlencode($cur_link);
        $server = str_between($cur_link,"http://","/");
        $last_link=$cur_link;
        $title=$server. " - With seek - SDK4";
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link.'";
        url=getUrl(movie);
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$pg_title.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
      }
    }
  }
}
//http://www.movie2k.to/Cowboys-Aliens-online-film-831698.html
//href="movie.php?id=831698&part=2">
//movie.php?id=829810&part=2
$t1 = substr(strrchr($filelink, "-"), 1);
$t2=explode(".",$t1);
$id=$t2[0];
$l= "movie.php?id=".$id."&part=2";
if (strpos($html,$l) !==false) {
$filelink="http://www.movie2k.to/".$l;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
/**################ All links ################**/
if(preg_match_all("/(http\b.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
}
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
  if (preg_match($s,$cur_link)) {
    if ($cur_link <> $last_link) {
      if (!preg_match("/facebook|twitter|img\.youtube/",$cur_link)) {
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link1.php?file=".urlencode($cur_link);
        $server = str_between($cur_link,"http://","/");
        $last_link=$cur_link;
        $title=$server. " - part2 - With seek - SDK4";
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link.'";
        url=getUrl(movie);
        cancelIdle();
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/x-flv);
        streamArray = pushBackStringArray(streamArray, "'.$pg_title.'");
        streamArray = pushBackStringArray(streamArray, "1");
        writeStringToFile(storagePath_stream, streamArray);
        doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
        </script>
        </onClick>
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
      }
    }
  }
}
}
?>
</channel>
</rss>
