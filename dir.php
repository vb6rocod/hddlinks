#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0">
<onExit>
    playItemURL(-1, 1);
    playStatus = 0;
    setRefreshTime(-1);
</onExit>

<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  firsttime=0;
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
	itemXPC="10"
	itemYPC="13"
	itemWidthPC="60"
	itemHeightPC="7"
	itemBackgroundColor="0:0:0"
	itemPerPage="10"
  itemGap="0"
	infoYPC="90"
	infoXPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
	idleImageXPC="82" idleImageYPC="85" idleImageWidthPC="8" idleImageHeightPC="10"
>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
	<previewWindow windowColor="0:0:0" offsetXPC="99" offsetYPC="99" widthPC="1" heightPC="1"></previewWindow>

  <text redraw="yes" offsetXPC="5" offsetYPC="3" widthPC="90" heightPC="11" fontSize="20" backgroundColor="0:0:0" foregroundColor="200:200:200">
    <script>getPageInfo("pageTitle");</script>
  </text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="3" widthPC="10" heightPC="11" fontSize="20" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
  <image redraw="no" offsetXPC="0" offsetYPC="11" widthPC="100" heightPC="1">
		../etc/translate/rss/image/gradient_line.bmp
	</image>
  <image redraw="no" offsetXPC="0" offsetYPC="83" widthPC="100" heightPC="1">
		../etc/translate/rss/image/gradient_line.bmp
	</image>

  	<text  redraw="yes" align="left" offsetXPC="5" offsetYPC="85" widthPC="95" heightPC="8" fontSize="17" backgroundColor="0:0:0" foregroundColor="200:200:200">
		  <script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=72 offsetYPC=30 widthPC=20 heightPC=40>
		<script>print(img); img;</script>
		</image>
	<itemDisplay>
		<image offsetXPC="0" offsetYPC="1" widthPC="5" heightPC="95">
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					class = getItemInfo(idx, "class");

				if (class == "directory")
				{
					  "/usr/local/etc/www/cgi-bin/scripts/filme/image/folder.png";
				}
				else
				{
					"/usr/local/etc/www/cgi-bin/scripts/filme/image/series.png";
				}
			</script>

		</image>

			<text align="left" lines="1" offsetXPC=6 offsetYPC=0 widthPC=94 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  img = getItemInfo(idx, "img");
					  annotation = getItemInfo(idx, "annotation");
					}
					getItemInfo(idx, "title");
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
<script>
ret = "false";
userInput = currentUserInput();

