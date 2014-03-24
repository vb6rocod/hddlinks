#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0">

<!--
#
#   http://code.google.com/media-translate/
#   Copyright (C) 2010  Serge A. Timchenko
#
#   This program is free software: you can redistribute it and/or modify
#   it under the terms of the GNU General Public License as published by
#   the Free Software Foundation, either version 3 of the License, or
#   (at your option) any later version.
#
#   This program is distributed in the hope that it will be useful,
#   but WITHOUT ANY WARRANTY; without even the implied warranty of
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#   GNU General Public License for more details.
#
#   You should have received a copy of the GNU General Public License
#   along with this program. If not, see <http://www.gnu.org/licenses/>.
#
-->

<script>
  translate_base_url  = "http://127.0.0.1/cgi-bin/translate?";
  cgiconf = readStringFromFile("/usr/local/etc/translate/etc/cgi.conf");
  if(cgiconf != null)
  {
    value = getStringArrayAt(cgiconf, 0);
    if(value != null &amp;&amp; value != "")
    {
      translate_base_url = value;
      print("cgi.conf=",value);
    }
  }

  storagePath             = getStoragePath("tmp");
  storagePath_stream      = storagePath + "stream.dat";

  error_info          = "";
</script>

<onEnter>
  startitem = "middle";
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
  middleItem = Integer(itemCount / 2);
  if(startitem == "middle")
    setFocusItemIndex(middleItem);
  else
  if(startitem == "right")
    setFocusItemIndex(middleItem);
  redrawDisplay();
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
	itemWidthPC="48"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="48"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>

  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<text align="justify" redraw="yes"
          lines="14" fontSize=14
		      offsetXPC=55 offsetYPC=25 widthPC=40 heightPC=60
		      backgroundColor=10:80:120 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>

		<text align="center" redraw="yes" offsetXPC=55 offsetYPC=85 widthPC=40 heightPC=5 fontSize=13 backgroundColor=10:80:120 foregroundColor=0:0:0>
			<script>print(location); location;</script>
		</text>

	<idleImage>image/POPUP_LOADING_01.png </idleImage>
	<idleImage>image/POPUP_LOADING_02.png </idleImage>
	<idleImage>image/POPUP_LOADING_03.png </idleImage>
	<idleImage>image/POPUP_LOADING_04.png </idleImage>
	<idleImage>image/POPUP_LOADING_05.png </idleImage>
	<idleImage>image/POPUP_LOADING_06.png </idleImage>
	<idleImage>image/POPUP_LOADING_07.png </idleImage>
	<idleImage>image/POPUP_LOADING_08.png </idleImage>

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
      majorContext = getPageInfo("majorContext");

      print("*** majorContext=",majorContext);
      print("*** userInput=",userInput);
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
  ret = "true";
}
      if(userInput == "enter" || userInput == "ENTR")
      {
        showIdle();
        focus = getFocusItemIndex();

        request_title = getItemInfo(focus, "title");
        request_url = getItemInfo(focus, "location");
        request_options = getItemInfo(focus, "options");

        stream_url = getItemInfo(focus, "stream_url");
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

      ret;
    </script>
  </onUserInput>

	</mediaDisplay>

	<item_template>
  <mediaDisplay  name="threePartsView" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
	<idleImage>image/POPUP_LOADING_01.png </idleImage>
	<idleImage>image/POPUP_LOADING_02.png </idleImage>
	<idleImage>image/POPUP_LOADING_03.png </idleImage>
	<idleImage>image/POPUP_LOADING_04.png </idleImage>
	<idleImage>image/POPUP_LOADING_05.png </idleImage>
	<idleImage>image/POPUP_LOADING_06.png </idleImage>
	<idleImage>image/POPUP_LOADING_07.png </idleImage>
	<idleImage>image/POPUP_LOADING_08.png </idleImage>
		</mediaDisplay>
	</item_template>

  <videoDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, request_url);
    streamArray = pushBackStringArray(streamArray, request_options);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, url);
    streamArray = pushBackStringArray(streamArray, stream_type);
    streamArray = pushBackStringArray(streamArray, stream_title);
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/videoRenderer.rss");
  </videoDispatcher>

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
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/audioRenderer.rss");
  </audioDispatcher>

  <playlistDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "playlist");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_playlist, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/xspfBrowser.rss");
  </playlistDispatcher>

  <rssDispatcher>
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, stream_url);
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file://../etc/translate/rss/xspf/rss_mediaFeed.rss");
  </rssDispatcher>

  <unknownDispatcher>
    info_url    = translate_base_url + "info," + request_options + "," + urlEncode(request_url);
    error_info  = "";

    res = loadXMLFile(info_url);

    if (res != null)
    {
      error = getXMLElementCount("info","error");

      if(error != 0)
      {
  	    value = getXMLText("info","error");
  	    if(value != null)
  	    {
  	     error_info = value;
  	    }
      }
      else
      {
  	    value = getXMLAttribute("info","stream","url");
  	    if(value != null)
  	     stream_url = value;

  	    value = getXMLAttribute("info","stream","type");
  	    if(value != null)
  	     stream_type = value;

  	    value = getXMLAttribute("info","stream","class");
  	    if(value != null)
  	     stream_class = value;

  	    value = getXMLAttribute("info","stream","protocol");
  	    if(value != null)
  	     stream_protocol = value;

  	    value = getXMLAttribute("info","stream","server");
  	    if(value != null)
  	     stream_soft = value;

        stream_status_url = "";

  	    value = getXMLAttribute("info","stream","server_url");
  	    if(value != null)
  	    {
  	     stream_server_url = value;
  	     if((stream_soft == "icecast" || stream_soft == "shoutcast") &amp;&amp; stream_server_url!="")
  	     {
    	      stream_status_url = translate_base_url+"status,"+urlEncode(stream_server_url)+","+urlEncode(stream_url);
    	   }
  	    }

        value = getXMLText("info","status","stream-title");
  	    if(value != null)
  	     stream_title = value;

        stream_current_song = "";
  	    value = getXMLText("info","status","current-song");
  	    if(value != null)
    		  stream_current_song = value;

  	    value = getXMLText("info","status","stream-genre");
  	    if(value != null)
  	      stream_genre = value;

  	    value = getXMLText("info","status","stream-bitrate");
  	    if(value != null)
  	      stream_bitrate = value;

        options = "";

        if(stream_type != "")
          options = "Content-type:"+stream_type;

        if(options == "")
          options = stream_options;
        else
          options = options + ";" + stream_options;

  	    stream_translate_url = translate_base_url + "stream," + options + "," + urlEncode(stream_url);

  	    url = null;

  	    if(stream_class == "video" || stream_class == "audio")
    	  {
          if(stream_protocol == "file" || (stream_protocol == "http" &amp;&amp; stream_soft != "shoutcast"))
    	      url = stream_url;
    	    else
    	      url = stream_translate_url;
    	  }
    	  else
    	  {
  	      url = stream_url;
    	  }

    	  if(url != null)
    	  {
          if(stream_class == "audio" || stream_class == "video" || stream_class == "playlist" || stream_class == "rss")
          {
            executeScript(stream_class+"Dispatcher");
          }
          else
          {
            error_info = "Unsupported media type: " + stream_type;
          }
  	    }
  	    else
  	    {
          error_info = "Empty stream url!";
  	    }
      }
    }
    else
    {
      error_info = "CGI translate module failed!";
    }
    print("error_info=",error_info);
  </unknownDispatcher>

