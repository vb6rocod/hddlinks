#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
include ("../../common.php");
error_reporting(0);
function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    $text= preg_replace('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    $text= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    return $text;
}
//if (file_exists("D:\\Adobe"))
  $filelink = $_GET["file"];
  //$filelink=str_replace(",","%2C",$filelink);
  //echo $filelink;
//else
//  $filelink=$_ENV["QUERY_STRING"];
//$filelink = $_GET["file"];
//$filelink="http://www.seriale.filmesubtitrate.info/2011/08/against-wall-sezon-1-ep-1-pilot-serial.html";
$t1=explode(",",$filelink);
$filelink = urldecode($t1[0]);
$filelink = str_replace("*",",",$filelink);
$filelink = str_replace("@","&",$filelink); //seriale.subtitrate.info
//echo $filelink;
$pg = urldecode($t1[1]);
$pg=fix_s($pg);
if ($pg == "") {
   $pg_title = "Link";
} else {
  $pg_title = $pg;
  $pg = preg_replace('/[^A-Za-z0-9_]/','_',$pg);
}
$titledownload=$pg;
$onlinemoca=$t1[2];
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
    info_serial="";
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
		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
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
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="18" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="3" widthPC="10" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text align="left" offsetXPC="8" offsetYPC="3" widthPC="47" heightPC="4" fontSize="14" backgroundColor="10:105:150" foregroundColor="100:200:255">
    5=Setare subtitrare
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 1 pentru Download Manager, 2 pentru download, 3 pentru vizionare download, 4 verificare link
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>print(info_serial); info_serial;</script>
		</text>
<onUserInput>
userInput = currentUserInput();
ret = "false";
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
else if(userInput == "two" || userInput == "2")
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
else if (userInput == "five" || userInput == "5")
   {
    jumpToLink("sub");
    ret="true";
}
else
{
info_serial="";
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
echo "<title>".$pg_title."</title>"
;
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function unpack_DivXBrowserPlugin($n_func,$html_cod,$sub=false) {
  $f=explode("return p}",$html_cod);
  $e=explode("'.split",$f[$n_func]);
  $ls=$e[0];
  //echo $ls;
  $a=explode(";",$ls);
  //print_r($a); //for debug only
  $a1=explode("'",$a[count($a)-1]); //char list for replace
  $b1=explode(",",$a1[1]);
  $base_enc=$b1[1];
  //echo $base_enc;
  $w=explode("|",$a1[2]);
  //print_r ($w);
  $ch="0123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
  $ch="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $ch="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $fl="";
  for ($i=0;$i<count($a)-1;$i++) {
    $fl=$fl.$a[$i];
  }
  $r="";
  $x=strlen($fl);
  for ($i=0;$i<strlen($fl);$i++) {
    if (!preg_match('/[A-Za-z0-9]/',$fl[$i])) { //nu e alfanumeric
       $r=$r.$fl[$i];
    } elseif (($i<$x) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i+1]))) {
       $pos=strpos($ch,$fl[$i+1]);
       $pos=$base_enc*$fl[$i] + $pos;
       if ($w[$pos] <> "")
         $r=$r.$w[$pos];
       else
         $r=$r.$fl[$i].$fl[$i+1];
     } elseif (($i>0) && (preg_match('/[A-Za-z0-9]/',$fl[$i])) && (preg_match('/[A-Za-z0-9]/',$fl[$i-1]))) {
       // nothing
     } else {
       $pos=strpos($ch,$fl[$i]);
        if ($w[$pos] <> "")
          $r=$r.$w[$pos];
        else
          $r=$r.$fl[$i];
     }
  }
  $r=str_replace("\\","",$r);
  //echo $r;
  $ret_val=str_between($r,'param name="src"value="','"');
  if ($ret_val == "")
    $ret_val = str_between($r,"file','","'");
  if ($sub==true) {
    $srt=str_between($r,"captions.file','","'");
    $srt = str_replace(" ","%20",$srt);
    $ret_val=$ret_val.",".$srt;
  }
  return $ret_val;
}

