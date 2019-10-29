<?PHP
if (isset($_GET[action]))
{
    if ($_GET[action] === "set" && isset($_GET[name]) && isset($_GET[value]))
        setcookie($_GET[name], $_GET[value], time() + 365*24);
    else if ($_GET[action] === "get" && isset($_COOKIE[$_GET[name]]))
        echo $_COOKIE[$_GET[name]] . "\n";
    else if ($_GET[action] === "del" && isset($_COOKIE[$_GET[name]]))
        setcookie($_GET[name], "pouet", time() - 3600);
}
?>