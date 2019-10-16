#!/usr/bin/php
<?php
function ft_split($str)
{
    $tab = array_filter(explode(' ', trim($str)));
    if ($str != NULL)
        sort($tab);
    return($tab);
}
?>