/**####################################**/
/** Here we start.......**/
$last_link = "";
//if (strpos($filelink,"onlinemoca") === false) {
if (strpos($filelink,"filmeonlinesubtitrate") !== false) {

  $post="pageviewnr=1";
  $ch = curl_init($filelink);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch,CURLOPT_REFERER,$filelink);
  //curl_setopt ($ch, CURLOPT_POST, 1);
  //curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  curl_setopt($ch, CURLOPT_HEADER, true);
  $html = curl_exec($ch);
  curl_close ($ch);
  //$l = str_between($html,"Link: <",">;");
  //echo $l;
  //Link: <http://www.filmeonlinesubtitrate.tv/?p=5382>; rel=shortlink
  //$AgetHeaders = @get_headers($filelink);
  //echo $AgetHeaders;
} elseif (strpos($filelink,"990.ro") !== false) {
//echo $filelink;
    //$link1 = str_replace("download","",$filelink);
    //$link1 = str_replace("seriale2","player-seriale",$link1);
  $link1=$filelink;
  $ch = curl_init($link1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch,CURLOPT_REFERER,$filelink);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
  $html = curl_exec($ch);
  curl_close ($ch);

  $link1=str_replace(urldecode("%0D"),"",$link1);
  $filelink=$link1;
//} elseif (strpos($filelink,"filmedivix") !== false) {
//  $html=file_get_contents($filelink);
//  $filelink="http://filmedivix.com/filmeonline/".str_between($html,"filmedivix.com/filmeonline/",'"');
//  $html = file_get_contents($filelink);
} elseif (strpos($filelink,"http://filmehd.net") !== false) {
  $html=file_get_contents($filelink);
  $i1=str_between($html,"js_content.php","'");
  $filelink="http://filmehd.net/js_content.php".$i1;
  $html=file_get_contents($filelink);
} elseif (strpos($filelink,"seriale.filmesubtitrate.info") !== false) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $filelink);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_REFERER,"http://www.seriale.filmesubtitrate.info");
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  $html=curl_exec($ch);
  curl_close($ch);
  $html= decode_entities($html);
} else {
  $html = file_get_contents($filelink);
  //echo $html;
  if (strpos($filelink,"vezi-online.net") !== false) {
    //$h1=str_between($html,'class="player">','</div');
    $h1=explode('class="player">',$html);
    $t1=explode("document.write(unescape('",$h1[1]);
    $t2=explode("'",$t1[1]);
    if ($t2[0]) $html=urldecode($t2[0]);
  }
}
//echo $html;
$mysrt=str_between($html,"captions.file=","&");
if(!$mysrt)
 $mysrt=str_between($html,'captions-2": { file: "','"');
