#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<onEnter>
    xmlurl = "http://127.0.0.1/cgi-bin/setting.cgi?mode=filme";
    ret = getUrl(xmlurl);
</onEnter>
<mediaDisplay name="threePartsView" itemBackgroundColor="0:0:0" backgroundColor="0:0:0" sideLeftWidthPC="0" itemImageXPC="5" itemXPC="20" itemYPC="20" itemWidthPC="65" capWidthPC="70" unFocusFontColor="101:101:101" focusFontColor="255:255:255" idleImageXPC="45" idleImageYPC="42" idleImageWidthPC="20" idleImageHeightPC="26">
	<idleImage>image/busy1.png</idleImage>
	<idleImage>image/busy2.png</idleImage>
	<idleImage>image/busy3.png</idleImage>
	<idleImage>image/busy4.png</idleImage>
	<idleImage>image/busy5.png</idleImage>
	<idleImage>image/busy6.png</idleImage>
	<idleImage>image/busy7.png</idleImage>
	<idleImage>image/busy8.png</idleImage>
		<backgroundDisplay>
			<image  offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
			image/mele/backgd.jpg
			</image>  
		</backgroundDisplay>
		<image  offsetXPC=0 offsetYPC=2.8 widthPC=100 heightPC=15.6>
		image/mele/rss_title.jpg
		</image>
		<text  offsetXPC=40 offsetYPC=8 widthPC=35 heightPC=10 fontSize=20 backgroundColor=-1:-1:-1 foregroundColor=255:255:255>
		Actualizare filme_link.php
		</text>				
		<text offsetXPC=5 offsetYPC=20 widthPC=90 heightPC=8 fontSize=16 backgroundColor=-1:-1:-1 foregroundColor=200:200:200>
		<script>
		apas_status;
		</script>
		</text>
		<text offsetXPC=5 offsetYPC=25 widthPC=90 heightPC=50 fontSize=16 lines=10 backgroundColor=-1:-1:-1 foregroundColor=200:200:200>
		<script>
		ret;
		</script>
		</text>
	</mediaDisplay>
<channel>
<title>Actualizare filme_link</title>

</channel>
</rss>
