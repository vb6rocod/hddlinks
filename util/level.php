#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
   showIdle();
   last_idx=0;
   ntest = 0;
   ref = 1;
   executeScript("updateItems");
   redrawDisplay();
   SetFocusItemIndex(0);
   setRefreshTime(100);
</onEnter>
<updateItems>
   xmlfile = "http://127.0.0.1/cgi-bin/scripts/util/download.php";
   download_ok = loadXMLFile( xmlfile );
   itemSize = getXMLElementCount("video","item");
   print("Item Size = ", itemSize);
   titleArray="";
   nameArray="";
   logfileArray="";
   downloadArray="";
   download1Array="";
   imageArray="";
   if (itemSize &gt; 0)
   {
        count=1;
        while(1)
        {

                title  = getXMLText("video","item", count-1, "title");
                name  = getXMLText("video","item", count-1, "name");
                logfile  = getXMLText("video","item", count-1, "logfile");
                download  = getXMLText("video","item", count-1, "download");
                download1  = getXMLText("video","item", count-1, "download1");
                image  = getXMLText("video","item", count-1, "image");
                titleArray = pushBackStringArray(titleArray, title);
                nameArray = pushBackStringArray(nameArray, name);
                logfileArray = pushBackStringArray(logfileArray, logfile);
                downloadArray = pushBackStringArray(downloadArray, download);
                download1Array = pushBackStringArray(download1Array, download1);
                imageArray = pushBackStringArray(imageArray, image);
                count += 1;
                if (count &gt; itemSize)
                {
                        break;
                }
        }
     }
</updateItems>
<onExit>
  setRefreshTime(-1);
</onExit>
<onRefresh>
    ntest = ntest + 1;
    if (ntest &gt; 95 &amp;&amp; ntest &lt; 100 &amp;&amp; ref == 1)
    {
      showIdle();
      ref = 0;
      postMessage("edit");
      cancelIdle();
    }
    else if (ntest &gt; 100)
    {
      executeScript("updateItems");
      SetFocusItemIndex(last_idx);
      ntest = 0;
      ref = 1;
    }
</onRefresh>
<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemXPC="5"
	itemYPC="25"
	itemWidthPC="90"
	itemHeightPC="8"
	itemImageWidthPC="0"
	itemImageHeightPC="0"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
    itemGap="0"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
    idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="24" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    Folositi tastele: 1=Sterge din lista 2=start/stop 3=opreste/sterge toate
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemSize;</script>
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
        <image>
        <script>
                getStringArrayAt(imageArray, -1);
        </script>
        <offsetXPC>0</offsetXPC>
        <offsetYPC>5</offsetYPC>
        <widthPC>8</widthPC>
        <heightPC>90</heightPC>
        </image>
         <text offsetXPC=10 offsetYPC=0 widthPC=90 heightPC=100 fontSize=15 backgroundColor=-1:-1:-1 foregroundColor=250:250:250         align=left>
          <script>
             getStringArrayAt(titleArray, -1);
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
	userInput = currentUserInput();
    focusIndex = getFocusItemIndex();
    last_idx = focusIndex;
    if (userInput == "display" || userInput == "DISPLAY")
    {
      redrawDisplay("yes");
      setRefreshTime(100);
      ret = "false";
    }
	if( userInput == "two" || userInput == "2")
	{
        setRefreshTime(-1);
		d1= getStringArrayAt(downloadArray, focusIndex);
		dlok = loadXMLFile(d1);
		last_idx=0;
        executeScript("updateItems");
        setRefreshTime(100);
        redrawDisplay();
        SetFocusItemIndex(0);
	}
		else
    if (userInput == "one" || userInput == "1")
		{
		setRefreshTime(-1);
		d1= getStringArrayAt(download1Array, focusIndex);
		dlok = loadXMLFile(d1);
		last_idx=0;
        executeScript("updateItems");
        setRefreshTime(100);
        redrawDisplay();
        SetFocusItemIndex(0);
		}
		else
    if (userInput == "three" || userInput == "3")
		{
		setRefreshTime(-1);
        d1="http://127.0.0.1/cgi-bin/scripts/util/stop_exua.cgi";
		dlok = loadXMLFile(d1);
		last_idx=0;
        executeScript("updateItems");
        setRefreshTime(100);
        redrawDisplay();
        SetFocusItemIndex(0);
		}
		ret;
</onUserInput>
</mediaDisplay>

<item_template>
</item_template>
<channel>
	<title>Download Manager</title>
<itemSize>
	<script>
		itemSize;
	</script>
</itemSize>
</channel>
</rss>
