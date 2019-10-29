<?php

class UnholyFactory
{

    protected $army = array();

    public function absorb($skeleton)
    {
        foreach($this->army as $dudes)
        {
            if ($dudes->class == $skeleton->class)
            {
                echo "(Factory already absorbed a fighter of type " . $skeleton->class . ")\n";
                return;
            }
        }
        if ($skeleton instanceof Fighter)
        {
            $this->army[$skeleton->class] = $skeleton;
            echo "(Factory absorbed a fighter of type " . $skeleton->class . ")\n";
        }
        else
            echo "(Factory can't absorb this, it's not a fighter)\n";
    }

    public function fabricate($soldier)
    {
        foreach($this->army as $dudes)
        {
            if ($dudes->class == $soldier)
            {
                echo "(Factory fabricates a fighter of type $soldier)\n";
                return ($this->army[$soldier]);
            }
        }
        echo "(Factory hasn't absorbed any fighter of type $soldier)\n";
    }
}

?>