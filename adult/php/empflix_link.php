#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start); 
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini; 
	return substr($string,$ini,$len); 
}
//http://fck-c06.empflix.com/dev6/0/001/278/0001278761.fid?key=9cae6fe65285c1bbd00f6f953124bef3&src=emp
//http://fck-c06.empflix.com/dev6/0/001/278/0001278761.fid?key=9cae6fe65285c1bbd00f6f953124bef3&src=emp
//http://fck-c02.empflix.com/dev2/0/001/283/0001283707.fid?key=7a30c311e942e6db40c73bbbe579c403&src=emp
//http://fck-c02.empflix.com/dev2/0/001/283/0001283707.fid?key=7a30c311e942e6db40c73bbbe579c403&src=emp
$link = $_GET["file"];
$html = file_get_contents($link);
$link = str_between($html, 'flashvars.config = escape("', '"');
$html = file_get_contents($link);
$link1 = str_between($html, "<videoLink>", "</videoLink>");
$link1=str_replace("&amp;","&",$link1);
print $link1;
?>
