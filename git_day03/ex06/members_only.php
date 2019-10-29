<?php
$log = "zaz";
$pwd = "jaimelespetitsponeys";
if ($_SERVER["PHP_AUTH_USER"] === $log && $_SERVER["PHP_AUTH_PW"] === $pwd)
{
    echo "<html><body>\nBonjour Zaz<br />\n<img src='data:image/png;base64,";
    echo base64_encode(file_get_contents("../img/42.png"));
    echo ">\n</body></html>";
}
else
{
    header("HTTP/1.0 401 Unauthorized");
    header("WWW-Authenticate: Basic realm=''Espace membres''");
    echo "<htlm><body>Cette zone est accessible uniquement aux membres du site</body></htlm>";
}
exit();
?>