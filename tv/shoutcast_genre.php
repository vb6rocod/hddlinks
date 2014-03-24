#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0">
<onEnter>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";
  screenXp = 4;
  screenYp = 3;
  pageTitle = "Free Internet Radio Stations";
</onEnter>

	<mediaDisplay name=photoView
	  columnCount=5
	  rowCount=7
		sideColorBottom="0:0:0"
		sideColorTop="0:0:0"
		itemImageXPC="10"
		backgroundColor="0:0:0"
		imageBorderColor="15:20:230"
		imageBorderPC="0"
		itemBackgroundColor="0:0:0"
		centerHeightPC=70
		centerXPC=10
		centerYPC=18
		itemGapXPC=1
		itemGapYPC=1
		sideTopHeightPC=15
		bottomYPC=90

  	imageFocus=""
  	imageUnFocus=""
  	imageParentFocus=""

		sliding=yes
		showHeader=no
		showDefaultInfo=yes
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
    <text offsetXPC=5 offsetYPC=0 widthPC=100 heightPC=15 fontSize=26 backgroundColor=0:0:0 foregroundColor=200:200:200>
      All Genres
    </text>
    <image offsetXPC=0 offsetYPC=15 widthPC=100 heightPC=1>../etc/translate/rss/image/gradient_line.bmp</image>
    <image offsetXPC=65 offsetYPC=2 widthPC=30 heightPC=12>
      ../etc/translate/rss/image/shoutcast.gif
      <widthPC>
        <script>
          546 / 154 * 12 * screenYp / screenXp;
        </script>
      </widthPC>
      <offsetXPC>
        <script>
          95 - 546 / 154 * 12 * screenYp / screenXp;
        </script>
      </offsetXPC>
    </image>

    <onUserInput>
    <script>
    ret = "false";
    userInput = currentUserInput();

    if (userInput == "pagedown" || userInput == "pageup" || userInput == "PG" || userInput == "PD")
    {
      itemSize = getPageInfo("itemCount");
      idx = Integer(getFocusItemIndex());
      if (userInput == "pagedown" || userInput == "PD")
      {
        idx -= -40;
        if(idx &gt;= itemSize)
          idx = itemSize-1;
      }
      else
      {
        idx -= 40;
        if(idx &lt; 0)
          idx = 0;
      }

      print("new idx: "+idx);
      setFocusItemIndex(idx);
    	setItemFocus(0);
      redrawDisplay();
      ret = "true";
    }
    ret;
    </script>
    </onUserInput>

		<itemDisplay>
			<text align="center" lines="2" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100 fontSize=15>
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
		</itemDisplay>
	</mediaDisplay>

<channel>
<title></title>


<?php
$link="http://api.shoutcast.com/legacy/genrelist?k=sh1iqrPHnhjFmXiT";
$link="http://api.shoutcast.com/genre/primary?k=sh1iqrPHnhjFmXiT&f=xml";
$html=file_get_contents($link);
$videos = explode('name="', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('"',$video);
  $name=$t1[0];
  echo '
  <item>
  <name>'.$name.'</name>
  <link>http://127.0.0.1/cgi-bin/scripts/tv/shoutcast_station.php?query='.urlencode($name).',genre</link>
  </item>
  ';
}
?>
</channel>
</rss>

