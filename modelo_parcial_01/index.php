<?php

include_once __DIR__.'\clases\usuario.php';
include_once __DIR__.'\clases\materia.php';
include_once __DIR__.'\clases\profesor.php';
include_once __DIR__.'\clases\asignacion.php';
include_once __DIR__.'\clases\login.php';
include_once __DIR__.'\clases\Files.php';

include_once __DIR__.'\vendor\firebase\php-jwt\src\JWK.php';
include_once __DIR__ . '\vendor\autoload.php';


use Firebase\JWT\JWT;


$usuarios = Files::readJson("usuarios.json"); //array();
$materias = Files::readJson("materias.json");
$profesores = Files::readJson("profesores.json");
$asignaciones = Files::readJson("materias-profesores.json");
$key = base64_encode("todorojo");


$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? 'no_path';


switch ($path) {
    case '/usuario':        
        if ($method == 'POST') {
            if(!(empty($_POST['email']) && empty($_POST['pass'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $user = new Usuario(
                    $_POST['email'] ?? '', 
                    base64_encode($_POST['pass']) ?? ''
                );

                if(usuarioExists($user, $usuarios)){
                    echo "El usuario ya existe. <br>";
                }else{
                    array_push($usuarios, $user);
                    if(Files::saveJson('usuarios.json', $usuarios)){
                        echo "Usuario guardado correctamente";
                    }       
                }
            } else {
                echo 'Email o contraseña inválida.';
            }
            
        } else {
            echo "Metodo no permitido";
        }
    break;
    case '/login':
        if ($method == 'POST') {
            if(!(empty($_POST['email']) && empty($_POST['pass'])) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $user = new Usuario(
                    $_POST['email'] ?? '',
                    $_POST['pass'] ?? ''
                );
                
                $usuarios = Files::readJson('usuarios.json');

                echo 'LOGIN: <br>';
                if(userLogin($user, $usuarios)){
                    echo 'Login exitoso';
                    $jwt = JWT::encode($user, $key);
                    echo "<br> JWT: $jwt";
                } else {
                    echo 'No se pudo conectar';
                }


            } else {
                echo 'Email o contraseña inválida.';
            }
               
        } else {
            echo "Metodo no permitido";
        }
    break;
    case '/materia':        
        if ($method == 'POST') {
            if(!(empty($_POST['nombre']) && empty($_POST['cuatrimestre'])) && $_POST['cuatrimestre'] <= 4 && verifyToken($_POST['token'], $key, $usuarios)){
                $materia = new Materia(
                    $_POST['nombre'] ?? '', 
                    $_POST['cuatrimestre'] ?? ''
                );

                if(materiaExists($materia, $materias)){
                    echo "La materia ya existe. <br>";
                }else{
                    array_push($materias, $materia);
                    if(Files::saveJson('materias.json', $materias)){
                        echo "Materia guardada correctamente";
                    }       
                }
            } else {
                echo 'Nombre de la materia o cuatrimestre inválidos. / TOKEN INVALIDO.';
            }
            
        } else if($method == 'GET'){
            if(verifyToken($_GET['token'], $key, $usuarios)){
                mostrarMaterias($materias);
            } else {
                echo "Token invalido.";
            }
        } else {
            echo "Metodo no permitido";
        }
    break;
    case '/profesor':        
        if ($method == 'POST') {
            if(!(empty($_POST['nombre']) && empty($_POST['legajo'])) && $_POST['legajo'] > 0 && verifyToken($_POST['token'], $key, $usuarios)){
                $profesor = new Profesor(
                    $_POST['nombre'] ?? '', 
                    $_POST['legajo'] ?? ''
                );

                if(profesorExists($profesor, $profesores)){
                    echo "El profesor ya existe / Legajo ya existente. <br>";
                }else{
                    array_push($profesores, $profesor);
                    if(Files::saveJson('profesores.json', $profesores)){
                        echo "Profesor guardado correctamente";
                    }       
                }
            } else {
                echo 'Nombre del profesor o legajo inválidos. / TOKEN INVALIDO.';
            }
            
        } else if($method == 'GET'){
            if(verifyToken($_GET['token'], $key, $usuarios)){
                mostrarProfesores($profesores);
            } else {
                echo "Token invalido.";
            }
        }
        else {
            echo "Metodo no permitido";
        }
    break;
    case '/asignacion':        
        if ($method == 'POST') {
            if(!(empty($_POST['legajo']) && empty($_POST['idMateria']) && empty($_POST['turno'])) && $_POST['legajo'] > 0 && verifyToken($_POST['token'], $key, $usuarios)){
                $asignacion = new Asignacion(
                    $_POST['legajo'] ?? 0,
                    $_POST['idMateria'] ?? 0,                    
                    $_POST['turno'] ?? ''
                );

                if(asignacionExists($asignacion, $asignaciones)){
                    echo "Asignacion ya existente. <br>";
                }else{
                    array_push($asignaciones, $asignacion);
                    if(Files::saveJson('materias-profesores.json', $asignaciones)){
                        echo "Asignacion guardada correctamente";
                    }       
                }
            } else {
                echo 'Nombre del profesor o legajo inválidos. / TOKEN INVALIDO.';
            }
            
        } else if($method == 'GET'){
            if(verifyToken($_GET['token'], $key, $usuarios)){
                mostrarAsignaciones($asignaciones, $profesores, $materias);
            } else {
                echo "Token invalido.";
            }
        } else {
            echo "Metodo no permitido";
        }
    break;
    default:
        echo 'Path erroneo';        
}

die();

?>