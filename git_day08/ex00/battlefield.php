<?php

?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Space Battle</title>
    </head>

    <body>
    <header>
        <img class="flag_left" src="https://image.noelshack.com/minis/2015/33/1439483438-warhammer-40k-the-imperium-of-man-flag-by-angelalado-d7s69fo.png" alt="drapeau imperium"/> 
        Awesome Starships Battles In The Dark Grim Future Of The Grim Dark 41st Millenium
        <img class="flag_right" src="https://image.noelshack.com/minis/2015/33/1439483438-warhammer-40k-the-imperium-of-man-flag-by-angelalado-d7s69fo.png" alt="drapeau imperium"/> 
    </header>
    <p>
        <table id="battlefield">
            <caption>Zone de combat</caption>
        <tr>
<?php   $NbrLignes=101;
        $NbrColonnes=151;

        for ($i = 0; $i < $NbrLignes; $i++)
        {?>
        <tr>
<?php        for ($j = 0; $j < $NbrColonnes; $j++)
        {?>
            <td><?php 
            if ($j == 0) 
                echo "$i";
            else if ($i == 0)
                echo "$j";
            ?></td>
<?php   }?>
        </tr>
<?      }?>
        </tr>
        </table>
    </p>
    </body>
</html>