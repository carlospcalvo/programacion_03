<?php
    include_once __DIR__.'\Files.php';

    class Auto extends Files{
        private $_id;
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;

        function __construct($id = 0, $marca = '', $color = '', $precio = 'S/D', $fecha = null ) {
            $this->_id = $id;
            $this->_color = $color; 
            $this->_marca = $marca; 
            $this->_precio = $precio; 
            $this->_fecha = $fecha; 

        }

        public static function MostrarAuto($auto) {
            echo "<br>Marca: $auto->_marca, Color: $auto->_color, Precio: $$auto->_precio, Fecha: $auto->_fecha"; 
        }

        public static function Add($auto1, $auto2) {
            if($auto1->_marca == $auto2->_marca && $auto1->_color == $auto2->_color) 
            {
                return $auto1->_precio + $auto2->_precio;
            } else
            {
                echo "Los autos son de distinta marca o color";
                return 0;
            }
        }

        public function AgregarImpuestos($impuestos) {
            if(is_numeric($this->_precio) && is_numeric($impuestos))
            {
                $this->_precio += $impuestos; 
            }

        }        

        public function Equals($auto1, $auto2) {
            if($auto1->_marca == $auto2->_marca)
            {
                return true;
            } 
            return false;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        public function __get($name)
        {
            return $this->$name;
        }


        public function __toString(){
            return json_encode($this);
            //return $this->_id.', '.$this->_marca.', '.$this->_color.', '.$this->_precio.PHP_EOL;
        }
        /*
        public function save(string $archivo = '', string $modo = '', string $contenido = $this){
            return parent::EscribirArchivo($archivo, $modo, $contenido);
        }
        
        public function read(string $archivo = '', string $modo = '', string $separador = ', ', int $cant_datos = 3){
            return parent::LeerArchivo($archivo, $modo, $separador, $cant_datos);    
        }
        */
    }