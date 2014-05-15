#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $tit = urldecode($queryArr[0]);
   $tip = $queryArr[1];
   $page=$queryArr[2];
}
if ($page == "") $page=1;
//$page=1+ 100*($page-1);
?>
<rss version="2.0">
<onEnter>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";
  screenXp = 4;
  screenYp = 3;
  cancelIdle();
</onEnter>

<onExit>
  showIdle();
</onExit>

<mediaDisplay name=onePartView
  sideLeftWidthPC = 0
  sideRightWidthPC = 0
  sideColorRight="0:0:0"
  sideColorLeft="0:0:0"
  itemImageHeightPC="0"
  itemImageWidthPC="0"
  itemBackgroundColor="0:0:0"
  itemXPC="5"
  itemYPC="20"
  itemHeightPC="8"
  itemWidthPC="90"
  itemPerPage="9"
  itemGap="0"
  imageFocus=""
  imageUnFocus=""
  imageParentFocus=""
  capXPC="5"
  capYPC="20"
  capWidthPC="90"
  capHeightPC="9"
  bottomYPC="90"
  infoYPC="90"
  infoXPC="90"
  backgroundColor="0:0:0"
  showHeader=no
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

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="10" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

		<text offsetXPC=5 offsetYPC=11 widthPC=67 heightPC=8 fontSize=12 backgroundColor=80:80:80 foregroundColor=255:255:255>
      STATION
		</text>
		<text offsetXPC=72 offsetYPC=11 widthPC=9 heightPC=8 fontSize=12 backgroundColor=80:80:80 foregroundColor=255:255:255>
      LISTENERS
		</text>
		<text offsetXPC=81 offsetYPC=11 widthPC=8 heightPC=8 fontSize=12 backgroundColor=80:80:80 foregroundColor=255:255:255>
      BITRATE
		</text>
		<text offsetXPC=89 offsetYPC=11 widthPC=6 heightPC=8 fontSize=12 backgroundColor=80:80:80 foregroundColor=255:255:255>
      TYPE
		</text>

		<itemDisplay>
			<text offsetXPC=0 offsetYPC=0 widthPC=79 heightPC=100 fontSize=15>
				<script>
					idx = getQueryItemIndex();
					getItemInfo(idx, "name");
				</script>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "150:150:150"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "0:0:0"; else "200:200:200";
  				</script>
			  </foregroundColor>
			</text>
			<text offsetXPC=79 offsetYPC=0 widthPC=9 heightPC=100 fontSize=15 backgroundColor=-1:-1:-1 foregroundColor=100:100:100>
				<script>
					idx = getQueryItemIndex();
				  getItemInfo(idx, "lc");
				</script>
			</text>
			<text offsetXPC=86 offsetYPC=0 widthPC=7 heightPC=100 fontSize=15 backgroundColor=-1:-1:-1 foregroundColor=100:100:100>
				<script>
					idx = getQueryItemIndex();
				  getItemInfo(idx, "br");
				</script>
			</text>
			<text offsetXPC=93 offsetYPC=0 widthPC=7 heightPC=100 fontSize=15 backgroundColor=-1:-1:-1 foregroundColor=100:100:100>
				<script>
					idx = getQueryItemIndex();
				  mt = getItemInfo(idx, "mt");
				</script>
			</text>
		</itemDisplay>

    <onUserInput>
    <script>
    ret = "false";
    majorContext = getPageInfo("majorContext");
    minorContext = getPageInfo("minorContext");
    userInput = currentUserInput();

    if (userInput == "pagedown" || userInput == "pageup" || userInput == "PG" || userInput == "PD")
    {
      itemSize = getPageInfo("itemCount");
      idx = Integer(getFocusItemIndex());
      if (userInput == "pagedown" || userInput == "PD")
      {
        idx -= -9;
        if(idx &gt;= itemSize)
          idx = itemSize-1;
      }
      else
      {
        idx -= 9;
        if(idx &lt; 0)
          idx = 0;
      }
      setFocusItemIndex(idx);
    	setItemFocus(idx);
      redrawDisplay();
      ret = "true";
    }
    else if (userInput == "enter" || userInput == "ENTR") {
      idx = getFocusItemIndex();
      station_id = getItemInfo(idx, "id");
      executeScript("sub_Play");
      ret = "true";
    }
      else if (userInput == "one" || userInput == "1")
      {
      lpage=1;
      jumpToLink("destination");
      ret = "true";
      }
      else if (userInput == "two" || userInput == "2")
      {
      lpage=2;
      jumpToLink("destination");
      ret = "true";
      }
      else if (userInput == "three" || userInput == "3")
      {
      lpage=3;
      jumpToLink("destination");
      ret = "true";
      }
      else if (userInput == "four" || userInput == "4")
      {
      lpage=4;
      jumpToLink("destination");
      ret = "true";
      }
      else if (userInput == "five" || userInput == "5")
      {
      lpage=5;
      jumpToLink("destination");
      ret = "true";
      }
      redrawDisplay();
    ret;
    </script>
    </onUserInput>

	</mediaDisplay>

	<item_template>
    <mediaDisplay name=threePartsView idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
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

