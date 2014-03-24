#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$img = "/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg";
?>
<rss version="2.0">
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
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=30>
  <?php echo $img; ?>
		</image>
		<idleImage> image/POPUP_LOADING_01.png </idleImage>
		<idleImage> image/POPUP_LOADING_02.png </idleImage>
		<idleImage> image/POPUP_LOADING_03.png </idleImage>
		<idleImage> image/POPUP_LOADING_04.png </idleImage>
		<idleImage> image/POPUP_LOADING_05.png </idleImage>
		<idleImage> image/POPUP_LOADING_06.png </idleImage>
		<idleImage> image/POPUP_LOADING_07.png </idleImage>
		<idleImage> image/POPUP_LOADING_08.png </idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "title");
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
<title>Bing</title>

<item>
<title>FOX Soccer Channel</title>
<link><?php echo $host; ?>/scripts/tv/php/bing1.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>NBA</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/nba?q=browse:sports/nba,NBA</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>MLB</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/mlb?q=browse:sports/mlb,MLB</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>NHL</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/nhl?q=browse:sports/nhl,NHL</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>NFL</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/nfl?q=browse:sports/nfl,NFL</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>College Football</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/college-football?q=browse:sports/college-football,College+football</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

<item>
<title>
College Basketball</title>
<link><?php echo $host; ?>/scripts/tv/php/bing.php?file=http://www.bing.com/videos/browse/sports/college-basketball?q=browse:sports/college-basketball,College+basketball</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/bing.jpg" />
</item>

</channel>
</rss>
