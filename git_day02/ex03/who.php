#!/usr/bin/php
<?PHP
date_default_timezone_set('Europe/Paris');
$fd = fopen("/var/run/utmpx", "r'");
while ($str = fread($fd, 628))
{
    $str_unpack = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $str);
    if ($str_unpack["type"] == 7)
    {
        $user[] = $str_unpack["user"];
        $line[] = $str_unpack["line"];
        $time[] = $str_unpack["time1"];
    }
}
for ($i = 0; $i < sizeof($user); $i++)
{
    echo "$user[$i]\t $line[$i]  " . date("M j H:i", $time[$i]) . "\n";
}
fclose ($fd);
?>