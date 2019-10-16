#!/usr/bin/php
<?PHP
    if ($argc != 2)
        echo "Incorrect Parameters\n";
    else
    {
        $tab = sscanf($argv[1], "%d %c %d %s");
        if (is_numeric($tab[0]) && ($tab[1] == "+" || $tab[1] == "-" || $tab[1] == "*" || $tab[1] == "/" || $tab[1] == "%") && is_numeric($tab[0]) && empty($tab[3]) == TRUE)
        {
            if ($tab[1] == "+")
                echo $tab[0] + $tab[2] . "\n";
            else if ($tab[1] == "-")
                echo $tab[0] - $tab[2] . "\n";
            else if ($tab[1] == "*")
                echo $tab[0] * $tab[2] . "\n";
            else if ($tab[1] == "/")
                echo $tab[0] / $tab[2] . "\n";
            else if ($tab[1] == "%")
                echo $tab[0] % $tab[2] . "\n";
        }
        else
            echo "Syntax Error\n";
    }
?>