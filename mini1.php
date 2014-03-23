#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF-8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0">
<script>
  optionsPath = "/usr/local/etc/dvdplayer/update.txt";
  optionsArray = readStringFromFile(optionsPath);
  if(optionsArray == null)
  {
    player_tip = "0";
    auto_update = "0";
  }
  else
  {
    player_tip = getStringArrayAt(optionsArray, 0);
    auto_update = getStringArrayAt(optionsArray, 1);
  }
if (auto_update == "0")
  info=getUrl("http://127.0.0.1/cgi-bin/scripts/info.php?mod=info");
else
  {
    showIdle();

	sekator_FW = getStringArrayAt(readStringFromFile("/usr/local/sbin/sginfo"),0);
	if (sekator_FW != null)
	{
		sekatorSWF_systemCmd("killall php");
		sekatorSWF_systemCmd("killall httpd");
		sekatorSWF_systemCmd("/usr/sbin/sbin/lighttpd -f /usr/sbin/sbin/lighttpd.conf; sleep 1");
	}

         url="http://127.0.0.1/cgi-bin/scripts/info.php?mod=update";
         info=getUrl(url);

    while (1)
	{
		update_done = getStringArrayAt(readStringFromFile("/tmp/hdforall.dat"),0);
		if (update_done == null)
		{

		if (info == null || info == " ")
		{
			info=getUrl("http://127.0.0.1/cgi-bin/scripts/info.php?mod=info");
		}

	sekator_FW = getStringArrayAt(readStringFromFile("/usr/local/sbin/sginfo"),0);
	if (sekator_FW != null)
	{
		sekatorSWF_systemCmd("killall php");
		sekatorSWF_systemCmd("killall lighttpd");
		sekatorSWF_systemCmd("/usr/local/sbin/httpd -f /usr/local/etc/httpd.conf; sleep 1");
	}
		break;
		}
	}
		 
    cancelIdle();
    redrawDisplay();
  }
</script>
<onEnter>
  showIdle();
  SetScreenSaverStatus("no");
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
  redrawDisplay();
</onRefresh>

	<mediaDisplay name=photoView
	  centerXPC=7
		centerYPC=25
		centerHeightPC=60
		columnCount=5
	  rowCount=3
		menuBorderColor="55:55:55"
		sideColorBottom="0:0:0"
		sideColorTop="0:0:0"
	  backgroundColor="0:0:0"
		itemBackgroundColor="0:0:0"
		itemGapXPC=0
		itemGapYPC=0
		imageBorderColor="10:105:150"
		imageBorderPC="0"
		sideTopHeightPC=0
		bottomYPC=0
		sliding=yes
		showHeader=no
		showDefaultInfo=no
		idleImageWidthPC="8" idleImageHeightPC="10" idleImageXPC="80" idleImageYPC="10">
		<text align="left" redraw="yes" offsetXPC=5 offsetYPC=5 widthPC=95 heightPC=5 fontSize=15 backgroundColor=0:0:0 foregroundColor=120:120:120>
   <script>print(info); info;</script>
		</text>
 		<text align="left" redraw="yes" offsetXPC=5 offsetYPC=10 widthPC=95 heightPC=5 fontSize=15 backgroundColor=0:0:0 foregroundColor=120:120:120>
   Apasati 1 pentru setari model player, 3 pentru actualizare.
		</text>
<!--
<backgroundDisplay name=ims_guide_menu>
                <image offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
                        image/IMS_bg.fsp
                </image>
