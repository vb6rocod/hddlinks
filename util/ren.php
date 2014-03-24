#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function changeext($directory) { 
	$num = 0; 
	if($curdir = opendir($directory)) { 
		while($file = readdir($curdir)) { 
			if($file != '.' && $file != '..') { 
				$srcfile = $directory . '/' . $file; 
       		if(!is_dir($srcfile)) { 
       			if (strpos($srcfile, 'cgi_bin_translate_stream') !== false) {
       				$data = date("d.m-H.i.s"); 
       				$newfile = $data."-".$num.".flv";	
							$dstfile = $directory . '/' . $newfile;
       				$fileHand = fopen($srcfile, 'r'); 
       				fclose($fileHand); 
							rename($srcfile, $dstfile ); 
							$num ++; 
						} 
					} 
			} 
		} 
		closedir($curdir); 
	} 
	return $num;
}
$movie_dir = "/tmp/hdd/volumes/HDD1/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}
$movie_dir = "/tmp/hdd/volumes/HDD2/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}
$movie_dir = "/tmp/usbmounts/sdb1/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}
$movie_dir = "/tmp/usbmounts/sdb2/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}
$movie_dir = "/tmp/usbmounts/sda1/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}
$movie_dir = "/tmp/usbmounts/sda2/movie";
if (is_dir($movie_dir)) {
	changeext($movie_dir);
}

echo "<?xml version='1.0' ?>"; 
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<mediaDisplay name="threePartsView" itemBackgroundColor="0:0:0" backgroundColor="0:0:0" sideLeftWidthPC="0" itemImageXPC="5" itemXPC="20" itemYPC="20" itemWidthPC="65" capWidthPC="70" unFocusFontColor="101:101:101" focusFontColor="255:255:255" idleImageWidthPC="10" idleImageHeightPC="10">
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

		Redenumire fişiere descărcate

		</text>	

		<text offsetXPC=5 offsetYPC=30 widthPC=90 heightPC=10 fontSize=16 backgroundColor=-1:-1:-1 foregroundColor=200:200:200>

			Fişierele descărcate au fost redenumite

		</text>		

</mediaDisplay>

<channel>



<title>Redenumire fişiere</title>



</channel>

</rss>
