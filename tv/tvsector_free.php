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
  server = "s6";
  setRefreshTime(1);

</onEnter>
<onRefresh>
    itemCount = getPageInfo("itemCount");
    setRefreshTime(-1);
    redrawdisplay();
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
	itemWidthPC="35"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="35"
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
  	<text redraw="yes" align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi 2 pentru alt server. Server curent: " + server;</script>
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="center" redraw="yes" fontSize=24 offsetXPC=60 offsetYPC=60 widthPC=30 heightPC=10 backgroundColor=0:0:0 foregroundColor=200:200:200>
        <script>print(annotation); annotation;</script>
        </text>
		<image align="center" redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=20>
		<script>print(img); img;</script>
		</image>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Apăsaţi 2 pentru alt server. Server curent: " + server;</script>
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
					  img = getItemInfo(idx, "image");
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
  "true";
}
else if (userInput == "two" || userInput == "2")
{
		if (server == "s7")
           server = "s6";
		else if (server == "s6")
           server = "s5";
		else if (server == "s5")
          server = "s7";
        else
		 server = "s6";
  ret = "true";
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
	<title>High Definition TV</title>
	<menu>main menu</menu>

    <item>
    <title>Animal Planet</title>
    <image>http://www.futubox.to/system/icon_ds/32/original/animal_planet.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050001.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>BBC</title>
    <image>http://www.futubox.to/system/icon_ds/223/original/bbc.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010201.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Bio</title>
    <image>http://www.futubox.to/system/icon_ds/172/original/biohd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050239.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>CCTV News</title>
    <image>http://www.futubox.to/system/icon_ds/216/original/cctvnews.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050222.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Cinemax</title>
    <image>http://www.futubox.to/system/icon_ds/164/original/cinemax_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050221.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Comedy Central</title>
    <image>http://www.futubox.to/system/icon_ds/65/original/comedy_central.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020503.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Discovery Channel</title>
    <image>http://www.futubox.to/system/icon_ds/96/original/discovery_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050240.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Disney XD</title>
    <image>http://www.futubox.to/system/icon_ds/37/original/disney_xd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020101.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>E4</title>
    <image>http://www.futubox.to/system/icon_ds/261/original/e4ukhd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050233.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>ESPN America</title>
    <image>http://www.futubox.to/system/icon_ds/185/original/espn.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050201.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Eurosport</title>
    <image>http://www.futubox.to/system/icon_ds/30/original/eurosport_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010601.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Eurosport 2</title>
    <image>http://www.futubox.to/system/icon_ds/167/original/eurosport2hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010301.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>FX</title>
    <image>http://www.futubox.to/system/icon_ds/262/original/fx_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050232.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>History Channel</title>
    <image>http://www.futubox.to/system/icon_ds/118/original/history.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050003.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>itv 2</title>
    <image>http://www.futubox.to/system/icon_ds/195/original/itv2.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020102.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>itv 3</title>
    <image>http://www.futubox.to/system/icon_ds/196/original/itv3.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020103.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>MGM</title>
    <image>http://www.futubox.to/system/icon_ds/194/original/mgm.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020401.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>MTV Live</title>
    <image>http://www.futubox.to/system/icon_ds/230/original/mtv.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010001.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Nat Geo Wild</title>
    <image>http://www.futubox.to/system/icon_ds/44/original/Natgeowild.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050238.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>National Geographic Channel</title>
    <image>http://www.futubox.to/system/icon_ds/249/original/natgeohd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050225.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <!-- item>
    <title>National Geographic Channel</title>
    <image>http://www.futubox.to/system/icon_ds/107/original/natgeohd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050203.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item -->

    <!-- item>
    <title>Nickelodeon HD</title>
    <image>http://www.futubox.to/home/img/sign_in_logo.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z020502.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item -->

    <item>
    <title>Sky Arts</title>
    <image>http://www.futubox.to/system/icon_ds/181/original/sky_arts_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050242.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Action & Adventure</title>
    <image>http://www.futubox.to/system/icon_ds/55/original/sky_action%26adventure.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050237.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Comedy</title>
    <image>http://www.futubox.to/system/icon_ds/180/original/sky_comedy.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050231.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Crime & Thriller</title>
    <image>http://www.futubox.to/system/icon_ds/174/original/sky_crime%26thriller.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050236.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Drama & Romance</title>
    <image>http://www.futubox.to/system/icon_ds/178/original/sky_drama_romance.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050229.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Family</title>
    <image>http://www.futubox.to/system/icon_ds/173/original/sky_family.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050234.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Modern Greats</title>
    <image>http://www.futubox.to/system/icon_ds/177/original/sky_modern_greats.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050228.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Movies - Sci Fi & Horror</title>
    <image>http://www.futubox.to/system/icon_ds/179/original/sky_scifi_horror.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050230.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky News</title>
    <image>http://www.futubox.to/system/icon_ds/59/original/ski_news_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050227.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Sports 1</title>
    <image>http://www.futubox.to/system/icon_ds/225/original/sky_sports_hd.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050226.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Syfy</title>
    <image>http://www.futubox.to/system/icon_ds/263/original/syfy.png</image>
    <annotation>United Kingdom</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050241.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Arte</title>
    <image>http://www.futubox.to/system/icon_ds/221/original/arte.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050218.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Das Erste</title>
    <image>http://www.futubox.to/system/icon_ds/203/original/das_erste.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z030402.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Kabel1</title>
    <image>http://www.futubox.to/system/icon_ds/204/original/cabel_eins.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010103.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>N24</title>
    <image>http://www.futubox.to/system/icon_ds/201/original/n24.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050008.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>ProSieben</title>
    <image>http://www.futubox.to/system/icon_ds/49/original/pro_sieben.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010102.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>RTL</title>
    <image>http://www.futubox.to/system/icon_ds/109/original/rtl.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z030101.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>RTL II</title>
    <image>http://www.futubox.to/system/icon_ds/199/original/rtl2.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z030104.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sat 1</title>
    <image>http://www.futubox.to/system/icon_ds/50/original/sat1.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010101.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sixx</title>
    <image>http://www.futubox.to/system/icon_ds/200/original/sixx_hd.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010104.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sport 1</title>
    <image>http://www.futubox.to/system/icon_ds/202/original/sport1_hd.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z030103.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Vox</title>
    <image>http://www.futubox.to/system/icon_ds/110/original/vox.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050220.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>ZDF</title>
    <image>http://www.futubox.to/system/icon_ds/193/original/zdf_hd.png</image>
    <annotation>Deutschland</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z030401.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>France 2</title>
    <image>http://www.futubox.to/system/icon_ds/188/original/france2.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010105.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>France 24</title>
    <image>http://www.futubox.to/system/icon_ds/220/original/france24.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050213.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>France 3</title>
    <image>http://www.futubox.to/system/icon_ds/258/original/france3.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010111.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>France 4</title>
    <image>http://www.futubox.to/system/icon_ds/259/original/france4.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010112.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>France 5</title>
    <image>http://www.futubox.to/system/icon_ds/260/original/france5.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010113.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>NRJ 12</title>
    <image>http://www.futubox.to/system/icon_ds/257/original/nrj12.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010110.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>M6</title>
    <image>http://www.futubox.to/system/icon_ds/184/original/m6.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010106.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>TF1</title>
    <image>http://www.futubox.to/system/icon_ds/205/original/tf1.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010107.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>TMC</title>
    <image>http://www.futubox.to/system/icon_ds/256/original/tmc.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010109.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>W9</title>
    <image>http://www.futubox.to/system/icon_ds/255/original/w9.png</image>
    <annotation>France</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010108.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>AXN</title>
    <image>http://www.futubox.to/system/icon_ds/264/original/axn.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050245.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Canale 5</title>
    <image>http://www.futubox.to/system/icon_ds/186/original/canale5.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010502.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Discovery Channel</title>
    <image>http://www.futubox.to/system/icon_ds/212/original/discovery.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050208.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Fox Crime</title>
    <image>http://www.futubox.to/system/icon_ds/213/original/Fox-Crime-1.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050209.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Fox</title>
    <image>http://www.futubox.to/system/icon_ds/214/original/foxhd.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050210.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Fox Life</title>
    <image>http://www.futubox.to/system/icon_ds/268/original/fox_life.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050247.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Gambero Rosso Channel</title>
    <image>http://www.futubox.to/system/icon_ds/269/original/gamberorosso.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050246.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>History</title>
    <image>http://www.futubox.to/system/icon_ds/267/original/historyHD.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050248.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Italia 1</title>
    <image>http://www.futubox.to/system/icon_ds/187/original/italy_1.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z010501.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Nat Geo Adventure</title>
    <image>http://www.futubox.to/system/icon_ds/270/original/natgeoadv.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050249.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>National Geographic Channel</title>
    <image>http://www.futubox.to/system/icon_ds/211/original/natgeohd.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050223.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Rai Uno</title>
    <image>http://www.futubox.to/system/icon_ds/208/original/rai_uno.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050214.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Rai Due</title>
    <image>http://www.futubox.to/system/icon_ds/209/original/rai_due.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050215.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Rai News</title>
    <image>http://www.futubox.to/system/icon_ds/210/original/rai_news.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050217.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Cinema 1</title>
    <image>http://www.futubox.to/system/icon_ds/219/original/sky_cinema-1.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050207.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Cinema Hits</title>
    <image>http://www.futubox.to/system/icon_ds/217/original/sky_cinema_hits.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050211.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Cinema Max</title>
    <image>http://www.futubox.to/system/icon_ds/218/original/sky_cinema_max.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050206.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Family</title>
    <image>http://www.futubox.to/system/icon_ds/265/original/sky_family_hd.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050244.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Sky Passion</title>
    <image>http://www.futubox.to/system/icon_ds/266/original/sky_passion.png</image>
    <annotation>Italia</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050243.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Fox</title>
    <image>http://www.futubox.to/system/icon_ds/215/original/foxhd.png</image>
    <annotation>Polska</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z050224.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Hustler</title>
    <image>http://www.futubox.to/system/icon_ds/224/original/hustler_hd.png</image>
    <annotation>Adult</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z990102.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Penthouse HD 1</title>
    <image>http://www.futubox.to/system/icon_ds/121/original/penthouse.png</image>
    <annotation>Adult</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z990103.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Penthouse HD 2</title>
    <image>http://www.futubox.to/system/icon_ds/122/original/penthouse2.png</image>
    <annotation>Adult</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z990104.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>

    <item>
    <title>Redlight</title>
    <image>http://www.futubox.to/system/icon_ds/226/original/redlight.png</image>
    <annotation>Adult</annotation>
    <onClick>
    <script>
      movie = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,Rtmp-options:-b%2060000%20-W%20http://www.futubox.to/donottouch/fpv3.39.swf%20-y%20z990101.stream%20-p%20http://futubox.to/,rtmp://" + server + ".webport.tv/ilt";
      playitemurl(movie,10);
    </script>
    </onClick>
    </item>


</channel>
</rss>
