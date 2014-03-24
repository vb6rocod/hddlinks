#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
// For users without megavideo account
// It downloads the video in flv format
// It doesnt work if the file is hosted on free hosting.
// In firefox and vlc the video stops at minute 10 unless you modifired the php.ini of the website where you hosted the file
// In case that the files is hosted on the player, the video also stops at minute 10 if remember right... I don't know how to solve it
// How to call the file: http://website.com/mvfreeflv.php?video_id=IDOFTHEVIDEO 
function mv_decrypt($str_hex, $key1, $key2){
$str_bin = "";
// 1. Convert hexadecimal string to binary string
for($i = 0; $i < 128; $i++){
$str_bin .= floor(hexdec($str_hex[floor($i/4)])/pow(2,(3-($i%4))))%2;
}
// 2. Generate switch and XOR keys
$key = Array();
for ($i = 0; $i < 384; $i++){
$key1 = ($key1 * 11 + 77213) % 81371;
$key2 = ($key2 * 17 + 92717) % 192811;
$key[$i] = ($key1 + $key2) % 128;
}
// 3. Switch bits positions
for ($i = 256; $i >= 0; $i--){
$temp = $str_bin[$key[$i]];
$str_bin[$key[$i]] = $str_bin[$i%128];
$str_bin[$i%128] = $temp;
}
// 4. XOR entire binary string
for ($i = 0; $i < 128; $i++){
$str_bin[$i] = $str_bin[$i] ^ $key[$i+256] & 1;
}
// 5. Convert binary string back to hexadecimal
$str_hex = "";
for($i = 0; $i < 32; $i++){
$str_hex .= dechex(bindec(substr($str_bin, $i*4, 4)));
}
// 6. Return counted string
return $str_hex;
}

// Is set the "file" variable?
if(isset($_GET["video_id"])){
// Does player send video position?
$pos = (isset($_GET["pos"]) ? intval($_GET["pos"]) : "");
//Obtain Megavideo ID from link
$megavideo_id = $_GET["video_id"];
// Obtain Megavideo XML playlist file
if ($content = @file_get_contents("http://www.megavideo.com/xml/videolink.php?v=".$megavideo_id)){
// Parameters which I want to obtain from XML;
$parameters = Array("un", "k1", "k2", "s", "size");
$success = true;
// Obtain parameters from XML one by one
for($i=0; $i<Count($parameters); $i++){
$success = $success && preg_match('/ ' . $parameters[$i] . '="([^"]+)"/', $content, $match);
$$parameters[$i] = $match[1];
}
if($success){
// Count "dkey" from obtained parameters
$dkey=mv_decrypt($un,$k1,$k2);
// set URL address of video file
$video_url = "http://www".$s.".megavideo.com/files/".$dkey."/".$pos;
// Send headers to browser
header("Content-Type: video/flv");
header("Content-Disposition: attachment; filename=video.flv;" );
header("Content-Length: ".$size);
// Read video file from Megavideo server
readfile($video_url);
}
}
}
?>
