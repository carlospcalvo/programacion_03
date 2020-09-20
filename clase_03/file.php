<?php
include_once __DIR__.'\clases\Auto.php';

$auto = new Auto('ABC 333', 'Ford', 'Azul', 80000);
$file = 'archivo.json';
$modo = 'r';

// copy($file, 'nuevo_archivo.txt');
// unlink('nuevo_archivo.txt');

$listaDeAutos = array();
$archivo = fopen($file, $modo);
$fread = fread($archivo, filesize($file));
var_dump($fread);
$arrayJson = json_decode($fread);

$close = fclose($archivo);

$modo = 'w';
$archivo = fopen($file, $modo);
array_push($arrayJson, $auto);
var_dump($arrayJson);
$fwrite = fwrite($archivo, json_encode($arrayJson));
$close = fclose($archivo);
die();

####### EN EL PARCIAL PUEDEN PEDIR 3 METODOS DE ESCRITURA DE ARCHIVOS
####### SERIALIZADO - JSON ENCODED - ESCRITURA LINEA POR LINEA (TXT)


// $size = filesize($file);

// $fwrite = fwrite($archivo, $auto . PHP_EOL);

// echo "fwrite $fwrite <br>";
// $fread = fread($archivo, $size); // Todo el archivo
// echo $fread;
while (!feof($archivo)) {
    $linea = fgets($archivo);

    $datos = json_decode($linea);

    /*
    $datos = explode('*', $linea);
    
    if (count($datos) > 3) {
        $nuevoAuto = new Auto($datos[0], $datos[1], $datos[2], $datos[3]);
        array_push($listaDeAutos, $nuevoAuto);
    }
    */
    // echo $linea;
}

$close = fclose($archivo);

// var_dump($listaDeAutos);

foreach ($listaDeAutos as $value) {
    # code...

    echo $value->_patente;
}
