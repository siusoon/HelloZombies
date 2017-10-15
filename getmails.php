#!/usr/local/bin/php -q

<?php 
ini_set('track_errors', 1);
error_reporting(E_ALL);
$url = "http://www.stopforumspam.com/downloads/listed_email_1.zip";
$file = "file.zip";
$src = fopen($url, 'r');
if ( !$src ) {
  echo 'fopen failed. reason: ', $php_errormsg;
}
$dest = fopen($file, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied.\n";

$zip = new ZipArchive;
if($zip->open($file) === TRUE) {
   $zip->extractTo('list_output');
   $zip->close();
}
rename('list_output/listed_email_1.txt', 'list_output/list.txt');

?> 