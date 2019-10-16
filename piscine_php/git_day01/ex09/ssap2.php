#!/usr/bin/php
<?php
    function ft_split($str)
    {
        $tab = array_filter(explode(' ', trim($str)));
        sort($tab);
        return($tab);
    }
    if (argc != 1)
    {
        $big_tab = array();
        $num_tab = array();
        $other_tab = array();
        $alpha_tab = array();
        foreach($argv as $string)
        {
            if ($string != $argv[0])
                $big_tab = array_merge($big_tab, ft_split($string));
        }
        foreach ($big_tab as $element)
        {
            if (is_numeric($element) == TRUE)
                $num_tab[] = $element;
            else if (ctype_alpha($element) == TRUE)
                $alpha_tab[] = $element;
            else
                $other_tab[] = $element;
        }
        sort($num_tab, SORT_STRING);
        sort($alpha_tab, SORT_NATURAL | SORT_FLAG_CASE);
        sort($other_tab);
        foreach($alpha_tab as $i)
            echo $i . "\n";
        foreach($num_tab as $i)
            echo $i . "\n";
        foreach($other_tab as $i)
            echo $i . "\n";
    }
?>