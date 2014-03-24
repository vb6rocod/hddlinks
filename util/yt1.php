#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$file=$_GET["file"];
if(preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $file, $match)) {;
  $id = $match[2];
  $link="http://www.youtube.com/watch?v=".$id;
  $html=file_get_contents($link);
  $html = urldecode($html);
  $h=explode('fmt_stream_map',$html);
  $html=urldecode($h[1]);
  $videos = explode('url=', $html);
  for ($i=0;$i<count($videos);$i++) {
    $t1=explode(";", $videos[$i]);
    $link=$t1[0];
    $t1=explode("itag=",$link);
    $t2=explode("&",$t1[1]);
    $tip=$t2[0];
    if ($tip=="22") break;
    if ($tip=="18") break;
  }
}
print $link;
?>
