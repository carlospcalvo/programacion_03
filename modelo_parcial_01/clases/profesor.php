<?php
class Profesor{
    public $nombre;
    public $legajo;

    public function __construct(string $nombre = '', int $legajo = 0){
        
        if(!empty($nombre) && $legajo > 0){
            $this->nombre = $nombre;
            $this->legajo = $legajo;
        }   
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    public function Equals($profesor1, $profesor2){
        if($profesor1->legajo == $profesor2->legajo)
        {
            return true;
        } 
        return false;
    }

    public function __toString(){
        return json_encode($this);
       // return $this->nombre.', '.$this->legajo.PHP_EOL;
    }
}

function profesorExists($profesor, $profesores){
    $flag = false;
    foreach($profesores as $value) {
        if($profesor->Equals($profesor, $value)){
            $flag = true;
            break;
        }
    }
    
    return $flag;
}

function mostrarProfesores(array $profesores){
    echo "Profesores: <br>";
    foreach ($profesores as $value) {
        echo "$value->nombre,<br>";
    }

}
?>