<?php
class Materia{
    public $nombre;
    public $cuatrimestre;
    public $id;

    public function __construct(string $nombre = '', int $cuatri = 0){
        if(!empty($nombre) && !empty($cuatri)){
            $this->nombre = $nombre;
            $this->cuatrimestre = $cuatri;
            $this->id = rand(1,1000);
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

    public function Equals($materia1, $materia2){
        if($materia1->nombre == $materia2->nombre)
        {
            return true;
        } 
        return false;
    }

    public function __toString(){
        return json_encode($this);
        //return $this->nombre.', '.$this->cuatrimestre.', '.$this->id.PHP_EOL;
    }
}

function materiaExists($materia, $materias){
    $flag = false;
    foreach($materias as $value) {
        if($materia->Equals($materia, $value)){
            $flag = true;
            break;
        }
    }
    
    return $flag;
}

function mostrarMaterias(array $materias){
    echo "Materias: <br>";
    foreach ($materias as $value) {
        echo "$value->nombre,<br>";
    }

}
?>