</backgroundDisplay>
-->
  	<text align="left" redraw="yes" useBackgroundSurface=yes offsetXPC="8" offsetYPC="15" widthPC="50" heightPC="8" fontSize="24" foregroundColor="100:200:255">
		  <script>print(hed); hed;</script>
		</text>
  	<text align="center" redraw="yes" lines=" 2" useBackgroundSurface=yes offsetXPC="8" offsetYPC="85" widthPC="84" heightPC="12" fontSize="17" foregroundColor="200:200:200">
		  <script>print(annotation); annotation;</script>
		</text>
  <image offsetXPC=0 offsetYPC=23 widthPC=100 heightPC=1>
		../etc/translate/rss/image/gradient_line.bmp
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
			<image>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  hed = getItemInfo(idx, "title");
					  annotation = getItemInfo(idx, "annotation");
					  getItemInfo(idx, "focus");
					}
					else
					{
					getItemInfo(idx, "unfocus");
					}
				</script>
			 <offsetXPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 7.5; else 15;
			   </script>
			 </offsetXPC>
			 <offsetYPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 0; else 10;
			   </script>
			 </offsetYPC>
			 <widthPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 85; else 70;
			   </script>
			 </widthPC>
			 <heightPC>
			   <script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
			    if(focus==idx) 80; else 70;
			   </script>
			 </heightPC>
			</image>

		</itemDisplay>

  <onUserInput>
    <script>
      ret = "false";
      userInput = currentUserInput();
      majorContext = getPageInfo("majorContext");

      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);

      if(userInput == "one" || userInput == "1")
      {
         jumptolink("setup_hdd");
      }
      else if(userInput == "two" || userInput == "2")
      {
         jumptolink("movie");
      }
      else if(userInput == "three" || userInput == "3")
      {
         showIdle();

	sekator_FW = getStringArrayAt(readStringFromFile("/usr/local/sbin/sginfo"),0);
	if (sekator_FW != null)
	{
		sekatorSWF_systemCmd("killall php");
		sekatorSWF_systemCmd("killall httpd");
		sekatorSWF_systemCmd("/usr/sbin/sbin/lighttpd -f /usr/sbin/sbin/lighttpd.conf; sleep 1");
	}

         url="http://127.0.0.1/cgi-bin/scripts/info.php?mod=update1";
         info=getUrl(url);

    while (1)
	{
		update_done = getStringArrayAt(readStringFromFile("/tmp/hdforall.dat"),0);
		if (update_done == null)
		{

		if (info == null || info == " ")
		{
			info=getUrl("http://127.0.0.1/cgi-bin/scripts/info.php?mod=info");
		}

	sekator_FW = getStringArrayAt(readStringFromFile("/usr/local/sbin/sginfo"),0);
	if (sekator_FW != null)
	{
		sekatorSWF_systemCmd("killall php");
		sekatorSWF_systemCmd("killall lighttpd");
		sekatorSWF_systemCmd("/usr/local/sbin/httpd -f /usr/local/etc/httpd.conf; sleep 1");
	}
		break;
		}
	}
		 
         cancelIdle();
         redrawDisplay();


      }
      else if(userInput == "four" || userInput == "4")
      {
        if(itemCount &gt;= 4)
        {
          setFocusItemIndex(3);
          redrawDisplay();
        }
      }
      else if(userInput == "five" || userInput == "5")
      {
        if(itemCount &gt;= 5)
        {
          setFocusItemIndex(4);
          redrawDisplay();
        }
      }
      else if(userInput == "six" || userInput == "6")
      {
        if(itemCount &gt;= 6)
        {
          setFocusItemIndex(5);
          redrawDisplay();
        }
      }
      else if(userInput == "seven" || userInput == "7")
      {
        if(itemCount &gt;= 7)
        {
          setFocusItemIndex(6);
          redrawDisplay();
        }
      }
      else if(userInput == "eight" || userInput == "8")
      {
        if(itemCount &gt;= 8)
        {
          setFocusItemIndex(7);
          redrawDisplay();
        }
      }
      else if(userInput == "nine" || userInput == "9")
      {
        if(itemCount &gt;= 9)
        {
          setFocusItemIndex(8);
          redrawDisplay();
        }
      }
      if(userInput == "zero" || userInput == "0")
      {
        if(itemCount &gt;= 10)
        {
          setFocusItemIndex(9);
          redrawDisplay();
        }
      }
      else if (userInput == "pagedown" || userInput == "pageup" || userInput == "PD" || userInput == "PG")
      {
        itemSize = getPageInfo("itemCount");
        idx = Integer(getFocusItemIndex());
        if (userInput == "pagedown")
        {
          idx -= -4;
          if(idx &gt;= itemSize)
            idx = itemSize-1;
        }
        else
        {
          idx -= 4;
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

<setup_hdd>
<mediaDisplay name="onePartView" />
<link>/usr/local/etc/www/cgi-bin/scripts/update.rss</link>
</setup_hdd>
<movie>
<mediaDisplay name="onePartView" />
<link>/usr/local/etc/www/cgi-bin/scripts/dir.rss</link>
</movie>
<adultlink>
<mediaDisplay name="photoView"/>
<link>
  <?php echo $host; ?>/scripts/adult/adult1325.php
</link>
</adultlink>
<adultpass>
<mediaDisplay name="onePartView" />
<link>
/usr/local/etc/www/cgi-bin/scripts/adult/adult.rss
</link>
</adultpass>
<destination>
<link>http://127.0.0.1/cgi-bin/scripts/mini1.php</link>
<mediaDisplay name="photoView"/>
</destination>
<channel>
    <title>HDD Links</title>

<!-- 1 -->
<item>
<title>Filme online subtitrate</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/filme/filme.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/filme_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/filme_unfocus.png</unfocus>
<annotation>Filme online traduse</annotation>
</item>

<!-- 2 -->
<item>
<title>TV Live</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/tv/tv_live.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/livetv_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/livetv_unfocus.png</unfocus>
<annotation>Posturi TV din România şi din alte ţări. Ştiri, filme, muzică sau sport</annotation>
</item>

<!-- 3 -->
<item>
<title>Posturi naţionale</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/tv/nationale.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/nationale_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/nationale_unfocus.png</unfocus>
<annotation>Înregistrări ale unor emisiuni TV emise de posturile naţionale</annotation>
</item>

<!-- 4 - new line -->
<item>
<title>Seriale TV subtitrate</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/filme/seriale.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/seriale_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/seriale_unfocus.png</unfocus>
<annotation>Seriale TV traduse</annotation>
</item>

<!-- 5 -->
<item>
<title>OneHD</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/tv/prahovahd.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/onehd_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/onehd_unfocus.png</unfocus>
<annotation>One HD: concerte, divertisment, business, turism, experimente, disponibile în High Definition atât live cât şi on-demand (VOD)</annotation>
</item>

<!-- 6 -->
<item>
<title>Radio Online</title>
<onClick>
<script>
showIdle();
"/usr/local/etc/www/cgi-bin/scripts/tv/radio.rss";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/radio_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/radio_unfocus.png</unfocus>
<annotation>Posturi de radio</annotation>
</item>

<!-- 7 - new line -->
<item>
<title>Pentru copii</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/filme/desene.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/desene_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/desene_unfocus.png</unfocus>
<annotation>Desene animate, filme, poveşti</annotation>
</item>

<!-- 8 -->
<item>
<title>Conturi personale metafeeds</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/user/users.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/user_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/user_unfocus.png</unfocus>
<annotation>Ai un cont pe metafeeds? Aici putem să-l adăugăm!</annotation>
</item>

<!-- 9 -->
<item>
<title>Ştiri şi alte informaţii</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/news/news.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/news_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/news_unfocus.png</unfocus>
<annotation>Orarul serialelor, meteo, cursul valutar sau alte informaţii</annotation>
</item>
<!-- 10 - new line -->
<item>
<title>Videoclipuri</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/clip/clip.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/videoclip_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/videoclip_unfocus.png</unfocus>
<annotation>Filmuleţe nostime, reale, clipuri video personale</annotation>
</item>

<!-- 11 -->
<item>
<title>Trailere filme şi jocuri</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/trailer/trailer.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/trailer_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/trailer_unfocus.png</unfocus>
<annotation>Ultimele trailere pentru filme sau jocuri</annotation>
</item>

<!-- 12 -->

<item>
<title>Emisiuni Sportive</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/tv/tv_sport.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/sport_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/sport_unfocus.png</unfocus>
<annotation>Înregistrări evenimente sportive: fotbal şi nu numai</annotation>
</item>

<!-- 13 - new line -->
<!--
<?php
$f="/usr/local/etc/xLive/repoman/05_08_2011.txt";
if (file_exists($f)) {
echo '
<item>
<title>repoman xLive</title>
<link>/usr/local/etc/xLive/repoman/repoman.rss</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/php1/xlive.png" />
<focus>/usr/local/etc/www/cgi-bin/scripts/image/xlive_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/xlive_unfocus.png</unfocus>
<location></location>
<annotation>repoman xLive</annotation>
<mediaDisplay name="photoView"/>
</item>
';
} else {
echo '
<item>
<title>repoman xLive</title>
<onClick>
<script>
rss = "/usr/local/etc/www/cgi-bin/scripts/util/downloadDialog.rss";
ret = doModalRss(rss);
if (ret == "Confirm")    {
  showIdle();
  url="http://127.0.0.1/cgi-bin/scripts/util/xlive.cgi?mode=install";
  msg = getURL(url);
  cancelIdle();
  jumptolink("destination");
}
</script>
</onClick>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/php1/xlive.png" />
<focus>/usr/local/etc/www/cgi-bin/scripts/image/xlive_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/xlive_unfocus.png</unfocus>
<location></location>
<annotation>repoman xLive</annotation>
<mediaDisplay name="photoView"/>
</item>
';
}
?>
-->
<item>
<title>Movie Browser</title>
<link><?php echo $host; ?>/scripts/dir.php</link>
<media:thumbnail url="/usr/local/etc/www/cgi-bin/scripts/php1/xlive.png" />
<focus>/usr/local/etc/www/cgi-bin/scripts/image/folder_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/folder_unfocus.png</unfocus>
<location></location>
<annotation>Movie Browser - apasati 2 pentru setari!</annotation>
<mediaDisplay name="threePartsView"/>
</item>
<!-- 14 -->

<item>
<title>Posturi locale</title>
<onClick>
<script>
showIdle();
"<?php echo $host; ?>/scripts/tv/locale.php";
</script>
</onClick>
<focus>/usr/local/etc/www/cgi-bin/scripts/image/locale_focus.png</focus>
<unfocus>/usr/local/etc/www/cgi-bin/scripts/image/locale_unfocus.png</unfocus>
<annotation>Ştiri şi emisiuni înregistrate, difuzate de posturile TV locale</annotation>
</item>

<!-- 15 -->
  <item>
    <title>Programe adulţi</title>
    <annotation>Numai pentru +18! Necesită parolă. Pentru mai multe informaţii: http:// hdforall.freehostia.com. Pentru schimbare parolă introduceţi o parolă greşită.</annotation>
    <focus>/usr/local/etc/www/cgi-bin/scripts/image/adult_focus.png</focus>
    <unfocus>/usr/local/etc/www/cgi-bin/scripts/image/adult_unfocus.png</unfocus>
    <onClick>
    <script>
    optionsPath="/usr/local/etc/dvdplayer/adult.dat";
    pass = readStringFromFile(optionsPath);
    if (pass == null)
    {
    pass="1325";
    writeStringToFile(optionsPath, pass);
    keyword = getInput();
    if (keyword != null)
    {
      if (keyword == pass)
      {
        jumpToLink("adultlink");
      }
      else
      {
       jumpToLink("adultpass");
      }
    }
    }
    else if (pass == "0")
    {
    jumpToLink("adultlink");
    }
    else
    {
    keyword = getInput();
    if (keyword != null)
    {
      if (keyword == pass)
      {
        jumpToLink("adultlink");
      }
      else
      {
       jumpToLink("adultpass");
      }
    }
    }
    </script>
    </onClick>
    <mediaDisplay name="photoView"/>
  </item>
</channel>

</rss>
