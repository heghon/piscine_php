<?php
    require_once 'Vector.class.php';

    class Matrix
    {

        public static $verbose = False;

        private $_mat;
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;

        const IDENTITY = "IDENTITY";
        const SCALE = "SCALE";
        const RX = "RX";
        const RY = "RY";
        const RZ = "RZ";
        const TRANSLATION = "TRANSLATION";
        const PROJECTION = "PROJECTION";

        public function __construct($tab = null)
        {
            if (isset($tab))
            {
                if (isset($tab['preset']) && in_array($tab['preset'], [self::IDENTITY, self::SCALE, self::RX, self::RY, self::RZ, self::TRANSLATION, self::PROJECTION]))
                    $this->_preset = $tab['preset'];
                if (isset($tab['scale']))
                    $this->_scale = $tab['scale'];
                if (isset($tab['angle']))
                    $this->_angle = $tab['angle'];
                if (isset($tab['vtc']))
                    $this->_vtc = $tab['vtc'];
                if (isset($tab['fov']))
                    $this->_fov = $tab['fov'];
                if (isset($tab['ratio']))
                    $this->_ratio = $tab['ratio'];
                if (isset($tab['near']))
                    $this->_near = $tab['near'];
                if (isset($tab['far']))
                    $this->_far = $tab['far'];
                if ($this->_preset === self::IDENTITY)
                    $this->identity(1.0);
                if ($this->_preset === self::TRANSLATION)
                    $this->translation(1.0);
                else if ($this->_preset === self::SCALE)
                    $this->identity($this->_scale);
                else if ($this->_preset === self::SCALE)
                    $this->translation(1.0);
                else if ($this->_preset === self::RX)
                    $this->r_x(1.0);
                else if ($this->_preset === self::RY)
                    $this->r_y(1.0);
                else if ($this->_preset === self::RZ)
                    $this->r_z(1.0);
                else if ($this->_preset === self::PROJECTION)
                    $this->projection();
            }
            if (self::$verbose == True)
            {
                if ($this->_preset == self::IDENTITY)
                        echo "Matrix " . $this->_preset . " instance constructed\n";
                    else
                        echo "Matrix " . $this->_preset . " preset instance constructed\n";
            }
        }

        public function __destruct()
        {
            if (self::$verbose == True)
                printf("Matrix instance destructed\n");
        }

        public static function doc()
        {
            $content = file_get_contents('Matrix.doc.txt');
            echo "\n$content\n";
        }

        public function __toString()
        {
            $str = "M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %0.2f | %0.2f | %0.2f | %0.2f\ny | %0.2f | %0.2f | %0.2f | %0.2f\nz | %0.2f | %0.2f | %0.2f | %0.2f\nw | %0.2f | %0.2f | %0.2f | %0.2f";
            return (sprintf($str, $this->_mat[0][0], $this->_mat[0][1], $this->_mat[0][2], $this->_mat[0][3], $this->_mat[1][0], $this->_mat[1][1], $this->_mat[1][2], $this->_mat[1][3], $this->_mat[2][0], $this->_mat[2][1], $this->_mat[2][2], $this->_mat[2][3], $this->_mat[3][0], $this->_mat[3][1], $this->_mat[3][2], $this->_mat[3][3]));
        }

        private function identity($i)
        {
            $this->_mat[0][0] = $i;
            $this->_mat[0][1] = 0.0;
            $this->_mat[0][2] = 0.0;
            $this->_mat[0][3] = 0.0;
            $this->_mat[1][0] = 0.0;
            $this->_mat[1][1] = $i;
            $this->_mat[1][2] = 0.0;
            $this->_mat[1][3] = 0.0;
            $this->_mat[2][0] = 0.0;
            $this->_mat[2][1] = 0.0;
            $this->_mat[2][2] = $i;
            $this->_mat[2][3] = 0.0;
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = 0.0;
            $this->_mat[3][3] = 1.0;
        }

        private function translation($i)
        {
            $this->_mat[0][0] = $i;
            $this->_mat[0][1] = 0.0;
            $this->_mat[0][2] = 0.0;
            $this->_mat[0][3] = $this->_vtc->getX();
            $this->_mat[1][0] = 0.0;
            $this->_mat[1][1] = $i;
            $this->_mat[1][2] = 0.0;
            $this->_mat[1][3] = $this->_vtc->getY();
            $this->_mat[2][0] = 0.0;
            $this->_mat[2][1] = 0.0;
            $this->_mat[2][2] = $i;
            $this->_mat[2][3] = $this->_vtc->getZ();
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = 0.0;
            $this->_mat[3][3] = 1.0;
        }

        private function r_x($i)
        {
            $this->_mat[0][0] = $i;
            $this->_mat[0][1] = 0.0;
            $this->_mat[0][2] = 0.0;
            $this->_mat[0][3] = 0.0;
            $this->_mat[1][0] = 0.0;
            $this->_mat[1][1] = cos($this->_angle);
            $this->_mat[1][2] = -sin($this->_angle);;
            $this->_mat[1][3] = 0.0;
            $this->_mat[2][0] = 0.0;
            $this->_mat[2][1] = sin($this->_angle);
            $this->_mat[2][2] = cos($this->_angle);;
            $this->_mat[2][3] = 0.0;
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = 0.0;
            $this->_mat[3][3] = 1.0;
        }

        private function r_y($i)
        {
            $this->_mat[0][0] = cos($this->_angle);
            $this->_mat[0][1] = 0.0;
            $this->_mat[0][2] = sin($this->_angle);
            $this->_mat[0][3] = 0.0;
            $this->_mat[1][0] = 0.0;
            $this->_mat[1][1] = $i;
            $this->_mat[1][2] = 0.0;
            $this->_mat[1][3] = 0.0;
            $this->_mat[2][0] = -sin($this->_angle);
            $this->_mat[2][1] = 0.0;
            $this->_mat[2][2] = cos($this->_angle);;
            $this->_mat[2][3] = 0.0;
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = 0.0;
            $this->_mat[3][3] = 1.0;
        }

        private function r_z($i)
        {
            $this->_mat[0][0] = cos($this->_angle);
            $this->_mat[0][1] = -sin($this->_angle);
            $this->_mat[0][2] = 0.0;
            $this->_mat[0][3] = 0.0;
            $this->_mat[1][0] = sin($this->_angle);
            $this->_mat[1][1] = cos($this->_angle);
            $this->_mat[1][2] = 0.0;
            $this->_mat[1][3] = 0.0;
            $this->_mat[2][0] = 0.0;
            $this->_mat[2][1] = 0.0;
            $this->_mat[2][2] = $i;
            $this->_mat[2][3] = 0.0;
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = 0.0;
            $this->_mat[3][3] = 1.0;
        }

        private function projection()
        {
            $this->_mat[1][1] = 1 / tan(0.5 * deg2rad($this->_fov));

            $this->_mat[0][0] = $this->_mat[1][1] / $this->_ratio;
            $this->_mat[0][1] = 0.0;
            $this->_mat[0][2] = 0.0;
            $this->_mat[0][3] = 0.0;
            $this->_mat[1][0] = 0.0;

            $this->_mat[1][2] = 0.0;
            $this->_mat[1][3] = 0.0;
            $this->_mat[2][0] = 0.0;
            $this->_mat[2][1] = 0.0;
            $this->_mat[2][2] = -1.0 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->_mat[2][3] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->_mat[3][0] = 0.0;
            $this->_mat[3][1] = 0.0;
            $this->_mat[3][2] = -1.0;
            $this->_mat[3][3] = 0.0;
        }

        public function mult(Matrix $rhs)
        {
            $tmp = array();
            for ($i = 0; $i < 4; $i++)
            {
                for ($j = 0; $j < 4; $j++)
                {
                    $tmp[$i][$j] = 0;
                    $tmp[$i][$j] += $this->_mat[$i][0] * $rhs->_mat[0][$j];
                    $tmp[$i][$j] += $this->_mat[$i][1] * $rhs->_mat[1][$j];
                    $tmp[$i][$j] += $this->_mat[$i][2] * $rhs->_mat[2][$j];
                    $tmp[$i][$j] += $this->_mat[$i][3] * $rhs->_mat[3][$j];
                }
            }
            $new = new Matrix();
            $new->_mat = $tmp;
            return $new;
        }
        public function transformVertex(Vertex $vtx)
        {
            $tmp = array();
            $tmp['x'] = ($vtx->getX() * $this->_mat[0][0]) + ($vtx->getY() * $this->_mat[0][1]) + ($vtx->getZ() * $this->_mat[0][2]) + ($vtx->getW() * $this->_mat[0][3]);
            $tmp['y'] = ($vtx->getX() * $this->_mat[1][0]) + ($vtx->getY() * $this->_mat[1][1]) + ($vtx->getZ() * $this->_mat[1][2]) + ($vtx->getW() * $this->_mat[1][3]);
            $tmp['z'] = ($vtx->getX() * $this->_mat[2][0]) + ($vtx->getY() * $this->_mat[2][1]) + ($vtx->getZ() * $this->_mat[2][2]) + ($vtx->getW() * $this->_mat[2][3]);
            $tmp['w'] = ($vtx->getX() * $this->_mat[3][0]) + ($vtx->getY() * $this->_mat[3][1]) + ($vtx->getZ() * $this->_mat[3][2]) + ($vtx->getW() * $this->_mat[3][3]);
            $tmp['color'] = $vtx->getColor();
            $result = new Vertex($tmp);
            return $result;
        }

    }
?>