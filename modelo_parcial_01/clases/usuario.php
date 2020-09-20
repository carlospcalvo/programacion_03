<?php

include_once __DIR__.'\Files.php';

class Usuario extends Files{
    public $email;
    public $clave;

    public function __construct(string $mail = '', string $pass = '')
    {
        if(!(empty($mail) && empty($pass)) && filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $this->email = $mail;
            $this->clave = base64_encode($pass);
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

    public function Equals($user1, $user2){
        if($user1->email == $user2->email)
        {
            return true;
        } 
        return false;
    }

    public function __toString(){
        return json_encode($this);
        //return $this->email.', '.$this->clave.PHP_EOL; //SACAR CLAVE, ES SOLO PARA TEST
    }
    /*
    public static function saveJson($archivo, $array){
        return parent::saveJson($archivo, $array);
    }

    public static function readJson($archivo){
        return parent::readJson($archivo);
    }
*/

    //////////////////////////////////////

    


}









?>