<?php

class Tyrion extends Lannister
{
    public function sleepWith($person)
    {
        if ($person instanceof Lannister)
            print("Not even if I'm drunk !\n");
        else
            print("Let's do this\n");
    }
}

?>