<script>
    channelImage = "";
  </script><channel>
  <title>Povesti...</title>
<item>
<location>http://www.jocuricubarbie.info</location>
<title>Capra cu trei iezi - Ion Creanga</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/capra-cu-trei-iezi.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>A fost odata o capra care avea trei iezi</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>

<location>http://www.jocuricubarbie.info</location>
<title>Danila Prepeleac - Ion Creanga</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/danila-prepeleac.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Povestea lui Danila Prepeleac scrisa de Ion Creanga, asculta aceasta poveste in format audio</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>

<title>Capitan la 15 ani</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/capitan-la-15-ani.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>In ziua de 2 februarie 1873, cam asa incepe aceasta poveste</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Cantaretul din Rin - lectura</title>

<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/cantaretul-din-rin-lectura.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Trei frati, tuti trei flacai stateau odata la o carciuma dintr-un oras de pe valea raului</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Bucle de aur</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/bucle-de-aur.mp3</stream_url>

<stream_class>audio</stream_class>
<annotation>A fost odata indepartata tara a Norvegiei un oras pe nume Roro</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Harap Alb - partea 2</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/harap-alb-partea-2.mp3</stream_url>
<stream_class>audio</stream_class>

<annotation>Continuarea partii 1 din povestea lui Harap Alb</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Harap Alb - partea 1</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/harap-alb-partea-1.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Era odata intr-o tara un crai, care avea trei feciori</annotation>

