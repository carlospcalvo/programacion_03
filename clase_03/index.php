<?php
/******************************************************************************

Welcome to GDB Online.
GDB online is an online compiler and debugger tool for C, C++, Python, Java, PHP, Ruby, Perl,
C#, VB, Swift, Pascal, Fortran, Haskell, Objective-C, Assembly, HTML, CSS, JS, SQLite, Prolog.
Code, Compile, Run and Debug online from anywhere in world.

*******************************************************************************/

include_once(__DIR__.'\clases\Auto.php');

/**
 * METODOS
 * GET: OBTENER RECURSOS.
 * POST: CREAR RECURSOS.
 * PUT: MODIFICAR RECURSOS.
 * DELETE: BORRAR RECURSOS.
 */

// var_dump($_SERVER);
 
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 0;

switch ($path) {
    case '/auto':
        if ($method == 'POST') {
            $patente = $_POST['patente'] ?? '';
            $marca = $_POST['marca'] ?? '';
            $color = $_POST['color'] ?? '';
            $precio = $_POST['precio'] ?? 0;

            $auto = new Auto($patente, $marca, $color, $precio);

            //$auto->save();

            // $auto->_marca = 'Fiat';
            echo "<br>";
            echo $auto;
        } else if ($method == 'GET') {
            $patente = $_GET['patente'] ?? '';
            $marca = $_GET['marca'] ?? '';
            $color = $_GET['color'] ?? '';
            $precio = $_GET['precio'] ?? 0;

            $auto = new Auto($patente, $marca, $color, $precio);

            // $auto->_marca = 'Fiat';
            echo "<br>";
            echo $auto;
        } else {
            echo "Metodo no permitido";
        }
    break;
    case 'user':
    break;

    default:
        echo 'Path erroneo';
        
}


die();

echo $method . "<br>" . $path . "<br>";

var_dump($_POST);
$patente = $_POST['patente'] ?? '';
$marca = $_POST['marca'] ?? '';
$color = $_POST['color'] ?? '';
$precio = $_POST['precio'] ?? 0;

$auto = new Auto($patente, $marca, $color, $precio);

// $auto->_marca = 'Fiat';
echo "<br>";
echo $auto;


die();

var_dump($_GET);

$patente = $_GET['patente'] ?? '';
$marca = $_GET['marca'] ?? '';
$color = $_GET['color'] ?? '';
$precio = $_GET['precio'] ?? 0;

// if (isset($_GET['precio'])) {
//     $precio = $_GET['precio'];
// } else {
//     $precio = 0;
// }

$auto = new Auto($patente, $marca, $color, $precio);

// $auto->_marca = 'Fiat';
echo "<br>";
echo $auto;
