#!/usr/bin/php
<?php
while (1)
{
    echo "Entrez un nombre: ";
    $tmp = trim(fgets(STDIN));
    if (feof(STDIN) == TRUE)
		exit();
    if (is_numeric($tmp) != "integer")
        echo "'$tmp' n'est pas un chiffre\n";
    else
    {
        if ($tmp % 2 == 0)
            echo "Le chiffre $tmp est Pair\n";
        else
            echo "Le chiffre $tmp est Impair\n";
    }
}
?>