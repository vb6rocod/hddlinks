#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$a["Mooz HD"]="10272";
$a["Mooz Hits"]="10273";
$a["Mooz RO"]="10274";
$a["Mooz Dance"]="10275";
$a["Dolce Sport"]="10212";
$a["Dolce Sport 2"]="10225";
$a["Dolce Sport 3"]="";
$a["Dolce Sport HD"]="10281";
$a["FilmBox"]="10236";
$a["FilmBoxHD"]="10239";
$a["FilmBox Extra"]="10237";
$a["FilmBox Family"]="10238";
$a["AXN"]="10033";
$a["AXN Sci-Fi"]="10072";
$a["AXN Crime"]="10073";
$a["AXN Spin"]="10298";
$a["TV 1000"]="10060";
$a["Comedy Central Extra"]="10270";
$a["FilmPlus"]="";
$a["TCM"]="10054";
$a["Duck TV"]="10130";
$a["Disney Junior"]="10263";
$a["Disney"]="10018";
$a["Cartoon Network"]="10053";
$a["Nickelodeon"]="10110";
$a["Nick Jr"]="";
$a["PVTV"]="10204";
$a["Fight Box"]="";
$a["Viasat explorer"]="10039";
$a["Viasat history"]="10040";
$a["Viasat nature"]="10293";
$a["Travel Mix"]="10231";
$a["Travel Channel"]="10086";
$a["Docu Box HD"]="";
$a["Fashion TV"]="10078";
$a["Fashion BOX HD"]="10197";
$a["TVR HD"]="10190";
$a["TVR 1"]="10001";
$a["TVR 2"]="10002";
$a["TVR 3"]="10167";
$a["TVR International"]="10015";
$a["TVR News"]="";
$a["TVR Cluj"]="10153";
$a["TVR Timisoara"]="10220";
$a["TVR Iasi"]="10154";
$a["TVR Craiova"]="10219";
$a["TVR Targu Mures"]="10221";
$a["Antena 3"]="10055";
$a["Realitatea"]="10019";
$a["Money"]="10076";
$a["Romania TV"]="10245";
$a["KanalD"]="10097";
$a["OTV"]="";
$a["National TV"]="10031";
$a["N24"]="10048";
$a["B1"]="10022";
$a["Transilvania Look"]="10252";
$a["Transilvania Live"]="10217";
$a["Somes TV"]="";
$a["Neptun TV"]="10151";
$a["Giga TV"]="10249";
$a["Trinitas"]="10145";
$a["Alfa & Omega"]="10137";
$a["Speranta TV"]="10134";
$a["Nasul TV"]="10256";
$a["City TV"]="10258";
$a["Inedit TV"]="10300";
$a["Valea Prahovei TV"]="10214";
$a["H2O TV"]="10029";
$a["RTL Klub"]="";
$a["DW"]="10131";
$a["CNN"]="10115";
$a["France 24"]="10128";
$a["Hit music channel"]="10299";
$a["Kiss TV"]="10008";
$a["UTV"]="10096";
$a["Favorit"]="10071";
$a["Party"]="";
$a["Taraf"]="10101";
$a["Etno"]="10037";
$a["Mynele"]="10206";
$a["Bollywood TV"]="10246";
$a["Bollywood Classic"]="10248";
$a["Bolly Show"]="";
?>
<rss version="2.0">
<onEnter>
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
  startitem = "middle";
  setRefreshTime(1);
  server1 = "fms30.mediadirect.ro";
  dinamic = "Da";
  token_p="2deb479bf15a669454b937eb";
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
		  <script>getPageInfo("pageTitle") + " (" + sprintf("%s / ", focus-(-1))+itemCount + ")";</script>
		</text>

  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=modifica aspect, dreapta pentru program
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
		if (server1 == "fms1.mediadirect.ro")
           server1 = "fms2.mediadirect.ro";
		else if (server1 == "fms2.mediadirect.ro")
           server1 = "fms8.mediadirect.ro";
		else if (server1 == "fms8.mediadirect.ro")
          server1 = "fms15.mediadirect.ro";
		else if (server1 == "fms15.mediadirect.ro")
          server1 = "fms27.mediadirect.ro";
		else if (server1 == "fms27.mediadirect.ro")
          server1 = "fms30.mediadirect.ro";
		else if (server1 == "fms30.mediadirect.ro")
          server1 = "fms32.mediadirect.ro";
		else if (server1 == "fms32.mediadirect.ro")
          server1 = "fms38.mediadirect.ro";
		else if (server1 == "fms38.mediadirect.ro")
          server1 = "fms42.mediadirect.ro";
		else if (server1 == "fms42.mediadirect.ro")
          server1 = "fms1.mediadirect.ro";
        else
		 server1 = "fms1.mediadirect.ro";
  redrawDisplay();
  ret = "true";
}
else if (userInput == "one" || userInput == "1")
{
 if (dinamic == "Nu")
   dinamic = "Da";
 else if (dinamic == "Da")
   dinamic = "Nu";
  redrawDisplay();
  ret = "true";
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
	<title>MediaDirect</title>
	<menu>main menu</menu>
<item>
<title>Personal token</title>
<onClick>
<script>
optionsPath="/usr/local/etc/dvdplayer/mediadirect_token.dat";
keyword = getInput();
if (keyword != null)
{
writeStringToFile(optionsPath, keyword);
}
</script>
</onClick>
 </item>
<?php
$l="http://portaltv.ro/sn.php?token=";
$html=file_get_contents($l);
$videos = explode('m3u.php', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
 $t1=explode("'",$video);
 $link="http://portaltv.ro/m3u.php".$t1[0];
 $t2=explode('"nume">',$video);
 $t3=explode("<",$t2[1]);
 $title=trim($t3[0]);
 echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     config=getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file='.urlencode($link).'");
     arr=readStringFromFile("/tmp/mediadirect.txt");
    y=getStringArrayAt(arr, 1);
    token=getStringArrayAt(arr, 2);
	if (dinamic == "Da")
	  server = getStringArrayAt(arr, 0);
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-W%20http://static1.mediadirect.ro/mediaplayer/players/0012/player.swf%20-a%20live3/_definst_?token=" + token + "%20-y%20" + y + ",rtmp://" + server + ":1935/live3/_definst_";
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
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer.rss");
     </script>
     </onClick>
     <id>'.$a[$title].'</id>
     </item>
  ';
}
?>
</channel>
</rss>
