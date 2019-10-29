<?php

class Jaime extends Lannister
{
    public function sleepWith($person)
    {
        if ($person instanceof Tyrion)
            print("Not even if I'm drunk !\n");
        else if ($person instanceof Cersei)
            print("With pleasure, but only in a tower in Winterfell, then.\n");
        else
            print("Let's do this\n");
    }
}

?>