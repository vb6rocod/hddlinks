#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
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
	itemWidthPC="50"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="50"
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
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
  image/tv_radio.png
		</image>
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
	<title>Czech &amp; Slovak TV</title>
	<menu>main menu</menu>
<item>
<title>Markiza</title>
<onClick>playItemURL("http://88.212.35.223:2002",10);</onClick>
</item>

<item>
<title>STV1</title>
<onClick>playItemURL("http://88.212.35.222:2001",10);</onClick>
</item>

<item>
<title>STV2</title>
<onClick>playItemURL("http://88.212.35.223:2001",10);</onClick>
</item>

<item>
<title>Joj</title>
<onClick>playItemURL("http://88.212.35.226:2002",10);</onClick>
</item>

<item>
<title>Joj plus</title>
<onClick>playItemURL("http://88.212.35.228:2002",10);</onClick>
</item>

<item>
<title>Doma TV</title>
<onClick>playItemURL("http://88.212.35.227:2002",10);</onClick>
</item>

<item>
<title>TA3</title>
<onClick>playItemURL("http://88.212.35.224:2002",10);</onClick>
</item>

<item>
<title>Nova 2</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/nova2",10);</onClick>
</item>

<item>
<title>Cinema</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/cinema",10);</onClick>
</item>

<item>
<title>Prima</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/prima",10);</onClick>
</item>

<item>
<title>Prima Love</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/primalove",10);</onClick>
</item>

<item>
<title>Prima Cool</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/primacool",10);</onClick>
</item>

<item>
<title>CT 1</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/ct1",10);</onClick>
</item>

<item>
<title>CT 2</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/ct2",10);</onClick>
</item>

<item>
<title>CT4 Sport</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/ct4sportd",10);</onClick>
</item>

<item>
<title>CT24</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/ct24",10);</onClick>
</item>

<item>
<title>Barrandov</title>
<onClick>playItemURL("http://tv5.sychrovnet.cz:7999/c/barrandov",10);</onClick>
</item>

    <item>
    <title>Ocko</title>
    <onClick>playItemUrl("http://tv5.sychrovnet.cz:7999/c/ocko",10);</onClick>
    </item>

    <item>
    <title>Musicbox</title>
    <onClick>playItemUrl("http://88.212.35.225:2002",10);</onClick>
    </item>

    <item>
    <title>Musiq 1</title>
    <onClick>playItemUrl("http://88.212.35.225:2001",10);</onClick>
    </item>

    <item>
    <title>TV FUN1</title>
    <onClick>playItemUrl("http://127.0.0.1/cgi-bin/translate?stream,,mms://portal.satplus.cz/TV_FUN1",10);</onClick>
    </item>
</channel>
</rss>
