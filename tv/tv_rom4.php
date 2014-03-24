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

print_ch("TVR 1", "http://93.113.204.11:40001",$a["TVR 1"]);
print_ch("TVR 2", "http://93.113.204.11:40002",$a["TVR 2"]);
print_ch("PRO TV", "http://93.113.204.11:40004",$a["PRO TV"]);
print_ch("PRO CINEMA", "http://93.113.204.11:40005",$a["PRO CINEMA"]);
print_ch("ACASA", "http://93.113.204.11:40006",$a["ACASA"]);
print_ch("Antena 1", "http://93.113.204.11:40007",$a["Antena 1"]);
print_ch("Euforia Lifestyle", "http://93.113.204.11:40009",$a["Euforia Lifestyle"]);
print_ch("Prima TV", "http://93.113.204.11:40012",$a["Prima TV"]);
print_ch("Kanal D", "http://93.113.204.11:40013",$a["Kanal D"]);
print_ch("National TV", "http://93.113.204.11:40014",$a["National TV"]);
print_ch("Realitatea TV", "http://93.113.204.11:40015",$a["Realitatea TV"]);
print_ch("Antena 3", "http://93.113.204.11:40016",$a["Antena 3"]);
print_ch("Discovery", "http://93.113.204.11:40040",$a["Discovery"]);
print_ch("Animal Planet", "http://93.113.204.11:40041",$a["Animal Planet"]);
print_ch("Sport.ro", "http://93.113.204.11:40043",$a["Sport.ro"]);
print_ch("Disney Channel", "http://93.113.204.11:40045",$a["Disney Channel"]);
print_ch("GSP TV", "http://93.113.204.11:40085",$a["GSP TV"]);
print_ch("CBS Reality", "http://93.113.204.11:40136",$a["CBS Reality"]);
print_ch("FILM", "http://93.113.204.11:40148",$a["FILM"]);
print_ch("RTL Plus", "http://93.113.204.11:40149",$a["RTL Plus"]);
?>
</channel>
</rss>
