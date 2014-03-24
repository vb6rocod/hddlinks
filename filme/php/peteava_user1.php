#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
clearstatcache();
if (file_exists("/usr/local/etc/dvdplayer/peteava.dat")) {
   $dir = "/usr/local/etc/dvdplayer/peteava.dat";
} else {
     $dir = "";
}
$query = $_GET["mod"];
if($query) {
   $queryArr = explode(',', $query);
   $mod = $queryArr[0];
   $user = $queryArr[1];
}
if ($mod == "add") {
if ($dir <> "") {
$html=file_get_contents($dir);
$html=$html.",".$user;
} else {
$dir = "/usr/local/etc/dvdplayer/peteava.dat";
$html=$user;
}
exec('rm -f  /usr/local/etc/dvdplayer/peteava.dat');
file_put_contents($dir,$html);
} else if ($mod="delete") {
$html=file_get_contents("/usr/local/etc/dvdplayer/peteava.dat");
$u=explode(",",$html);
$out="";
for ($i=0;$i<count($u);$i++){
if ($u[$i] <> $user) {
$out=$out.$u[$i].",";
}
}
$out = substr($out, 0, -1);
if ($out <> "") {
exec('rm -f  /usr/local/etc/dvdplayer/peteava.dat');
file_put_contents("/usr/local/etc/dvdplayer/peteava.dat",$out);
} else {
exec('rm -f  /usr/local/etc/dvdplayer/peteava.dat');
}
}