$mysrt = str_replace(" ","%20",$mysrt);
if (strpos($mysrt,"http") === false && $mysrt) {
  $t=explode("/",$filelink);
  $mysrt="http://".$t[2].$mysrt;
}
//echo $mysrt;
if (strpos($html,"movieSrc=") !== false) {
$last_link="";
$videos = explode("movieSrc=", $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode("&",$video);
  $title="imgsmail.ru";
  //mail/alex.costantin/_myvideo/162
  $cur_link="http://api.video.mail.ru/videos/".$t1[0].".json";
  if ($cur_link <> $last_link) {
  $last_link=$cur_link;
  $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link);
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
/**################ All links ################**/
if (preg_match("/roshare\.info/",$html)) {
$dat="/usr/local/etc/dvdplayer/roshare.dat";
if (!file_exists($dat)) {
  $l = "/usr/local/etc/www/cgi-bin/scripts/filme/php/roshare.rss";
	  echo '
	  <item>
	  <title>Logare roshare.info</title>
	  <link>'.$l.'</link>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
}
}
if(preg_match_all("/(\/\/.*?)(\"|\')+/i",$html,$matches)) {
$links=$matches[1];
//print_r ($links);
}
$s="/adf\.ly|vidxden\.c|divxden\.c|vidbux\.c|movreel\.c|videoweed\.(c|e)|novamov\.(c|e)|vk\.com";
$s=$s."|movshare\.net|youtube\.com|youtube-nocookie\.com|flvz\.com|rapidmov\.net|putlocker\.com|mixturevideo\.com|played\.to|";
$s=$s."peteava\.ro\/embed|peteava\.ro\/id|content\.peteava\.ro|divxstage\.net|divxstage\.eu";
$s=$s."|vimeo\.com|googleplayer\.swf|filebox\.ro\/get_video|vkontakte\.ru|megavideo\.com|videobam\.com";
$s=$s."|fastupload|video\.rol\.ro|zetshare\.net\/embed|ufliq\.com|stagero\.eu|ovfile\.com|videofox\.net";
$s=$s."|trilulilu|proplayer\/playlist-controller.php|viki\.com|modovideo\.com|roshare\.info|rosharing\.com|ishared\.eu|";
$s=$s."filebox\.com|glumbouploads\.com|uploadc\.com|sharefiles4u\.com|zixshare\.com|uploadboost\.com";
$s=$s."|nowvideo\.eu|nowvideo\.co|vreer\.com|180upload\.com|dailymotion\.com|nosvideo\.com|vidbull\.com|purevid\.com|videobam\.com|streamcloud\.eu|donevideo\.com|upafile\.com|docs\.google|mail\.ru|superweb\.rol|moviki\.ru|entervideos\.com";
$s=$s."|indavideo\.hu|redfly\.us|videa\.hu|videakid\.hu/i";
for ($i=0;$i<count($links);$i++) {
  if (strpos($links[$i],"http") !== false) {
    $t1=explode("http:",$links[$i]);
    $cur_link="http:".$t1[1];
  } else {
  $cur_link="http:".$links[$i];
  }
  $t1=explode(" ",$cur_link);     //vezi-online
  $cur_link=$t1[0];
  $t1=explode("&stretching",$cur_link);    //vezi-online
  $cur_link=$t1[0];
  if (strpos($cur_link,"entervideos.com/vidembed") !==false) {
  $t1=explode("&",$cur_link);    //
  $cur_link=$t1[0];
  }
  $cur_link=str_replace(urldecode("%0D"),"",$cur_link);
  if (preg_match($s,$cur_link)) {
    if ($cur_link <> $last_link) {
     $t1=explode("proxy.link=",$cur_link); //vezi-filme
     if ($t1[1]) {
       $t2=explode("&",$t1[1]);
       $cur_link=trim($t2[0]);
     }
      if (!preg_match("/facebook|twitter|player\.swf|img\.youtube|youtube\.com\/user|radioarad|\.jpg|\.png|\.gif|jq\/(js|css)/i",$cur_link)) {
        $t1=explode("proxy.link=",$cur_link); //filmeonline.org
        if ($t1[1] <> "") {
        $cur_link=$t1[1];
        }
        if (strpos($cur_link,"captions.file") !== false) {  //http://vezi-online.net
        $a=explode("&captions.file",$cur_link);
        $mysrt=str_between($cur_link,"captions.file=","&");
        if (strpos($mysrt,"http") === false && $mysrt) {
         $t=explode("/",$filelink);
         $mysrt="http://".$t[2].$mysrt;
        }
        $cur_link=$a[0];
        }
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link);
        if (strpos($cur_link,"adf.ly") !==false) { //onlinemoca
           $a1=explode($cur_link,$html);
           $a2=explode('server/',$a1[1]);
           $a3=explode('.',$a2[1]);
           $server=$a3[0];
        } else {
          $server = str_between($cur_link,"http://","/");
        }
        $last_link=$cur_link;
        if (strpos($cur_link,"google") !==false) {
          $t1=explode("docid=",$cur_link);
          $t2=explode("&",$t1[1]);
          $docid=$t2[0];
          $mysrt_google="http://video.google.com/videotranscript?frame=c&docid=".$docid."&hl=ro&type=track&name=ro&lang=ro";
        }
        if (strpos($cur_link,"viki.com") !==false) {
          preg_match('/(viki\.com\/player\/medias\/)([\w\-]+)/', $cur_link, $match);
          $viki_id = $match[2];
        }
        if (strpos($cur_link,"roshare.info") !==false || strpos($cur_link,"rosharing.com") !==false) {
          $mysrt_roshare="asasas";
          /*
          $ch = curl_init($cur_link);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
          $h = curl_exec($ch);
          $id=str_between($h,'id" value="','"');
          $rand=str_between($h,'rand" value="','"');
          sleep(21);
          $post="op=download2&id=".$id."&rand=".$rand."&referer=&method_free=&method_premium=&down_direct=1";
          //echo $post;
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
          curl_setopt ($ch, CURLOPT_POST, 1);
          curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
          $h = curl_exec($ch);
          curl_close ($ch);
          $ret=unpack_DivXBrowserPlugin(2,$h,true);
          $ret1=explode(",",$ret);
          $mysrt=$ret1[1];
          */
        }
        if (!$server) $server = "LINK";
        $title=$server;
        if (preg_match("/vk\.com/",$cur_link)) {
         if (preg_match("/hd=1/",$cur_link)) $title=$server." (360p)";
         elseif (preg_match("/hd=2/",$cur_link)) $title=$server." (480p)";
         elseif (preg_match("/hd=3/",$cur_link)) $title=$server." (720p)";
        }
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
        if (preg_match("/vk\.com/",$cur_link) && preg_match("/hd=3/",$cur_link)) {
        $cur_link1=str_replace("hd=3","hd=2",$cur_link);
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link1);
        $title=$server." (480p)";
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
        $cur_link1=str_replace("hd=2","hd=1",$cur_link1);
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link1);
        $title=$server." (360p)";
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
        } elseif (preg_match("/vk\.com/",$cur_link) && preg_match("/hd=1/",$cur_link)) {
        $cur_link1=str_replace("hd=1","hd=2",$cur_link);
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link1);
        $title=$server." (480p)";
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
        } elseif (preg_match("/vk\.com/",$cur_link) && preg_match("/hd=2/",$cur_link)) {
        $cur_link1=str_replace("hd=2","hd=1",$cur_link);
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link1);
        $title=$server." (360p)";
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
        if (preg_match("/vk\.com/",$cur_link) && preg_match("/youtubevideo/",$filelink)) {
        $cur_link=str_replace("hd=1","hd=2",$cur_link);
        $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($cur_link);
        $title=$server." (480p)";
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
        if ($mysrt || $mysrt_google || $viki_id || $mysrt_roshare){
        $f = "/usr/local/bin/home_menu";
	    echo'
	    <item>
	    <title>Play cu subtitrare</title>
        <onClick>
        <script>
        showIdle();
        ';
        if ($mysrt_google <> "") {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/google_xml.php?file='.urlencode($mysrt_google).'");';
        } else if ($viki_id <> "") {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/viki_xml.php?file='.$viki_id.'");';
        } else {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($mysrt).'");';
        }
        echo '
        movie="'.$link.'";
        url=getUrl(movie);
        cancelIdle();
        storagePath = getStoragePath("tmp");
        storagePath_stream = storagePath + "stream.dat";
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/mp4);
        streamArray = pushBackStringArray(streamArray, "'.$pg_title.'");
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
/**################ special links ##############**/
if (preg_match_all('/<(iframe\b|object\b)[^>]+src\s?=\s?([\'|\"])(.*?)(\"|\')+/is', $html, $matches)) {
$links=$matches[3];
}
$link="";
$srt="";
$tip="";
for ($i=0;$i<count($links);$i++) {
  $cur_link=$links[$i];
    if (strpos($cur_link,"rofilm.info") !==false) {
     $baza = file_get_contents($cur_link);
     $t1=explode('value="file=',$baza);
     $t2=explode("&",$t1[1]);
     $link = $t2[0];
     if ($link=="") {
       $t1=explode("value='file=",$baza);
       $t2=explode("&",$t1[1]);
       $link=$t2[0];
     }
     if ($link == "") {
       $link1=str_between($baza,'proxy.link=','"');
       $tip="1";
        $link2="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($link1);
        $server = str_between($link1,"http://","/");
        $title=$server;
        if ($link1 <> "") {
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        movie="'.$link2.'";
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
        <download>'.$link2.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
        }

     $t1=explode('captions.file=',$baza);
     $t2=explode("&",$t1[1]);
     $srt=$t2[0];
     $srt = str_replace(" ","%20",$srt);
    	$f = "/usr/local/bin/home_menu";
	    echo'
	    <item>
	    <title>Play cu subtitrare</title>
        <onClick>
        <script>
        showIdle();
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($srt).'");
        movie="'.$link2.'";
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
        <download>'.$link2.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
     }
    } elseif (strpos($cur_link,"serialetvonline.info") !==false) {
      if (strpos($cur_link,"gettvguide2.php") === false) {
       $baza = file_get_contents($cur_link);
       $link = str_between($baza,'"flashvars" value="file=','&');
       $t1=explode('captions.file=',$baza);
       $t2=explode("&",$t1[1]);
       $srt=$t2[0];
       $srt = str_replace(" ","%20",$srt);
      }
     } elseif (strpos($cur_link,"rosharing.info") !==false){
       $baza = file_get_contents($cur_link);
       $ret=unpack_DivXBrowserPlugin(2,$baza,true);
       $ret1=explode(",",$ret);
       $srt=$ret1[1];
       $link=$ret1[0];
     } elseif (strpos($cur_link,"roshare.info") !==false){
       $baza = file_get_contents($cur_link);
       $ret=unpack_DivXBrowserPlugin(2,$baza,true);
       $ret1=explode(",",$ret);
       $srt=$ret1[1];
       $link=$ret1[0];
     } elseif (strpos($cur_link,"rosharing.com") !==false) {
       $baza = file_get_contents($cur_link);
       $link = str_between($baza,'value="file=','&');
       $t1=explode('captions.file=',$baza);
       $t2=explode("&",$t1[1]);
       $srt=$t2[0];
       $srt = str_replace(" ","%20",$srt);
     } else {
       $link="";
       $srt="";
     }
//  if ($link <> $last_link) {
  if ($link <> "") {
        $server = str_between($link,"http://","/");
        $title=$server;
	    echo'
	    <item>
	    <title>'.$title.'</title>
        <onClick>
        <script>
        showIdle();
        url="'.$link.'";
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
        <tip>2</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
  if (($srt <> "") && (strpos($srt,".srt") !==false)) {
    	$f = "/usr/local/bin/home_menu";
	    echo'
	    <item>
	    <title>Play cu subtitrare</title>
        <onClick>
        <script>
        showIdle();
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($srt).'");
        url="'.$link.'";
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
        <download>'.$link.'</download>
        <tip>2</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
     }
  }
  $last_link = $link;
//  }
}
/**################ flash... mediafile,file.....############**/

//http://www.filmesubtitrate.info/2010/06/10-things-i-hate-about-you-sez1-ep1.html
//http://www.seriale.filmesubtitrate.info/2010/06/10-things-i-hate-about-you-sez1-ep1.html
//www.seriale.filmesubtitrate.info
if (strpos($filelink,"filmesubtitrate.info") !== false) {
///playerfs/plmfilmesub.php?lk=a8u25iq4cach
///playerfs/plmnowvideo.php?lk=2rzm75lkxawps
//peteava - http://www.seriale.filmesubtitrate.info/playerfs/peteava.php?lk=503993
//videoweed - http://www.seriale.filmesubtitrate.info/playerfs/plmweed.php?lk=gdubcouik7ogu&km=A.Seriale/Alcatraz%20S01E01
//novamov - http://www.seriale.filmesubtitrate.info/playerfs/plmnova.php?lk=f6uol0yy3s2sp&km=A.Seriale/Alcatraz%20S01E01
//vidbux - http://www.seriale.filmesubtitrate.info/playerfs/plmvidb.php?lk=e2tjkd08bok4&km=A.Seriale/Alcatraz%20S01E01
//vidxden - http://www.seriale.filmesubtitrate.info/playerfs/plmvidx.php?lk=1798z8fap6g3/Touch_S01E01.flv.html
///playerfs/plmvk.php?lk=106177506&id=163445800&hash=7fa53905d105372e&hd=1
$title = "";
$f = "/usr/local/bin/home_menu";
$videos = explode('playerfs', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode('"',$video);
 $link="http://www.seriale.filmesubtitrate.info/playerfs".$t1[0];

 if (strpos($link,"plmfilmesub") !== false) $title="roshare";
 if (strpos($link,"peteava") !== false) $title="peteava";
 if (strpos($link,"plmweed") !== false) $title="videoweed";
 if (strpos($link,"plmnova") !== false) $title="novamov";
 if (strpos($link,"plmvidb") !== false) $title="vidbux";
 if (strpos($link,"plmvidx") !== false) $title="vidxden";
 if (strpos($link,"plmnowvideo") !== false) $title="nowvideo";
 if (strpos($link,"plmvk") !== false) $title="vk";
 $link="http://127.0.0.1/cgi-bin/scripts/filme/php/link.php?file=".urlencode($link);
 if ($title <> "") {
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
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
        if (($mysrt <> "") || ($mysrt_google <> "") || ($viki_id <> "")){
        $f = "/usr/local/bin/home_menu";
	    echo'
	    <item>
	    <title>Play cu subtitrare</title>
        <onClick>
        <script>
        showIdle();
        ';
        if ($mysrt_google <> "") {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/google_xml.php?file='.urlencode($mysrt_google).'");';
        } else if ($viki_id <> "") {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/viki_xml.php?file='.$viki_id.'");';
        } else {
        echo '
        dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt_xml.php?file='.urlencode($mysrt).'");';
        }
        echo '
        movie="'.$link.'";
        url=getUrl(movie);
        cancelIdle();
        storagePath = getStoragePath("tmp");
        storagePath_stream = storagePath + "stream.dat";
        streamArray = null;
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, "");
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, url);
        streamArray = pushBackStringArray(streamArray, video/mp4);
        streamArray = pushBackStringArray(streamArray, "'.$pg_title.'");
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
        <download>'.$link.'</download>
        <tip>1</tip>
        <name>'.$titledownload.'.flv</name>
        </item>
        ';
     }
 }
}
}
//movieSrc=

?>
</channel>
</rss>
