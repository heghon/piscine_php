<?php
    require_once 'Vertex.class.php';

    class Vector
    {

        public static $verbose = False;
        private $_x;
        private $_y;
        private $_z;
        private $_w;

        public function __construct($tab)
        {
            if (isset($tab['dest']) && $tab['dest'] instanceof Vertex)
            {
                $dest = $tab['dest'];
                if (!isset($tab['orig']))
                    $orig = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0));
                else
                    $orig = $tab['orig'];
                $this->_x = $dest->getX() - $orig->getX();
                $this->_y = $dest->getY() - $orig->getY();
                $this->_z = $dest->getZ() - $orig->getZ();
                $this->_w = 0.0;
            }
            if (self::$verbose == True)
            {
                printf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
            }
        }

        public function __destruct()
        {
            if (self::$verbose == True)
            printf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        }

        public static function doc()
        {
            $content = file_get_contents('Vector.doc.txt');
            echo "\n$content\n";
        }

        public function __toString()
        {
            return (sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
        }

        public function getX()
        {
            return $this->_x;
        }
        
        public function getY()
        {
            return $this->_y;
        }

        public function getZ()
        {
            return $this->_z;
        }

        public function getW()
        {
            return $this->_w;
        }


        public function magnitude()
        {
            return (float)sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
        }

        public function normalize()
        {
            $mag = sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z));
            if ($mag == 1)
            {
                return clone $this;
            }
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x / $mag, 'y' => $this->_y / $mag, 'z' => $this->_z / $mag))));
        }

        public function add(Vector $rhs)
        {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x + $rhs->_x, 'y' => $this->_y + $rhs->_y, 'z' => $this->_z + $rhs->_z))));
        }

        public function sub(Vector $rhs)
        {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x - $rhs->_x, 'y' => $this->_y - $rhs->_y, 'z' => $this->_z - $rhs->_z))));
        }

        public function opposite()
        {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1))));
        }

        public function scalarProduct($k)
        {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k))));
        }

        public function dotProduct(Vector $rhs)
        {
            return (float)(($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z));
        }

        public function crossProduct(Vector $rhs)
        {
            return new Vector(array('dest' => new Vertex(array('x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(), 'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()))));
        }

        public function cos(Vector $rhs)
        {
            if (sqrt((($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)) * (($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z))) == 0)
                return (0);
            return ((($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z)) / sqrt((($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)) * (($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z))));
        }
    }
?>