<sub_Play>
  station_id = getItemInfo(idx,"id");
  station_name = getItemInfo(idx,"name");
  station_mt = getItemInfo(idx,"mt");
  station_br = getItemInfo(idx,"br");
  station_genre = getItemInfo(idx,"genre");
  url = translate_base_url + "app,"+urlEncode("Station-id:"+station_id+";Station-name:"+station_name+";Station-br:"+station_br+";Station-mt:"+station_mt+";Station-genre:"+station_genre+";")+",shoutcast/station";

  showIdle();
  doModalRss(url);
</sub_Play>
<destination>
<link>
<script>
url="http://127.0.0.1/cgi-bin/scripts/tv/shoutcast_station.php?query=<?php echo urlencode($tit); ?>,<?php echo $tip; ?>" + "," + lpage;
url;
</script>
</link>
</destination>
<channel>
  <title><?php echo $tit." - display from:".$page; ?></title>
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$search = str_replace(" ","+",$tit);
if ($tip == "genre") {
  $link="http://www.shoutcast.com/genre-ajax/".$search;
  $post="strIndex=".$page."&count=100&ajax=true&mode=listeners&order=desc";
  $link="http://www.shoutcast.com/radiolist.cfm?start=".(($page-1)*18 + 1)."&action=sub&string=&cat=".$search."&amount=18&order=listeners&_cf_containerId=radiolist&_cf_nodebug=true&_cf_nocache=true&_cf_rc=1";
} elseif ($tip == "search") {
  $link="http://www.shoutcast.com/search-ajax/".$search;
  $post="strIndex=".$page."&count=100&ajax=true";
  $link="http://www.shoutcast.com/radiolist.cfm?start=".(($page-1)*18 + 1)."&action=search&string=".$search."&cat=&amount=18&order=listeners&_cf_containerId=radiolist&_cf_nodebug=true&_cf_nocache=true&_cf_rc=1";
}
//http://www.shoutcast.com/radiolist.cfm?start=19&action=search&string=romania&cat=&amount=18&order=listeners&_cf_containerId=radiolist&_cf_nodebug=true&_cf_nocache=true&_cf_rc=1
//http://www.shoutcast.com/radiolist.cfm?action=search&string=romania&cat=&_cf_containerId=radiolist&_cf_nodebug=true&_cf_nocache=true&_cf_rc=0

for ($i=0;$i<2;$i++) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,$link);
  //curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
//  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
//  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);
  if (strlen($html) > 5) break;
  sleep(1);
}
//echo $html;
$videos = explode('class="transition"', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('>',$video);
  $t2=explode('<',$t1[1]);
  $name=$t2[0];
  $name=str_replace("&","&amp;",$name);
  $t1=explode('id=',$video);
  $t2=explode('"',$t1[1]);
  $id=$t2[0];
  $t1=explode('width="10%">',$video);
  $t2=explode('<',$t1[1]);
  $gen=$t2[0];
  $t2=explode("<",$t1[2]);
  $lc=$t2[0];
  $t2=explode("<",$t1[3]);
  $br=$t2[0];
  $t2=explode("<",$t1[4]);
  $ct=$t2[0];
  /*
  $br=str_between($video,'class="dirbitrate">','<');
  $g=str_between($video,'Tags:','</div>');
  $gen=trim(preg_replace("/(<\/?)(\w+)([^>]*>)/e","",$g));
  $mt=str_between($video,'class="dirtype">','<');
  $lc=str_between($video,'class="dirlistners">','<');
  $t1=explode('<br>',$video);
  $t2=explode('</td',$t1[1]);
  $ct=$t2[0];
  */
  $ct=str_replace("&","&amp;",$ct);
  if (!preg_match("/manele/i",$gen) && !preg_match("/manele/i",$name)) {
  echo '
  <item>
  <name>'.$name.'</name>
  <mt>'.$mt.'</mt>
  <id>'.$id.'</id>
  <br>'.$br.'</br>
  <genre>'.$gen.'</genre>
  <ct>'.$ct.'</ct>
  <lc>'.$lc.'</lc>
  </item>
  ';
  }
}
?>
</channel>
</rss>
