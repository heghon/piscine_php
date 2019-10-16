#!/usr/bin/php
<?PHP
    $tab = array_filter(explode(" ", $argv[1]));
    $str = implode($tab, "\t");
    $tab = array_filter(explode("\t", $str));
    $str = implode($tab, " ");
    if ($str)
        echo "$str\n";
?>