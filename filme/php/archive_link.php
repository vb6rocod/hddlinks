#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$link = $_GET["file"];
$html = file_get_contents($link);
$videos = explode('download', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1=explode('"',$video);
  $link1="http://www.archive.org/download".$t1[0];
  $rest = substr($link1, -3);
  if ($rest=="mp4") break;
}
if ($link== "") {
foreach($videos as $video) {
  $t1=explode('"',$video);
  $link1="http://www.archive.org/download".$t1[0];
  $rest = substr($link1, -3);
  if ($rest=="avi") break;
}
}
if ($link== "") {
foreach($videos as $video) {
  $t1=explode('"',$video);
  $link1="http://www.archive.org/download".$t1[0];
  $rest = substr($link1, -3);
  if ($rest=="mkv") break;
}
}
if ($link== "") {
foreach($videos as $video) {
  $t1=explode('"',$video);
  $link1="http://www.archive.org/download".$t1[0];
  $rest = substr($link1, -3);
  if ($rest=="MP4") break;
}
}
print $link1;
?>
