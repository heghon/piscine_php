#!/usr/bin/php
<?PHP
    function wrong()
    {
        echo "Wrong Format\n";
        exit();
    }
    if ($argc != 2)
        exit();

    if (preg_match('#^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)\s([12]?[0-9]|3[01])\s([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre)\s((19[789][0-9])|(2[01][0-9]{2}))\s((2[0-4]|[01][0-9])(:[0-5][0-9]){2})$#', $argv[1]))
    {
        $tab = array_filter(explode(' ', trim($argv[1])));

        if ($tab[0] == "Lundi" || $tab[0] == "lundi")
            $tab[0] = 4;
        else if ($tab[0] == "Mardi" || $tab[0] == "mardi")
            $tab[0] = 5;
        else if ($tab[0] == "Mercredi" || $tab[0] == "mercredi")
            $tab[0] = 6;
        else if ($tab[0] =="Jeudi" || $tab[0] == "jeudi")
            $tab[0] = 0;
        else if ($tab[0] == "Vendredi" || $tab[0] == "vendredi")
            $tab[0] = 1;
        else if ($tab[0] == "Samedi" || $tab[0] == "samedi")
            $tab[0] = 2;
        else if ($tab[0] == "Dimanche" || $tab[0] == "dimanche")
            $tab[0] = 3;

        if ($tab[2] == "Janvier" || $tab[2] == "janvier")
            $tab[2] = 0;
        else if ($tab[2] == "Fevrier" || $tab[2] == "fevrier")
            $tab[2] = 1;
        else if ($tab[2] == "Mars" || $tab[2] == "mars")
            $tab[2] = 2;
        else if ($tab[2] == "Avril" || $tab[2] == "avril")
            $tab[2] = 3;
        else if ($tab[2] == "Mai" || $tab[2] == "mai")
            $tab[2] = 4;
        else if ($tab[2] == "Juin" || $tab[2] == "juin")
            $tab[2] = 5;
        else if ($tab[2] == "Juillet" || $tab[2] == "juillet")
            $tab[2] = 6;
        else if ($tab[2] == "Aout" || $tab[2] == "aout")
            $tab[2] = 7;
        else if ($tab[2] == "Septembre" || $tab[2] == "septembre")
            $tab[2] = 8;
        else if ($tab[2] == "Octobre" || $tab[2] == "octobre")
            $tab[2] = 9;
        else if ($tab[2] == "Novembre" || $tab[2] == "novembre")
            $tab[2] = 10;
        else if ($tab[2] == "Decembre" || $tab[2] == "decembre")
            $tab[2] = 11;

        $hour = array_filter(explode(':', trim($tab[4])));

        $jour_passes = $tab[1] - 1;
        for ($annee = 1970; $annee < $tab[3]; $annee++)
        {
            if (($annee - 1972) % 4 == 0)
                $jour_passes += 366;
            else
                $jour_passes += 365;
        }
        for ($i = 0; $i < $tab[2]; $i++)
        {
            if ($i == 0 | $i == 2 | $i == 4 | $i == 6 | $i == 7 | $i == 9 | $i == 11)
                $jour_passes += 31;
            else if ($i == 1 && ($tab[3] - 1972) % 4 == 0)
                $jour_passes += 29;
            else if ($i == 1 && ($tab[3] - 1972) % 4 != 0)
                $jour_passes += 28;
            else
                $jour_passes += 30;
        }

        if ($jour_passes % 7 != $tab[0])
            wrong();

        $total = ($hour[2] + $hour[1] * 60 + $hour[0] * 3600);
        $total += (86400 * ($tab[1] - 1));
        for ($annee = 1970; $annee < $tab[3]; $annee++)
        {
            if (($annee - 1972) % 4 == 0)
                $total += 366 * 86400;
            else
                $total += 365 * 86400;
        }
        for ($i = 0; $i < $tab[2]; $i++)
        {
            if ($i == 0 | $i == 2 | $i == 4 | $i == 6 | $i == 7 | $i == 9 | $i == 11)
                $total += 31 * 86400;
            else if ($i == 1 && ($tab[3] - 1972) % 4 == 0)
                $total += 29 * 86400;
            else if ($i == 1 && ($tab[3] - 1972) % 4 != 0)
                $total += 28 * 86400;
            else
                $total += 30 * 86400;
        }
        echo $total . "\n";
    }
    else
        wrong();
?>