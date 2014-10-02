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
		  <script>getPageInfo("pageTitle") + " (" + sprintf("%s / ", focus-(-1))+itemCount + ")";</script>
		</text>

  	<text align="left" redraw="yes" offsetXPC="5" offsetYPC="15" widthPC="80" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Dreapta pt. program. Apasati 2 pentru modificare buffer. Buffer curent: " + buf;</script>
		</text>

		<text align="left" redraw="yes"
          lines="18" fontSize=15
		      offsetXPC=30 offsetYPC=25 widthPC=70 heightPC=65
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
					  location = getItemInfo(idx, "location");
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
server = "";
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
else if(userInput == "right" || userInput == "R")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/cinemagia_prog.php?file=" + getItemInfo(idx,"id");
annotation = getURL(url_canal);
cancelIdle();
redrawDisplay();
ret = "true";
}
else
{
annotation = " ";
redrawDisplay();
ret = "false";
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

<channel>
	<title>Seenow TV</title>
	<menu>main menu</menu>
<?php
function print_ch($ch_title,$ch_id,$ch_pg_id,$ch_prog) {
$ch_title=str_replace('+'," ",$ch_title);
echo '
     <item>
     <title>'.$ch_title.'</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/seenow_tv_link.php?file='.$ch_id.','.$ch_pg_id.'," + buf;
     url1=getUrl(url);
     movie="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream," + url1;
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$ch_title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
    <id>'.$ch_prog.'</id>
     </item>
';
}
print_ch("Alfa+Omega+TV", "8293","60","alfa-omega-tv");
 print_ch("AXN", "11144","60","axn");
 print_ch("AXN Black", "11148","60","axn-black");
 print_ch("AXN White", "11145","60","axn-white");
 print_ch("AXN Spin", "11147","60","axn-spin");
 print_ch("Digi+24", "82730","60","digi-24");
 print_ch("B1+TV", "6820","60","b1-tv");
 print_ch("Boomerang", "7492","60","boomerang");
 print_ch("CNN", "6823","60","cnn");
 print_ch("Cartoon+Network", "7508","60","cartoon-network");
 print_ch("Comedy+Central", "9435","60","comedy-central");
 print_ch("Deutsche+Welle", "6845","60","deutsche-welle");
 print_ch("Disney+Channel", "7460","60","disney-channel");
 print_ch("Disney+Junior", "7461","60","disney-junior");
 print_ch("Docu+Box", "8708","62","docu-box");
 print_ch("Etno+TV", "6839","60","etno-tv");
 print_ch("Fashion+Box", "8712","62","fashion-box");
 print_ch("Fashion+TV", "6826","60","fashion-tv");
 print_ch("Favorit+TV", "6840","60","favorit-tv");
 print_ch("France+24", "6846","60","france-24");
 print_ch("FightBox", "8714","62","fightbox");
 print_ch("FilmBox", "7463","62","filmbox");
 print_ch("FilmBox+Family", "7466","62","filmbox-family");
 print_ch("FilmBox+HD", "7467","62","filmbox-hd");
 print_ch("FilmBox+Plus", "7462","62","filmbox-plus");
 print_ch("Inedit+TV", "7747","60","inedit-tv");
 print_ch("Kanal+D", "6822","60","kanal-d");
 print_ch("Look+TV", "89499","5514","transilvania-look");
 print_ch("Look PLUS", "89498","5514","transilvania-live");
 print_ch("Kiss+TV", "6833","60","kiss-tv");
 print_ch("Money", "60793","60","money");
 print_ch("Music+Channel", "6849","60","music-channel");
 print_ch("Mynele+TV", "8318","60","mynele-tv");
 print_ch("Nasul+TV", "6824","60","nasul-tv");
 print_ch("National+24+Plus", "6829","60","national-24-plus");
 print_ch("National+TV", "6828","60","national-tv");
 print_ch("Neptun+TV", "6847","60","neptun-tv");
 print_ch("Nick+Jr", "9088","60","nick-jr");
 print_ch("Nickelodeon", "7503","60","nickelodeon");
 print_ch("OTV", "6830","60","otv");
 print_ch("Tvh", "85225","60","tvh");
 print_ch("Romania+TV", "6818","60","romania-tv");
 print_ch("Realitatea+TV", "6817","60","realitatea-tv");
 print_ch("Speranta+TV", "8310","60","speranta-tv");
 print_ch("TV+City", "8311","60","tv-city");

 print_ch("TV5", "6851","60","tv5");
 print_ch("TVR+1", "6855","60","tvr-1");
 print_ch("TVR+2", "6856","60","tvr-2");
 print_ch("TVR+3", "6857","60","tvr-3");
 print_ch("TVR+Cluj", "6858","60","tvr-cluj");
 print_ch("TVR+Craiova", "6862","60","tvr-craiova");
 print_ch("TVR+Iasi", "6860","60","tvr-iasi");
 print_ch("TVR+International", "6821","60","tvr-international");
 print_ch("TVR+News", "6854","60","tvr-news");
 print_ch("TVR+Targu-Mures", "6859","60","tvr-targu-mures");
 print_ch("TVR+Timisoara", "6861","60","tvr-timisoara");
 print_ch("U+TV", "6834","60","u-tv");
 print_ch("Taraf+TV", "8320","60","taraf-tv");
 print_ch("TV+1000", "10665","60","tv-1000");
 print_ch("Travel+Channel", "6852","60","travel-channel");
 print_ch("Travel+Mix", "8317","60","travel-mix");
 print_ch("Credo TV", "85219","60","credo-tv");
 print_ch("Trinitas+TV", "6832","60","trinitas-tv");
 print_ch("Valea+Prahovei+TV", "8316","60","valea-prahovei-tv");
 print_ch("Viasat+Explorer", "6865","60","viasat-explorer");
 print_ch("Viasat+History", "6866","60","viasat-history");
 print_ch("Viasat+Nature", "6867","60","viasat-nature");


?>
</channel>
</rss>
