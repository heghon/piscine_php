<?php

class NightsWatch
{
    protected $recruits = array();
    protected $position = 0;

    public function recruit($person)
    {
        $this->recruits[$this->position] = $person;
        $this->position++;
    }
    public function fight()
    {
        foreach ($this->recruits as $fighter)
        {
            if (method_exists(get_class($fighter), 'fight'))
                $fighter->fight();
        }
    }
}

?>