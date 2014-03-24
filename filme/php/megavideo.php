#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $user = $queryArr[0];
   $pass = $queryArr[1];
}
function getMegauploadCookie($username, $password) {
    $link = "http://www.megaupload.com";
    $postdata = http_build_query(
            array(
            'username' => $username,
            'password' => $password,
            'login' => '1',
            'redir' => '1'
            )
    );
    $opts = array('http' =>
            array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
            )
    );
    $context  = stream_context_create($opts);
    $content = file_get_contents($link, false, $context);

    foreach ( $http_response_header as $value) {
        if( stripos($value, "cookie") ) {
            $content = substr( $value, strpos($value,"=")+1);
            $content = substr( $content, 0, strpos($content,";") );
        }
    }
    return $content;

}
$cookie=getMegauploadCookie($user,$pass);
if ($cookie <> "") {
exec ("rm -f /usr/local/etc//usr/local/etc/dvdplayer/megavideo.dat");
 $handle = fopen("/usr/local/etc//usr/local/etc/dvdplayer/megavideo.dat", "w");
 fwrite($handle,$c);
 fclose($handle);
}
?>
