#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $myfile = $queryArr[0];
   $tip = $queryArr[1];
}
$log_file = file($myfile);
$t1 = explode('/log/', $myfile);
$t1 = explode('.log', $t1[1]);
$log = $log_file[count($log_file) -4];
$t3 = explode("K", $log);
$t4 = substr($log, -25);
$t5 = explode("%", $log);
$end = substr($t5[0], -3);
if (strpos($log_file,"saved") === true) {
  $end = "100";
}
$title = $t3[0].'KB'.$t4;
if ($end=="100") {
print "Ready";
} else {
print $title;
}
?>
