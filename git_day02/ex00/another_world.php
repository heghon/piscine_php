#!/usr/bin/php
<?PHP
    $argv[1] = preg_replace('#^((\s)+|(\t)+)#', '', $argv[1]);
    $argv[1] = preg_replace('#((\s)+|(\t)+)$#', '', $argv[1]);
    $argv[1] = preg_replace('#((\s)+|(\t)+)#', ' ', $argv[1]);
        if ($argv[1])
    echo $argv[1] . "\n";
    // $tab = array_filter(explode(" ", $argv[1]));
    // $str = implode($tab, "\t");
    // $tab = array_filter(explode("\t", $str));
    // $str = implode($tab, " ");
    // if ($str)
    //     echo "$str\n";
?>