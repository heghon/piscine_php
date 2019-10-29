#!/usr/bin/php
<?PHP
$lien = curl_init($argv[1]);
$str = curl_exec($lien);
$name = preg_replace("#https?://#", "", $argv[1]);
// mkdir($name);
curl_close($lien);
?>