if (userInput == "pagedown" || userInput == "pageup")
{
  idx = Integer(getFocusItemIndex());
  if (userInput == "pagedown")
  {
    idx -= -10;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 10;
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
 url=geturl("http://127.0.0.1/cgi-bin/scripts/util/file_del.php?file=/tmp/share.txt");
 jumptolink("logon");
 "true";
}
redrawDisplay();
ret;
</script>
</onUserInput>
</mediaDisplay>

	<item_template>
		<mediaDisplay  name="threePartsView" idleImageXPC="82" idleImageYPC="85" idleImageWidthPC="8" idleImageHeightPC="10">
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

	<logon>
	<link>
	<script>
	url="/usr/local/etc/www/cgi-bin/scripts/dir.rss";
	url;
	</script>
	</link>
	</logon>


<channel>
<title>Movie Browser</title>
<?php
$host = "http://127.0.0.1/cgi-bin/scripts/dir.php?dir=";
$img_tip="";
$exclude_list = array(".", "..",".Theater",".Theatter","RECYCLER","\$RECYCLE.BIN","System Volume Information",".jukebox");
$s="/tmp/share.txt";
if (file_exists("/usr/local/etc/dvdplayer/browser.dat")) {
 $h=file_get_contents("/usr/local/etc/dvdplayer/browser.dat");
 $t=explode("\n",$h);
 $img_tip=trim($t[0]);
 if (!$img_tip) $img_tip="";
if(!file_exists($s)) {
 $sh_loc=trim($t[1]);
 if ($sh_loc) {
  $exec="mkdir -p /tmp/ramfs/volumes/NET:";
  exec ($exec);
  sleep (1);
  $exec="mount -t cifs //".$sh_loc." -o username=guest /tmp/ramfs/volumes/NET:";
  exec ($exec);
  $new_file = "/tmp/share.txt";
  $fh = fopen($new_file, 'w');
  fwrite($fh, "OK");
  fclose($fh);
 }
}
} else {
  $img_tip="";
}
if (isset($_GET["dir"])) {
  $dir_path = $_GET["dir"];
  $dir_path=urldecode($dir_path);
}
else {
  $dir_path = "/tmp/ramfs/volumes/";
  if(!file_exists("/tmp/ramfs/volumes/NFS:")) {
	if(file_exists("/tmp/sekator_nfs_mounts")) {
		$exec= "ln -s /tmp/sekator_nfs_mounts /tmp/ramfs/volumes/NFS:";
		exec ($exec);
	}
	if (file_exists("/tmp/nfs")) {
		$exec= "ln -s /tmp/nfs /tmp/ramfs/volumes/NFS:";
		exec ($exec);
	}
  }
}
$directories = array_diff(scandir($dir_path), $exclude_list);
foreach($directories as $entry) {
 if(is_dir($dir_path.$entry)) {
  $entry1=str_replace("&","&amp;",$entry);
  $dir_path1=str_replace("&","&amp;",$entry1);
  $path1=str_replace(" ","%20",$dir_path).str_replace(" ","%20",$entry);
  $path1=str_replace("'","%27",$dir_path).str_replace("'","%27",$entry);
  echo '
  <item>
  <title>'.$entry1.'</title>
  <link>'.$host.urlencode($path1).'/</link>
  <class>directory</class>
  <annotation>'.preg_replace("/\/tmp\/ramfs\/volumes\//","",$dir_path.$entry1).'</annotation>
  ';
  if ($img_tip)
   echo '<img>'.str_replace("&","&amp;",$dir_path).str_replace("&","&amp;",$entry).'/'.$img_tip.'</img>';
  else
   echo '<img></img>';
  echo '
  </item>
  ';
 }
}
$f = "/usr/local/bin/home_menu";
foreach($directories as $entry) {
 if(!is_dir($dir_path.$entry)) {
 $ext= substr(strrchr($entry, "."), 1);
 $entry1=str_replace("&","&amp;",$entry);
 $dir_path1=str_replace("&","&amp;",$dir_path);
 $path1=str_replace(" ","%20",$dir_path).str_replace(" ","%20",$entry);
 $path1=str_replace("'","%27",$dir_path).str_replace("'","%27",$entry);
 $mysrt=substr($path1, 0, -strlen($ext))."srt";
 if (preg_match("/(ts|avi|mkv|mp4|flv|mov|m2ts|mpg)/i",$ext,$m)) {
 echo '
 <item>
 <title>'.$entry1.'</title>
 <onClick>
 <script>
 showIdle();
 dummy=getURL("http://127.0.0.1/cgi-bin/scripts/util/srt1_xml.php?file='.urlencode($mysrt).'");';
 echo '
 url="'.$dir_path1.$entry1.'";
 cancelIdle();
 storagePath = getStoragePath("tmp");
 storagePath_stream = storagePath + "stream.dat";
 streamArray = null;
 streamArray = pushBackStringArray(streamArray, "");
 streamArray = pushBackStringArray(streamArray, "");
 streamArray = pushBackStringArray(streamArray, url);
 streamArray = pushBackStringArray(streamArray, url);
 streamArray = pushBackStringArray(streamArray, video/mp4);
 streamArray = pushBackStringArray(streamArray, "'.$entry1.'");
 streamArray = pushBackStringArray(streamArray, "1");
 writeStringToFile(storagePath_stream, streamArray);
 ';
 if (file_exists($f)) {
 echo '
 doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer2.rss");
 ';
 } else {
 echo '
 doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer1.rss");
 ';
 }
 echo '
 </script>
 </onClick>
 <class>movie</class>
 <annotation>'.$entry1.'</annotation>
 <img></img>
 </item>
 ';
} elseif (preg_match("/(iso)/i",$ext,$m)) {
 echo '
 <item>
 <title>'.$entry1.'</title>
 <onClick>
 <script>
 showIdle();
 ';
 echo '
 url="'.$dir_path1.$entry1.'";
 cancelIdle();
 playItemURL(url,0);
 ';
 echo '
 </script>
 </onClick>
 <class>movie</class>
 <annotation>'.$entry1.'</annotation>
 <img></img>
 </item>
 ';
}
}
}
?>
</channel>
</rss>
