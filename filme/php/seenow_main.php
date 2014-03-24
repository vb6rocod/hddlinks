#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
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
	itemWidthPC="30"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="30"
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
		<text align="center" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=60 offsetYPC=25 widthPC=30 heightPC=25>
         <script>print(image); image;</script>
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
					  image = getItemInfo(idx, "image");
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
	<title>seenow</title>
	<menu>main menu</menu>


<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//necesita inregistrare pe site
//seenow.txt are o singura linie de forma
//username|pass
$filename = "/usr/local/etc/dvdplayer/seenow.txt";
$cookie="D://seenow.txt";
$cookie="/tmp/seenow.txt";
if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a=explode("|",$c);
  $a1=str_replace("?","@",$a[0]);
  $user=urlencode($a1);
  $pass=trim($a[1]);
if (!file_exists($cookie)) {
  $l="http://www.seenow.ro/login";
  $post="email=".$user."&password=".$pass."&submitlogin=Login&remember_me=0";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t1=explode('<div class="floatL user">',$html);
$t2=explode('class="floatL',$t1[1]);
$t3=explode('>',$t2[1]);
$t4=explode('<',$t3[1]);
$this_user=trim($t4[0]);
$t5=explode('>',$t2[2]);
$t6=explode('<',$t5[1]);
$credit=trim($t6[0]);
} else {
$link="http://www.seenow.ro/";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t1=explode('<div class="floatL user">',$html);
$t2=explode('class="floatL',$t1[1]);
$t3=explode('>',$t2[1]);
$t4=explode('<',$t3[1]);
$this_user=trim($t4[0]);
$t5=explode('>',$t2[2]);
$t6=explode('<',$t5[1]);
$credit=trim($t6[0]);
}
} else {
$link="http://www.seenow.ro/";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t1=explode('<div class="floatL user">',$html);
$t2=explode('class="floatL',$t1[1]);
$t3=explode('>',$t2[1]);
$t4=explode('<',$t3[1]);
$this_user=trim($t4[0]);
$t5=explode('>',$t2[2]);
$t6=explode('<',$t5[1]);
$credit=trim($t6[0]);
}



//// Test area
$title="Test Area";
$link="http://www.seenow.ro/test-area-9-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($link,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }

//// Free Zone
$title="Free Zone";
$link="http://www.seenow.ro/free-zone-206-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($link,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Filme Premium";
$link="http://www.seenow.ro/filme-premium-27-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Filme hollywood (abonament)";
$link="http://www.seenow.ro/filme-hollywood-25-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Filme romanesti (abonament)";
$link="http://www.seenow.ro/filme-romanesti-23-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Documentare (abonament)";
$link="http://www.seenow.ro/documentare-17-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Bollywood (abonament)";
$link="http://www.seenow.ro/bollywood-26-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
///
$title="Lifestyle (abonament)";
$link="http://www.seenow.ro/lifestyle-38-";
 $link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/seenow.php?file=1,'.$link.','.urlencode($title);
    if (strpos($title,"live") === false) {
    echo '
    <item>
    <title>'.$title.'</title>
    <link>'.$link.'</link>
    <annotation>'.$title.'</annotation>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
    }
if ($this_user=="Guest") {
$link = "/usr/local/etc/www/cgi-bin/scripts/filme/php/seenow.rss";
$description="Pentru a accesa acest site trebuie să aveţi un cont pe seenow.ro. Completaţi userul şi parola în acest formular şi apoi apăsaţi Return, Return după care accesaţi din nou această pagină. Folositi ? pentru @ in caz ca nu aveti aceasta tasta.";

	  echo '
	  <item>
	  <title>Logare</title>
	  <link>'.$link.'</link>
	  <annotation>'.$description.'</annotation>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
} else {
	  echo '
	  <item>
	  <title>'.$this_user.'</title>
	  <annotation>'.$credit.'</annotation>
	  </item>
	  ';
}

?>

</channel>
</rss>
