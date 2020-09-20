<?php
class Asignacion{
    public $idMateria;
    public $turno;
    public $legajoProf;

    public function __construct(int $legProf = 0, int $materia = 0, string $turno = ''){
        if(!empty($materia) && $materia > 0 && $legProf > 0){
            $this->legajoProf = $legProf;
            $this->idMateria = $materia;
            $this->turno = $turno;
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

    
    public function Equals($asign1, $asign2){
        if(($asign1->idMateria == $asign2->idMateria) && ($asign1->turno == $asign2->turno) && ($asign1->legajoProf == $asign2->legajoProf))
        {
            return true;
        } 
        return false;
    }
    

    public function __toString(){
        return json_encode($this);
        //return $this->idMateria.', '.$this->turno.', '.$this->legajoProf.PHP_EOL;
    }
}

function asignacionExists($asignacion, $asignaciones){
    $flag = false;

    foreach($asignaciones as $value) {
        if($asignacion->Equals($asignacion, $value)){
            $flag = true;
            break;
        }
    }
    
    return $flag;
}

function mostrarAsignaciones($asignaciones, $profesores, $materias){
    echo "<h3>Asignaciones:</h3> <br>";
    foreach ($profesores as $profesor) {
        echo "<b> $profesor->nombre: </b> <br>";
        foreach ($asignaciones as $asignacion) {
            foreach ($materias as $materia) {
                if($asignacion->legajoProf == $profesor->legajo && $asignacion->idMateria == $materia->id){
                    echo "$materia->nombre<br>";
                }
            }
        }
        echo "<br>";
    }
}

?>