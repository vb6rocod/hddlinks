#!/usr/local/bin/Resource/www/cgi-bin/php
<HTML>
<HEAD>
<TITLE>TV Favorite</TITLE>
</HEAD>
<BODY>
<H1> Adauga un canal TV</H1>
<?php
$title = $_POST["titlu"];
function str_between($string, $start, $end){ 
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
function printform() {
echo '
<FORM action="tv_fav.php" method="post">
<table>
<TR>
<TD align="right">
    <LABEL for="titlu">Titlu: </LABEL>
</TD>
<TD>
    <INPUT type="text" id="titlu" name="titlu">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="link">Link (http,mms): </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="link" name="link">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="rtmp">rtmp: </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="rtmp" name="rtmp">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="app">app(a): </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="app" name="app">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="playpath">playPath(y): </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="playpath" name="playpath">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="swfUrl">swfUrl(W): </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="swfUrl" name="swfUrl">
</TD>
</TR>
<TR>
<TD align="right">
    <LABEL for="pageUrl">pageUrl(p): </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="pageurl" name="pageurl">
</TD>
</TR>
<TD align="right">
    <LABEL for="other">alti parametri rtmp: </LABEL>
</TD>
<TD>
    <INPUT type="text" size="80" id="other" name="other">
</TD>
</TR>
</TABLE>
    <INPUT type="submit" value="Send"> <INPUT type="reset">
 </FORM>
 <BR>
 <h2>Pentru stream-uri http sau mms completati la link.</h2>
 <h2>Pentru stream-uri rtmp NU completati la link, doar la rtmp si mai jos (daca e cazul).</h2>
 <h2>Nu sunt suportate protocoalele rtsp://, sop:// sau http://...../playlist.m3u8</h2>
';
}
clearstatcache();
if (file_exists("/data"))
  $f= "/data/ohlulz.dat";
else
  $f="/usr/local/etc/ohlulz.dat";
if (file_exists($f)) {
   $dir = $f;
} else {
     $dir = "";
}
if (!$title) {
printform();
} else {
$link=$_POST["link"];
$rtmp=$_POST["rtmp"];
$app=$_POST["app"];
$playpath=$_POST["playpath"];
$swfUrl=$_POST["swfUrl"];
$pageurl=$_POST["pageurl"];
$other=$_POST["other"];
if ($link) {
if (preg_match("/mms|m3u/",$link))
  $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
} else {
if ($app || $playpath || $swfUrl || $pageurl || $other) {
$opt="Rtmp-options:";
if ($app) $opt=$opt."-a ".$app." ";
if ($playpath) $opt=$opt."-y ".$playpath." ";
if ($swfUrl) $opt=$opt."-W ".$swfUrl." ";
if ($pageurl) $opt=$opt."-p ".$pageurl." ";
if ($other) $opt=$opt.$other;
$opt=trim($opt);
$opt=str_replace(" ","%20",$opt);
$link = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,".$opt.",".$rtmp;
} else {
$link = "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$rtmp;
}
}
if ($dir <> "") {
$html=file_get_contents($dir);
if (strpos($html,$link) === false)
   $html=$html."<item><link>".$link."</link><title>".$title."</title></item>";
} else {
$dir = $f;
$html="<item><link>".$link."</link><title>".$title."</title></item>";
}
echo '
<p>'.$title.'<BR>'.$link.'</p>';
$exec = "rm -f ".$f;
exec($exec);
file_put_contents($dir,$html);
printform();
}
?>
</BODY>
</HTML>
