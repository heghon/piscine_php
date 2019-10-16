#!/usr/bin/php
<?php
    function ft_is_sort($tab)
    {
        foreach ($tab as $word)
            $tmp[] = $word;
        sort($tab);
        foreach ($tmp as $i => $word)
        {
            if ($tmp[$i] != $tab[$i])
                return (0);
        }
        return(1);
    }
?>