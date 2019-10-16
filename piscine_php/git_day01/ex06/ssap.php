#!/usr/bin/php
<?php
    function ft_split($str)
    {
        $tab = array_filter(explode(' ', trim($str)));
        sort($tab);
        return($tab);
    }
    $fin_tab = array();
    foreach($argv as $string)
    {
        if ($string != $argv[0])
            $fin_tab = array_merge($fin_tab, ft_split($string));
    }
    sort($fin_tab);
    foreach($fin_tab as $i)
    {
        echo $i . "\n";
    }
?>