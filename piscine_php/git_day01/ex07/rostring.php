#!/usr/bin/php
<?php
    function ft_split($str)
    {
        $tab = array_filter(explode(' ', trim($str)));
        return($tab);
    }
    $tab = ft_split($argv[1]);
    foreach ($tab as $string)
    {
        if ($string != $tab[0])
            echo $string . " ";
    }
    echo $tab[0] . "\n";
?>