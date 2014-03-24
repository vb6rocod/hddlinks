#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$img = "/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png";
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
<title>sensotv</title>


<item>
<title>Arte vizuale - Clipa de arta</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/arte-vizuale/clipa-de-arta</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Arte vizuale - Colectia Senso TV</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/arte-vizuale/colectia-senso-tv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Artele spectacolului - Colectia Senso TV</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/artele-spectacolului/colectia-sensotv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Artele spectacolului - Festivaluri</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/artele-spectacolului/festivaluri</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Artele spectacolului - Portret Senso TV</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/artele-spectacolului/portret-sensotv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Artele spectacolului - Spectacole</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/artele-spectacolului/spectacole</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Eveniment - Colectia Senso TV</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/eveniment/colectia-senso-tv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Eveniment - Concerte</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/eveniment/concerte</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Eveniment - Premiere</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/eveniment/premiere</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Arte - Istorie si Culte</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/arte/categorie-istorie-si-culte</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - fitness</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-fitness</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - extreme sports</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-extreme-sports</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - hobby</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-hobby</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - evenimente</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-evenimente</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - casa mea</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-casa-mea</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - gateste</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-gateste-</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - copilul tau</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-copilul-tau</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - calatorii</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-calatorii</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - cartea de weekend</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-cartea-de-weekend</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - weekend</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-weekend</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - filmul de weekend</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-filmul-de-weekend</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - colectia Senso tv</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-colectia-senso-tv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Lifestyle - frumusete</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/lifestyle/categorie-frumusete</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Sanatate - evenimente</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/sanatate/categorie-evenimente</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Sanatate - catena tv</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/sanatate/categorie-catena-tv</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Sanatate - campanii</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/sanatate/categorie-campanii</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

<item>
<title>Sanatate - medicina alternativa</title>
<link><?php echo $host; ?>/scripts/tv/php/sensotv.php?query=,http://www.sensotv.ro/sanatate/categorie-medicina-alternativa</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/tv/image/sensotv.png" />
</item>

</channel>
</rss>
