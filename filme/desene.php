#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF-8' ?>";
$host = "http://127.0.0.1/cgi-bin";
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
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
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
		/usr/local/etc/www/cgi-bin/scripts/filme/image/desene.png
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
	<title>Pentru copii</title>
<!--
<item>
<title>iPlay - desene animate (abonament)</title>
<link><?php echo $host; ?>/scripts/filme/php/iplay_desene_main.php</link>
<annotation>http://www.iplay.ro</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<item>
<title>Noobroom - filme pentru copii</title>
<link><?php echo $host; ?>/scripts/filme/php/noobroom_kids.php</link>
<annotation>http://noobroom.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!--
<item>
<title>Desene Animate</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,UCd7MvHhgIOcsrRwqPlfrdgQ</link>
<annotation>https://www.youtube.com/user/UCd7MvHhgIOcsrRwqPlfrdgQ/videos</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>Desene Animate in Limba Romana</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,andre3a08</link>
<annotation>https://www.youtube.com/user/andre3a08/videos</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>Licurici Scaparici</title>
<link><?php echo $host; ?>/scripts/php1/youtube_user.php?query=1,DeseneAnimate0nline</link>
<annotation>https://www.youtube.com/user/DeseneAnimate0nline/videos</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>desenele-copilăriei</title>
<link><?php echo $host; ?>/scripts/filme/php/desenele-copilariei_main_o.php</link>
<annotation>http://desenele-copilariei.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>990</title>
<link><?php echo $host; ?>/scripts/filme/php/990_desene_main.php</link>
<media:thumbnail url="image/movies.png" />
<annotation>http://990.ro</annotation>
</item>
-->
<item>
<title>mesek.tv (lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/mesek.php?query=,http://www.mesek.tv/videok/teljes-mesek</link>
<media:thumbnail url="image/movies.png" />
<annotation>http://www.mesek.tv/videok/teljes-mesek</annotation>
</item>

<item>
<title>mesekvilaga.x10.mx (lb. maghiara)</title>
<link><?php echo $host; ?>/scripts/filme/php/mesekvilaga.php</link>
<media:thumbnail url="image/movies.png" />
<annotation>http://mesekvilaga.x10.mx/</annotation>
</item>
<!--
<item>
<title>top1</title>
	<link><?php echo $host; ?>/scripts/clip/php/top1.php?query=1,http://www.top1.ro/video/animatie-desene/,Animatie%2C+desene</link>
	<location>http://www.top1.ro</location>
	<image>/usr/local/etc/www/cgi-bin/scripts/clip/image/top1.gif</image>
	<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/clip/image/top1.gif" />
	<annotation>http://www.top1.ro</annotation>
</item>
-->
<!--
<item>
<title>DeseneAnimate</title>
<link><?php echo $host; ?>/scripts/filme/php/deseneanimate_main.php?query=1,</link>
<annotation>http://deseneanimate.tv</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>JocuriCuBarbie</title>
<link><?php echo $host; ?>/scripts/filme/php/jocuricubarbie_main.php</link>
<annotation>http://www.jocuricubarbie.info/desene_animate.html</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>desene.veziserialeonline</title>
<link><?php echo $host; ?>/scripts/filme/php/desene_veziserialeonline_main.php</link>
<annotation>http://desene.veziserialeonline.info/tv-shows</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>desene-animate</title>
<link><?php echo $host; ?>/scripts/filme/php/desenele-copilariei_main.php</link>
<annotation>http://desene-animate.info/</annotation>
<mediaDisplay name="threePartsView"/>
</item>

<item>
<title>desenele-copilăriei</title>
<link><?php echo $host; ?>/scripts/filme/php/desenele-copilariei_main_o.php</link>
<annotation>http://desenele-copilariei.net</annotation>
<mediaDisplay name="threePartsView"/>
</item>
-->
<!--
<item>
<title>Kinderfilme</title>
<link><?php echo $host; ?>/scripts/filme/php/Kinderfilme.php</link>
<annotation>http://youtube.com</annotation>
<mediaDisplay name="threePartsView"/>
</item>

-->
</channel>
</rss>
