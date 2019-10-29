<?php
    class Color
    {
        public static $verbose = False;
        public $red;
        public $blue;
        public $green;

        public function __construct($tab)
        {
            if (isset($tab['rgb']))
                $this->set_rgb($tab['rgb']);
            else if (isset($tab['red']) && isset($tab['blue']) && isset($tab['green']))
            {
                $this->set_red($tab['red']);
                $this->set_green($tab['green']);
                $this->set_blue($tab['blue']);
            }
            if (self::$verbose == True)
            {
                printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
            }
        }

        public function __destruct()
        {
            if (self::$verbose == True)
                printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
        }

        public static function doc()
        {
            $content = file_get_contents('Color.doc.txt');
            echo "\n$content\n";
        }

        public function __toString()
        {
            return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
        }

        public function set_rgb($color)
        {
            $this->set_red($color >> 16);
            $color -= ($color >> 16) << 16;
            $this->set_green($color >> 8);
            $color -= ($color >> 8) << 8;
            $this->set_blue($color);
        }
        public function set_red($color)
        {
            if (intval($color) > -1 && intval($color) < 256)
                $this->red = intval($color);
        }
        public function set_blue($color)
        {
            if (intval($color) > -1 && intval($color) < 256)
                $this->blue = intval($color);
        }
        public function set_green($color)
        {
            if (intval($color) > -1 && intval($color) < 256)
                $this->green = intval($color);
        }

        public function add($rhs)
        {
            return (new Color(array('red' => $this->red + $rhs->red, 'blue' => $this->blue + $rhs->blue, 'green' => $this->green + $rhs->green)));
        }

        public function sub($rhs)
        {
            return (new Color(array('red' => $this->red - $rhs->red, 'blue' => $this->blue - $rhs->blue, 'green' => $this->green - $rhs->green)));
        }

        public function mult($rhs)
        {
            return (new Color(array('red' => $this->red * $rhs, 'blue' => $this->blue * $rhs, 'green' => $this->green * $rhs)));

        }
    }
?>