#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);

$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}

function g_file ($link){
    $process = curl_init($link);
	curl_setopt($process, CURLOPT_HTTPGET, 1);
	curl_setopt($process, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($process,CURLOPT_CONNECTTIMEOUT, 5);
	$html = curl_exec($process);
	curl_close($process);
	return $html;
}

/* by jumpinjk start */

function get_remote_time($location, $switch){
//get_remote_time use a remote database (from http://twiki.org) to provide remote local time; the database is up to date.
//to use this service without buying an api is necessary to trick the file get operation by identify as Mozilla; curl will do this trick... ;-) 

//format: 	get_remote_time("Region/City", switch);
//examples:
//			get_remote_time("Europe/Bucharest", 5);
//			get_remote_time("Europe/London", 4);
//			get_remote_time("America/Toronto", 7);

//switches:
//			0 return current remote location day in week (ex: Sun for Sunday)
//			1 return current remote location day in a month (ex: 27)
//			2 return current remote location month (ex: May)
//			3 return current remote location year (ex: 2012)
//			4 return current remote location time (23:20:12 - HH:MM:SS)
//			5 return current remote location time shift related to GMT(+4:00 for GMT+4:00)
//			6 return current remote location zone abbreviation (ex: EEST stands for EEST – Eastern European Summer Time)
//			7 return remote location unprocessed string (ex: "Sun, 13 May 2012, 16:57:10 -0400 (EDT)" for America/Toronto)

	$link = "http://twiki.org/cgi-bin/xtra/tzdate?tz=".$location;
	$string = str_between(g_file($link), "<!--tzdate:date-->", "<!--/tzdate:date-->");
	if ($switch < 7) {
	 $stk = explode(" ",$string);
	 $stk[0] = trim($stk[0], ',');
	 $stk[5] = substr($stk[5],0,3).":".substr($stk[5],3);
	 $stk[6] = trim($stk[6], '(,)');
	return $stk[$switch];
	}
	return $string;
}

function get_local_time_zone () {
	$link = "http://www.ip2location.com";
	$string = str_between(g_file($link), ">Time Zone</label></td>", "</tr>");
    $string = str_between($string, '<label for="chkTimeZone">', "</label>");
	return $string;
}

//$ora1 = file_get_contents("/tmp/.clock.tmp"); // get machine clock (specific to DMD firmware)
//$oop = strftime("%H:%M",strtotime("now")); // get linux clock (non specific to platform)

$tz = get_local_time_zone();
$tz1 = get_remote_time("Europe/Bucharest", 5);
$ora1 = strtotime($tz) - strtotime($tz1);

/* by jumpinjk end */

$l="http://www.livehd.tv/live.php";
$h=file_get_contents($l);
$token=str_between($h,"token':'","'");
if ( $token == "" ); $token="6c69766568642e747620657374652063656c206d616920746172652121";
$url="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-T%20".$token."%20-l%202%20-a%20live%20-W%20http://www.livehd.tv/player/player.swf%20-p%20http://www.livehd.tv";
$l="http://www.livehd.tv/rtmp/flash-mbr.php";
$h=file_get_contents($l);
$rtmp=str_between($h,"streamer>","<");
?>
<rss version="2.0">
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
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="left" redraw="yes"
          lines="20" fontSize=15
		      offsetXPC=30 offsetYPC=25 widthPC=70 heightPC=75
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<!--
		<image  redraw="yes" offsetXPC=52 offsetYPC=20 widthPC=25 heightPC=25>
  /usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png
		</image>
		-->
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
					ora1="<?php echo $ora1 ?>";
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx) 
					{
					  location = "http://127.0.0.1/cgi-bin/scripts/tv/php/ph_prog.php?query=" + getItemInfo(idx, "location") + "," + ora1;
					  annotation = getURL(location);
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
else
{
annotation = " ";
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
<channel>
	<title><script>"OneHD (GMT" + "<?php echo $tz ?>" + ")";</script></title>
	<menu>main menu</menu>

<item>
<title>OneHD - Live! Mix</title>
<location>0</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20onehdhd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>OneHD - Live! Jazz</title>
<location>1</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20jazzhd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>OneHD - Live! Classics</title>
<location>2</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20classicshd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>


<item>
<title>OneHD - Live! Rock</title>
<location>3</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20rockhd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>OneHD - Live! Pop</title>
<location>4</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20pophd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>OneHD - Live! Dance</title>
<location>5</location>
<onClick>
<script>
url1="<?php echo $url; ?>" + "%20-y%20dancehd,<?php echo $rtmp?>";
playItemURL(url1, 10);
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<!--
<item>
<title>Divertisment</title>
<location></location>
<link><?php echo $host; ?>/scripts/tv/php/prahova.php?cat=Divertisment</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>Documentare</title>
<location></location>
<link><?php echo $host; ?>/scripts/tv/php/prahova.php?cat=Documentare</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>Emisiuni</title>
<location></location>
<link><?php echo $host; ?>/scripts/tv/php/prahova.php?cat=Emisiuni</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>

<item>
<title>Business</title>
<location></location>
<link><?php echo $host; ?>/scripts/tv/php/prahova.php?cat=Business</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/onehd.png" />
</item>
-->
</channel>
</rss>
