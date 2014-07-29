#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
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
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="70" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=modifica aspect, dreapta pentru program...
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
					  adn = getItemInfo(idx, "adn");
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
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "right" || userInput == "R")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/dolce_prog.php?file=" + getItemInfo(idx,"id");
annotation = getURL(url_canal);
cancelIdle();
redrawDisplay();
ret = "true";
}
else
{
annotation = " ";
ret = "false";
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
  <title>TV Romania</title>
<?php
function print_ch($title,$link,$id) {
if (!preg_match("/(<\/?)(\w+)([^>]*>)/e",$title) && !preg_match("/\.php|\.htm/",$link)) {
  echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     movie="'.$link.'";
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
     <id>'.$id.'</id>
     </item>
     ';
}
}
$a["Antena 1"]="10017";
$a["Antena 2"]="10119";
$a["Antena 3"]="10055";
$a["B1 Tv"]="10022";
$a["BBC News"]="10100";
$a["Bloomberg"]="10195";
$a["CNN"]="10115";
$a["CT24"]="";
$a["Cartoon Network"]="10053";
$a["Credo TV"]="10223";
$a["Discovery"]="10020";
$a["Diva"]="10027";
$a["DocQ Klub"]="";
$a["ERT World"]="";
$a["Etno TV"]="10037";
$a["Euforia Lifestyle"]="10063";
$a["Euro TV"]="";
$a["Euronews"]="10113";
$a["Fashion TV"]="10078";
$a["Fishing&Hunting"]="";
$a["GSP TV"]="10155";
$a["Jurnal TV"]="";
$a["Karma TV"]="";
$a["Kiss TV"]="10008";
$a["Megamax"]="10268";
$a["Minimax"]="10023";
$a["Money Channel"]="";
$a["Money Ro"]="10076";
$a["Mooz Dance"]="10275";
$a["Music 1 Channel"]="10158";
$a["Muz TV"]="";
$a["Mynele TV"]="10206";
$a["N24 Plus"]="10048";
$a["NBT"]="";
$a["NHK World"]="";
$a["Nasul TV"]="10256";
$a["National TV"]="";
$a["OTV"]="";
$a["Prima TV"]="10005";
$a["Publika TV"]="";
$a["RTV"]="10245";
$a["Realitatea TV"]="10019";
$a["Ru TV"]="";
$a["TV Sud Est"]="10250";
$a["TV5 Europe"]="";
$a["TV5 Monde"]="";
$a["TVR 1"]="10001";
$a["TVR 2"]="10002";
$a["Taraf TV"]="10101";
$a["Transilvania L!VE"]="10217";
$a["PRO TV"]="100007";
$a["PRO CINEMA"]="10036";
$a["ACASA"]="10004";
$a["Kanal D"]="10097";
$a["Animal Planet"]="10021";
$a["Sport.ro"]="10032";
$a["Disney Channel"]="10018";
$a["CBS Reality"]="10050";
$a["FILM"]="";
$a["RTL Plus"]="";
$a["LOOK TV"]="10252";
$a["FilmBox"]="10236";
$a["FilmBox HD"]="10239";
/*
$l="http://tastez.ro/tv.php?query=norma-telecom";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
*/
/*
$l="http://tastez.ro/tv.php?query=altele";

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
*/
$l="http://tastez.ro/tv.php?query=regional";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
$l="http://tastez.ro/tv.php?query=moldova";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
print_ch("PVTV", "http://92.61.114.188:8080/pvtv-ro.flv",$a["PVTV"]);
//print_ch("Dolcesport 1", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://178.21.120.198:1936/live3/flv:dolcesport",$a["DolceSport 1"]);
//print_ch("Antena Monden", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://stream1.aplay.ro:1935/live/_definst_/mp4:AntenaMonden_1000","Antena Monden");
//print_ch("Antena News", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://stream1.aplay.ro:1935/live/_definst_/mp4:AntenaNews_1000","Antena News");
//print_ch("Antena Stars", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://stream1.aplay.ro:1935/live/_definst_/mp4:AntenaStars_1000","Antena Stars");
//print_ch("Antena 2", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live%20-W%20http://ivm.inin.ro/swf/player_live4.swf%20-p%20http://www.antena2.ro/live%20-y%20a2%20-x%20122410%20-w%2099fa9798751989f276ed92c5b269b7db02fd48d614e993d2f659da1a0d537dbb,rtmp://live1.gsp.ro/live",$a["Antena 2"]);
print_ch("Antena 3", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://93.115.84.226:1935/live/a3",$a["Antena 3"]);
//print_ch("Banat TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://81.18.66.155/live/banat-tv",$a["Banat TV"]);
print_ch("LOOK TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://193.239.252.30/LookTV/ll3",$a["LOOK TV"]);
print_ch("EST TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://81.12.152.250/live/esttv",$a["EST TV"]);
print_ch("WEST TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://86.106.82.47/westtv_live/livestream.flv",$a["WESt TV"]);
print_ch("Informatia TV", "http://94.60.44.130:8014/stream.flv",$a["Informatia TV"]);
print_ch("PRO TV News", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-y%20mp4:live1.mp4%20-W%20http://d1.a4w.ro/customFlow/flowplayer-3.2.12.swf%20-p%20http://stirileprotv.ro/protvnews,rtmp://live.protv.ro/news/",$a["PRO TV News"]);
print_ch("6TV", "http://89.149.7.178:8800/flv-audio-video/",$a["6TV"]);
print_ch("RTV", "http://rtvflash.smcmobile.ro:8010/rtv.flv",$a["RTV"]);
print_ch("Moldova 1", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://212.0.211.109/live/livestream",$a["Moldova 1"]);
print_ch("BUSUIOC", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://46.55.25.186/live/direct",$a["BUSUIOC"]);
print_ch("Oltenia TV", "http://127.0.0.1/cgi-bin/translate?stream,,http://77.36.61.158:7081",$a["Oltenia TV"]);
print_ch("TV KIT", "http://127.0.0.1/cgi-bin/translate?stream,,http://86.126.136.126:8061",$a["TV KIT"]);
print_ch("VEST TV RESITA", "http://89.35.144.234/live.flv",$a["VEST TV RESITA"]);
print_ch("BIT  TV", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://89.32.216.2/flvplayback/ts_4_4130_4129",$a["BIT  TV"]);
print_ch("InfoPescar TV", "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.infopescar.tv/pvtv.htm,rtmp://ak.neoflux.co.uk:1935/infopescar/rtmp",$a["InfoPescar TV"]);
print_ch("Avocat TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://89.32.216.2/flvplayback/ts_8_4162_4161",$a["Avocat TV"]);
print_ch("Nova TV Brasov", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://86.123.165.135/live/myStream",$a["Nova TV Brasov"]);
print_ch("TvM", "http://tvm.ambra.ro",$a["TvM"]);
print_ch("Salajeanul TV", "http://94.52.213.67:8084/stream.flv",$a["Salajeanul TV"]);
print_ch("Tele M", "http://127.0.0.1/cgi-bin/translate?stream,,http://telem.telem.ro:8780/telem_live.flv",$a["Tele M"]);
print_ch("Prahova TV", "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.prahovatv.ro/player/player.swf%20-T%206c69766568642e747620657374652063656c206d616920746172652121%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.prahovatv.ro/,rtmp://89.45.186.26:1935/live/prahovatv",$a["Prahova TV"]);
print_ch("Jurnal TV", "http://127.0.0.1/cgi-bin/translate?stream,,http://ch0.jurnaltv.md/channel0.flv",$a["Jurnal TV"]);
print_ch("Muscel TV", "http://127.0.0.1/cgi-bin/translate?stream,,http://musceltvlive.muscel.ro:8080/",$a["Muscel TV"]);
print_ch("eMARAMURES", "http://127.0.0.1/cgi-bin/translate?stream,,http://195.28.2.42:8083/stream.flv",$a["eMARAMURES"]);
print_ch("Orizont tv", "http://94.60.44.130:8016/stream.flv",$a["Orizont tv"]);
print_ch("IBS", "http://94.60.44.130:8006/stream.flv",$a["IBS"]);
print_ch("itv", "http://94.60.44.130:8014/stream.flv",$a["itv"]);
print_ch("Noroc TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://live.noroc.tv/livepkgr/live/livestream_2.flv",$a["Noroc TV"]);
print_ch("Popular Tv", "http://46.102.56.219:8084/stream.flv",$a["Popular Tv"]);
print_ch("M1", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://212.0.211.109/live/livestream",$a["M1"]);
print_ch("Kiss TV", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://kisstelevision.es.flash3.glb.ipercast.net/kisstelevision.es-live/live",$a["Kiss TV"]);
print_ch("TV City", "http://127.0.0.1/cgi-bin/translate?stream,,rtmp://tvcity.ro:1935/live/livestream1",$a["TV City"]);
?>
</channel>
</rss>
