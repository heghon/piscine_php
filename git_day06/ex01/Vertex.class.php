<?php
    require_once 'Color.class.php';

    class Vertex
    {

        public static $verbose = False;
        private $_x;
        private $_y;
        private $_z;
        private $_w;
        private $_color;

        public function __construct($tab)
        {
            $this->_x = $tab['x'];
            $this->_y = $tab['y'];
            $this->_z = $tab['z'];
            if (isset($tab['w']))
                $this->_w = $tab['w'];
            else
                $this->_w = 1.0;
            if (isset($tab['color']) && $tab['color'] instanceof Color)
                $this->_color = $tab['color'];
            else
                $this->_color = new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255));
            if (self::$verbose == True)
            {
                printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color: ( red: %3d, green: %3d, blue: %3d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
            }
        }

        public function __destruct()
        {
            if (self::$verbose == True)
            printf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color: ( red: %3d, green: %3d, blue: %3d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
        }

        public static function doc()
        {
            $content = file_get_contents('Vertex.doc.txt');
            echo "\n$content\n";
        }

        public function __toString()
        {
            if (self::$verbose == True)
                return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, Color: ( red: %3d, green: %3d, blue: %3d ) )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue));
            else
                return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", $this->_x, $this->_y, $this->_z, $this->_w));

        }

        public function getX()
        {
            return $this->_x;
        }

        public function setX($data)
        {
            if (is_float($data))
                $this->_x = $data;
        }
        
        public function getY()
        {
            return $this->_y;
        }

        public function setY($data)
        {
            if (is_float($data))
                $this->_y = $data;
        }

        public function getZ()
        {
            return $this->_z;
        }

        public function setZ($data)
        {
            if (is_float($data))
                $this->_z = $data;
        }

        public function getW()
        {
            return $this->_w;
        }

        public function setW($data)
        {
            if (is_float($data))
                $this->_w = $data;
        }

        public function getColor()
        {
            return $this->_color;
        }

        public function setColor($data)
        {
            if ($this->_color === $data)
                $this->_color = $data;
        }
    }
?>