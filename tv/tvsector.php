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
  server = "HD";
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
		<!--
  	<text redraw="yes" align="left" offsetXPC="6" offsetYPC="15" widthPC="100" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Press 2 for other server. Server : " + server;</script>
		</text>
		-->
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
<!--
		<text align="center" redraw="yes" fontSize=20 offsetXPC=60 offsetYPC=60 widthPC=30 heightPC=10 backgroundColor=0:0:0 foregroundColor=200:200:200>
        <script>print(annotation); annotation;</script>
        </text>
-->
		<image align="center" redraw="yes" offsetXPC=60 offsetYPC=35 widthPC=30 heightPC=20>
		<script>print(img); img;</script>
		</image>

  	<text  redraw="yes" align="center" offsetXPC="0" offsetYPC="90" widthPC="100" heightPC="8" fontSize="17" backgroundColor="10:105:150" foregroundColor="100:200:255">
    <script>"Press 2 to change quality. Quality : " + server;</script>
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
		if (server == "HD")
           server = "SD";
		else if (server == "SD")
           server = "HD";
        else
		 server = "HD";
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
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
//necesita inregistrare pe site
//futubox.txt are o singura linie de forma
//username|pass sau email|pass
$filename = "/usr/local/etc/dvdplayer/futubox.txt";
//$filename = "D://futubox.txt";
$cookie="/tmp/futubox_c.txt";
//$cookie="D://futubox_c.txt";

if (file_exists($filename)) {
  $handle = fopen($filename, "r");
  $c = fread($handle, filesize($filename));
  fclose($handle);
  $a=explode("|",$c);
  $a1=str_replace("?","@",$a[0]);
  $user=urlencode($a1);
  $user=str_replace("@","%40",$user);
  $pass=trim($a[1]);

  $l="http://futubox.to/user/sign_in";
  $post="user[login]=".$user."&user[password]=".$pass."&user[remember_me]=1";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $l);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch,CURLOPT_REFERER,"http://futubox.to/user/sign_in");
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  $t1=explode('authenticity_token',$html);
  $t2=explode('value="',$t1[1]);
  $t3=explode('"',$t2[1]);
  $torr=$t3[0];
  $t2=explode('value="',$t1[2]);
  $t3=explode('"',$t2[1]);
  $token=$t3[0];
  $post="utf8=".$torr."&authenticity_token=".urlencode($token)."&user%5Blogin%5D=".$user."&user%5Bpassword%5D=".$pass."&user%5Bremember_me%5D=0&commit=Sign+in";
  curl_setopt ($ch, CURLOPT_POST, 1);
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
  $html = curl_exec($ch);
  curl_close($ch);
}

  $link="http://futubox.to/channels";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
  
  $html=str_between($html,"<table>","</table>");
  $videos = explode('href="', $html);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
 $t1=explode('"',$video);
 $link="http://futubox.to".$t1[0];
 
 $t1=explode('src="',$video);
 $t2=explode('"',$t1[1]);
 $image="http://futubox.to".$t2[0];
 
 $t1=explode('alt="',$video);
 $t2=explode('"',$t1[1]);
 $title=$t2[0];
 $title=str_replace("_"," ",$title);
    echo '
    <item>
    <title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$host.'/scripts/tv/tvsector_link.php?file='.$link.'" + "," + server;
    url1=getUrl(url);
    cancelIdle();
    movie="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream," + url1;
    playItemUrl(movie,10);
    </script>
    </onClick>
    <image>'.$image.'</image>
    <annotation>'.$title.'</annotation>
    <media:thumbnail url="'.$image.'" />
    </item>
    ';
}
//$sid = str_between($html,'url_key:encodeURIComponent("', '"');
if (!$html) {
exec("rm -f /tmp/futubox_c.txt");
$link = "/usr/local/etc/www/cgi-bin/scripts/tv/tvsector.rss";
$description="futubox.to.";

	  echo '
	  <item>
	  <title>Logon</title>
	  <link>'.$link.'</link>
	  <annotation>'.$description.'</annotation>
	  <mediaDisplay name="onePartView" />
	  </item>
	  ';
}
?>
</channel>
</rss>
