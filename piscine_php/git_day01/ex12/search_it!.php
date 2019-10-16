#!/usr/bin/php
<?PHP
    if ($argc < 3)
        exit();
    else
    {
        foreach ($argv as $i => $e)
        {
            if ($i > 1)
            {
                $tab = explode(":", $e);
                if ($tab[0] == $argv[1])
                    echo $tab[1] . "\n";
            }
        }
    }
?>