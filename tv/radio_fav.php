#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF-8' ?>";
$host = "http://127.0.0.1/cgi-bin";
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
	itemWidthPC="45"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="45"
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
		<image  redraw="yes" offsetXPC=60 offsetYPC=22.5 widthPC=30 heightPC=30>
  ../etc/translate/rss/image/radio_online.jpg
		</image>
		<text align="justify" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42
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
					  annotation = getItemInfo(idx, "annotation");
					  if(annotation == "" || annotation == null)
					    annotation = getItemInfo(idx, "stream_genre");
					  streamurl = getItemInfo(idx, "stream_url");
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
      majorContext = getPageInfo("majorContext");

      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);

      if(userInput == "enter" || userInput == "ENTR")
      {
        showIdle();
        focus = getFocusItemIndex();
        stream_u = "http://127.0.0.1/cgi-bin/scripts/tv/php/german_link.php?file=" + getItemInfo(focus, "location");
        stream_url = getUrl(stream_u);
        request_title = getItemInfo(focus, "title");
        request_url = getItemInfo(focus, "location");
        request_options = getItemInfo(focus, "options");
        request_image = getItemInfo(focus, "image");

        stream_title = getItemInfo(focus, "stream_title");
        stream_type = getItemInfo(focus, "stream_type");
        stream_protocol = getItemInfo(focus, "stream_protocol");
        stream_soft = getItemInfo(focus, "stream_soft");
        stream_class = getItemInfo(focus, "stream_class");
        stream_server = getItemInfo(focus, "stream_server");
        stream_status_url = "";
        stream_current_song = "";
        stream_genre = getItemInfo(focus, "stream_genre");
        stream_bitrate = getItemInfo(focus, "stream_bitrate");
        playlist_autoplay = getItemInfo(focus, "autoplay");

        if(playlist_autoplay == "" || playlist_autoplay == null)
          playlist_autoplay = 1;

        if(stream_class == "" || stream_class == null)
          stream_class = "unknown";

        if(stream_url == "" || stream_url == null)
          stream_url = request_url;

        if(stream_server != "" &amp;&amp; stream_server != null)
          stream_status_url = translate_base_url + "status," + urlEncode(stream_server) + "," + urlEncode(stream_url);

        if(stream_title == "" || stream_title == null)
          stream_title = request_title;

        if(stream_url != "" &amp;&amp; stream_url != null)
        {
          if(stream_protocol == "file" || (stream_protocol == "http" &amp;&amp; stream_soft != "shoutcast"))
          {
            url = stream_url;
          }
          else
          {
            if(stream_type != null &amp;&amp; stream_type != "")
            {
              request_options = "Content-type:"+stream_type+";"+request_options;
            }
            url = translate_base_url + "stream," + request_options + "," + urlEncode(stream_url);
          }

          executeScript(stream_class+"Dispatcher");
        }

        cancelIdle();
        ret = "true";
      }
      else if(userInput == "right" || userInput == "R")
      {
        ret = "true";
      }
      else if (userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG")
      {
        itemSize = getPageInfo("itemCount");
        idx = Integer(getFocusItemIndex());
        if (userInput == "pagedown")
        {
          idx -= -8;
          if(idx &gt;= itemSize)
            idx = itemSize-1;
        }
        else
        {
          idx -= 8;
          if(idx &lt; 0)
            idx = 0;
        }
        setFocusItemIndex(idx);
        setItemFocus(idx);
        redrawDisplay();
        ret = "true";
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
  <audioDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, request_url);
    streamArray = pushBackStringArray(streamArray, request_options);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, stream_type);
    streamArray = pushBackStringArray(streamArray, stream_status_url);
    streamArray = pushBackStringArray(streamArray, stream_current_song);
    streamArray = pushBackStringArray(streamArray, stream_genre);
    streamArray = pushBackStringArray(streamArray, stream_bitrate);
    streamArray = pushBackStringArray(streamArray, stream_title);
    streamArray = pushBackStringArray(streamArray, request_image);
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/audioRenderer.rss");
  </audioDispatcher>
<channel>
	<title>Radio - listă preferate</title>
	<menu>main menu</menu>
<?php
if (file_exists("/tmp/usbmounts/sda1/radio.m3u")) {
   $dir = "/tmp/usbmounts/sda1";
} elseif (file_exists("/tmp/usbmounts/sdb1/radio.m3u")) {
   $dir = "/tmp/usbmounts/sdb1";
} elseif (file_exists("/tmp/usbmounts/sdc1/radio.m3u")) {
   $dir = "/tmp/usbmounts/sdc1";
} elseif (file_exists("/tmp/usbmounts/sda2/radio.m3u")) {
   $dir = "/tmp/usbmounts/sda2";
} elseif (file_exists("/tmp/usbmounts/sdb2/radio.m3u")) {
   $dir = "/tmp/usbmounts/sdb2";
} elseif (file_exists("/tmp/usbmounts/sdc2/radio.m3u")) {
   $dir = "/tmp/usbmounts/sdc2";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/radio.m3u")) {
   $dir = "/tmp/hdd/volumes/HDD1";
} elseif (file_exists("/tmp/hdd/volumes/HDD2/radio.m3u")) {
   $dir = "/tmp/hdd/volumes/HDD2";
} else {
     $dir = "";
}
$f=$dir."/radio.m3u";
if (!file_exists($f)) {
echo '
<item>
<annotation>Salvaţi lista cu posturile de radio preferate în fişierul "radio.m3u". Copiaţi acest fişier pe Hard Disk sau USB.</annotation>
</item>
';
} else {
$m3uFile = file($f);
$buffer = array();
foreach($m3uFile as $line) {
if($line != "\n" || $line != "\r" || $line != "\r\n" || $line != "\n\r")
  $buffer[] = $line;
}
$m3uFile = $buffer;
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 8)) == "#EXTINF:") {
    $line = substr_replace($line, "", 0, 8);
    $line = explode(",", $line, 2);

    //$m3uFile_SongLengths[]   = $line[0];
    //$m3uFile_SongTitles[]    = $line[1];
    //$m3uFile_SongLocations[] = $m3uFile[$key + 1];
    $title = $line[1];
    //$title=str_replace("/","",$title);
    $link =  $m3uFile[$key + 1];
    echo '
    <item>
    <title>'.$title.'</title>
    <location>'.$link.'</location>
    <annotation>'.$title.'</annotation>
    <stream_url>'.$f.'</stream_url>
    <stream_class>audio</stream_class>
    <stream_title>'.$title.'</stream_title>
    </item>
    ';
        
      }
    }
}
?>


</channel>
</rss>
