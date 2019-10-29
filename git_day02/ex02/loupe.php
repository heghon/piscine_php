#!/usr/bin/php
<?PHP
function loupe2($matches)
{
    return ($matches[1] . strtoupper($matches[2]) . ($matches[3]));
}

function loupe($matches)
{
    $str = preg_replace_callback(array('#(title=")(.*?)"#', '#(>)(.*?)(<)#'), loupe2, $matches[0]);
    return ($str);
}

if ($argc != 2)
    exit();
if (!file_exists($argv[1]))
    exit();
$str = file_get_contents( $argv[1]);
$str = preg_replace_callback(array('#<a href=(.*?)>(.*?)<\/a>#'), loupe, $str);
echo $str;

?>