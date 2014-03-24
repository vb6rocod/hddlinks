#!/usr/local/bin/Resource/www/cgi-bin/php
<HTML>
<HEAD>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.replace('/cgi-bin/scripts/util/browser.php');",timeoutPeriod);
}
//   -->
</script>
 <TITLE>Download via browser</TITLE>
 <link type='text/css' rel='stylesheet' href='/cube_web_management.css' />
</HEAD>
<body onload="JavaScript:timedRefresh(20000);">
<h2>Download Manager</h2>
<form action="browser.php" method="get">
Link: <input type="text" SIZE=100 name="link" />
<input type="submit" />
<input type="hidden" name="action" value="download" />
</form>
<table align="center">
<tr>
<td><form action="browser.php" method="get">
<input type="hidden" name="action" value="all" />
<input type="submit" value="Stop all - delete list" />
</form></td>
</tr>
</table>
<?php
error_reporting(0);
$action = $_GET["action"];
if ($action == "download") {
$a = urldecode($_GET["link"]);
$b=explode(",",$a);
$link=$b[0];
$titledownload=$b[1];
$titledownload = preg_replace('/[^A-Za-z0-9_]/','_',$titledownload);
$titledownload = substr($titledownload, 0, -4);
if (isset($link)) {
   if ($titledownload == "") {
   $titledownload = substr(strrchr($link,"/"),1);
   }
   $pct = substr($titledownload, -4, 1);
   if ($pct == ".") {
      $ext = substr($titledownload, -3);
      $titledownload = substr($titledownload, 0, -4);
   } else {
      $ext = "flv";
   }
   $titledownload = preg_replace('/[^A-Za-z0-9_]/','_',$titledownload);
$link = 'http://127.0.0.1/cgi-bin/scripts/util/download.cgi?link='.$link.';name='.$titledownload.'.'.$ext;
$handle = fopen($link,'r');
fclose($handle);
sleep(3);
}
} elseif ($action == "manage") {
  $go = $_GET["go"];
  if ($go=="start") {
     //http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?link='.$link.';name='.$t1[0].';go=start
     $link = $_GET["link"];
     $name = $_GET["name"];
     $link = "http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?link=".$link.";name=".$name.";go=start";
     $handle = fopen($link,'r');
     fclose($handle);
     sleep(3);
  } elseif ($go=="stop") {
     //http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?pid='.$pid[0].';name='.$t1[0].';go=stop
     $pid = $_GET["pid"];
     $name = $_GET["name"];
     $link = "http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?pid=".$pid.";name=".$name.";go=stop";
     $handle = fopen($link,'r');
     fclose($handle);
     sleep(3);
  } elseif ($go=="delete") {
    //http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?name='.$t1[0].';go=delete
    $name = $_GET["name"];
    $link = "http://127.0.0.1/cgi-bin/scripts/util/manag.cgi?name=".$name.";go=delete";
    $handle = fopen($link,'r');
    fclose($handle);
    sleep(3);
  }
} elseif ($action == "all") {
  $link = "http://127.0.0.1/cgi-bin/scripts/util/stop_exua.cgi";
  $handle = fopen($link,'r');
  fclose($handle);
  sleep(3);
}
clearstatcache();
if (file_exists("/tmp/usbmounts/sda1/download")) {
   $dir = "/tmp/usbmounts/sda1/download/log/*log";
} elseif (file_exists("/tmp/usbmounts/sdb1/download")) {
   $dir = "/tmp/usbmounts/sdb1/download/log/*log";
} elseif (file_exists("/tmp/usbmounts/sdc1/download")) {
   $dir = "/tmp/usbmounts/sdc1/download/log/*log";
} elseif (file_exists("/tmp/usbmounts/sda2/download")) {
   $dir = "/tmp/usbmounts/sda2/download/log/*log";
} elseif (file_exists("/tmp/usbmounts/sdb2/download")) {
   $dir = "/tmp/usbmounts/sdb2/download/log/*log";
} elseif (file_exists("/tmp/usbmounts/sdc2/download")) {
   $dir = "/tmp/usbmounts/sdc2/download/log/*log";
} elseif (file_exists("/tmp/hdd/volumes/HDD1/download")) {
   if (file_exists("/tmp/hdd/root"))
     $dir = "/tmp/hdd/root/log/*log";
   else
     $dir = "/tmp/hdd/volumes/HDD1/download/log/*log";
} else {
     $dir = "";
}
echo '
<table border=1 width=100%>
';
if ($dir <> "") {
$file_list = glob($dir);
for ($i=0; $i< count($file_list); $i++) {
$log_file = file($file_list[$i]);
$t1 = explode('/log/', $file_list[$i]);
$t1 = explode('.log', $t1[1]);
$log = $log_file[count($log_file) -4];
$t3 = explode("K", $log);
$t4 = substr($log, -25);
$t5 = explode("%", $log);
$end = substr($t5[0], -3);
if (strpos($log_file,"saved") === true) {
  $end = "100";
}
$t0 = $i+1;
//pid
$pd = "/tmp/".$t1[0].".pid";
$pid_file = file($pd);
$pid = explode('pid ', $pid_file[0]);
$pid = explode('.', $pid[1]);
//url
$log_url =  $log_file[0];
$url = explode('http://', $log_url);
$link = str_replace("\r","",$url[1]);
$link = str_replace("\n","",$link);
$link = 'http://'.$link;
//title
$title = $t0.'. '. $t1[0].' -  '.$t3[0].'KB'.$t4;
   echo '
   <tr>
   <td>'.$title.'</td>';
	//echo '<name>'.$t1[0].'</name>';
	//echo '<logfile>'.$file_list[$i].'</logfile>';
if ($end != "100") {
	if (!$pid_file) {
       echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="link" value="'.$link.'" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="start" />
       <input type="submit" value = "start"/>
       </td></form>
       ';
       echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="delete" />
       <input type="submit" value = "delete"/>
       </td></form>
       </tr>
       ';
	} else {
        echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="pid" value="'.$pid[0].'" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="stop" />
       <input type="submit" value = "stop"/>
       </td></form>
       ';
       echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="link" value="'.$link.'" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="delete" />
       <input type="submit" value = "delete"/>
       </td></form>
       </tr>
       ';
	}
} else {
       echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="delete" />
       <input type="submit" value = "delete"/>
       </td></form>
       ';
       echo '
       <td>
       <form action="browser.php" method="get">
       <input type="hidden" name="action" value="manage" />
       <input type="hidden" name="name" value="'.$t1[0].'" />
       <input type="hidden" name="go" value="delete" />
       <input type="submit" value = "delete"/>
       </td></form>
       </tr>
       ';
}
}
}
echo '</table>';
?>
</BODY>
</HTML>
