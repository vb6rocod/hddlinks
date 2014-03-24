#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  server1 = "fms30.mediadirect.ro";
  dinamic = "Da";
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
  	<text redraw="no" align="left" offsetXPC="6" offsetYPC="15" widthPC="78" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Apăsaţi 1 pentru server static/dinamic, 2 pentru schimbare server static.
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<image  redraw="yes" offsetXPC=50 offsetYPC=25 widthPC=30 heightPC=30>
  image/tv_radio.png
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Server curent: " + server;</script>
		</text>

  	<text  redraw="yes" align="left" offsetXPC="55" offsetYPC="70" widthPC="45" heightPC="8" fontSize="17" backgroundColor="0:0:0" foregroundColor="255:255:255">
    <script>"Server dinamic: " + dinamic;</script>
		</text>
  	<text  redraw="yes" align="left" offsetXPC="55" offsetYPC="80" widthPC="45"  heightPC="8" fontSize="17" backgroundColor="0:0:0" foregroundColor="255:255:255">
    <script>"Server static: " + server1;</script>
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
	<title>TVR Plus</title>
	<menu>main menu</menu>
<!-- http://www.mediadirect.ro/tv/ -->
	<item>
	<title>TVR HD</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvrhd?id=10668839&publisher=4%20-y%20tvrhd?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvrhd";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR HD</annotation>
	</item>

	<item>
	<title>TVR 1</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvr1?id=10668839&publisher=4%20-y%20tvr1?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvr1";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR 1</annotation>
	</item>
	<item>
	<title>TVR 2</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvr2?id=10668839&publisher=4%20-y%20tvr2?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvr2";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR 2</annotation>
	</item>
	<item>
	<title>TVR 3</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvr3?id=10668839&publisher=4%20-y%20tvr3?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvr3";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR 3</annotation>
	</item>
	<item>
	<title>TVR Info</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvrinfo?id=10668839&publisher=4%20-y%20tvrinfo?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvrinfo";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR Info</annotation>
	</item>
	<item>
	<title>TVR International</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvr?id=10668839&publisher=4%20-y%20tvr?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvr";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR International</annotation>
	</item>
	<item>
	<title>TVR Cultural</title>
	<onClick>
	<script>
	if (dinamic == "Da")
	  server = getUrl("http://127.0.0.1/cgi-bin/scripts/util/mediadirect_server.php?file=4");
    else
      server = server1;
	movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-a%20live/tvrcultural?id=10668839&publisher=4%20-y%20tvrcultural?id=10668839&publisher=4%20-W%20http://static1.mediadirect.ro/player-preload/swf/tvrplus_1148/player.swf%20-p%20http://www.tvrplus.ro,rtmp://" + server + ":1935/live/tvrcultural";
	playItemUrl(movie,10);
	</script>
	</onClick>
	<annotation>TVR Cultural</annotation>
	</item>


</channel>
</rss>
