#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>"; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<mediaDisplay name="threePartsView"
	itemBackgroundColor="0:0:0"
	backgroundColor="0:0:0"
	sideLeftWidthPC="0"
	itemImageXPC="5"
	itemXPC="20"
	itemYPC="20"
	itemWidthPC="65"
	capWidthPC="70"
	unFocusFontColor="101:101:101"
	focusFontColor="255:255:255"
	popupXPC = "40"
  popupYPC = "55"
  popupWidthPC = "22.3"
  popupHeightPC = "5.5"
  popupFontSize = "13"
	popupBorderColor="28:35:51"
	popupForegroundColor="255:255:255"
 	popupBackgroundColor="28:35:51"
	idleImageWidthPC="10"
	idleImageHeightPC="10">
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		<backgroundDisplay>
			<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
			image/mele/backgd.jpg
			</image>
		</backgroundDisplay>
		<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
		image/mele/rss_title.jpg
		</image>
		<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
		Link
		</text>
</mediaDisplay>
<channel>
	<title>eporner</title>
	<menu>main menu</menu>

<?php
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://s4.cdn2.eu.eporner.com/d681eaed087887ef07d698537a869fb8/4d73b1f200ab00/103790.mp4?start=0
//http://www.eporner.com/download-key/f93582b7ab16a4bcae09376f4c6be6f4/103790/1.flv
$link = $_GET["file"];

    $html = file_get_contents($link);
    $id = str_between($html,"eporner.com/player/","'");
    $link = "http://www.eporner.com/config/".$id;
    $html = file_get_contents($link);
    $link = str_between($html,"<file>","</file>");
    $link = "http://127.0.0.1/cgi-bin/translate?stream,,".$link;
    echo '<item>';
    echo '<title>Link</title>';
    echo '<link>'.$link.'</link>';
    echo '<enclosure type="video/mp4" url="'.$link.'"/>';	
    echo '</item>';

?>
</channel>
</rss>