<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Bobocel uratel 2</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/bobocel-uratel-2.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Partea a doua din povestea bobocel uratel 2</annotation>
<stream_genre>Povesti</stream_genre>

</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Bobocel uratel 1</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/bobocel-uratel-1.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Odata trecut miezul veri, tot fanul fusese strans in capita</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Blestemul privighetorii</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/blestemul-privighetorii.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Fetita cea rea, iar bine fetita cea rea</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>

<title>Balaurul din varful stancii</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/balaurul-din-varful-stancii.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Balaurul din varful stancii, legenda poloneza</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Aventurile lui Popey Marinarul</title>

<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/aventurile-lui-popey-marinarul.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Atentiune ridicati ancora, porniti motoarele</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Aventurile lui Cippolino 2</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/aventurile-lui-cippolino-2.mp3</stream_url>

<stream_class>audio</stream_class>
<annotation>Partea a doua a aventurilor glumetului Cippolino</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Aventurile lui Cippolino 1</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/aventurile-lui-cippolino-1.mp3</stream_url>
<stream_class>audio</stream_class>

<annotation>Sunt glumetul Cippolino si intr-un sat eu am crescut</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Amnarul - dramatizare</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/amnarul-dramatizare.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>In ziua aceea de vara nu se mai auzea nici o toba</annotation>

<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Amintiri din copilarie</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/amintiri-din-copilarie.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Nu stiu altii cum sunt, dar eu cand ma gandesc la locul nasteri mele, la casa parinteasca din Humulesti</annotation>
<stream_genre>Povesti</stream_genre>

</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Alice in tara minunilor</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/alice-in-tara-minunilor.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Eu sunt o fetita, ma cheama Alice si unchiul meu o carte a scris</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Aleodor imparat</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/aleodor-imparat.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>A fost odata ca niciodata, a fost odata un imparat</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>

<title>20 de mii de leghe sub mari</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/20-de-mii-de-leghe-sub-mari.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>20 de mii de leghe sub mari, adaptare radio-fonica de Gelu Naum dupa romanul lui Joules Vernes</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Lupul alb si ciubotelele rosii</title>

<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/lupul-alb-si-ciubotelele-rosii.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Eee se zice ca ar fi fost odata, o doamna foarte foarte bogata care avea doi baieti</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Fata mosului cea cuminte</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/fata-mosului-cea-cuminte.mp3</stream_url>

<stream_class>audio</stream_class>
<annotation>Crii crii, crii crii bun gasit dragi prieteni, eu sunt greierasul</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Fat frumos din lacrima</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/fat-frumos-din-lacrima.mp3</stream_url>
<stream_class>audio</stream_class>

<annotation>Dramatizare de Mircea Stefanescu dupa basmul de Mihai Eminescu</annotation>
<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Alba ca zapada si cei sapte pitici</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/alba-ca-zapada-si-cei-sapte-pitici.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>E o poveste veche, veche de demult si cea mai frumoasa dintre cate ascult</annotation>

<stream_genre>Povesti</stream_genre>
</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Casuta din padure</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/casuta-din-padure.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>A fost odata un taietor de lemne tare nevoias</annotation>
<stream_genre>Povesti</stream_genre>

</item>

<item>
<location>http://www.jocuricubarbie.info</location>
<title>Ali Baba si cei 40 de hoti</title>
<stream_url>http://109.163.227.84/jocuricubarbie.info/povesti/ali-baba-si-cei-40-de-hoti.mp3</stream_url>
<stream_class>audio</stream_class>
<annotation>Povestea lui Ali Baba si a celor 40 de hoti este una hazlie si plina de intamplari</annotation>
<stream_genre>Povesti</stream_genre>
</item>

</channel>


</rss>
