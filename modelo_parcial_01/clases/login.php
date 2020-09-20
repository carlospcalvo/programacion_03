<?php

///include_once 'htdocs\vendor\firebase\JWT.php';
//use \Firebase\JWT\JWT;

function usuarioExists(Usuario $user, $usuarios){
    $flag = false;
    foreach($usuarios as $value) {
        if($user->Equals($user, $value)){
            $flag = true;
            break;
        }
    }
    
    return $flag;
}

function userLogin(Usuario $user, $usuarios){
    $flag = false;


    if(gettype($user)){

    }
    //itera el listado de usuarios
    foreach ($usuarios as $value) {
        //busca el usuario
        if($user->Equals($user, $value)){
            if(base64_decode($value->clave) == $user->clave){
                $flag = true;
                break;
            }        
        }
    }
    return $flag;
}

function verifyToken($jwt, $key, array $users){
    $flag = false;

    if(!empty($jwt) && preg_match_all("/\./",$jwt) == 2){
        $tks = explode('.', $jwt);       
        list($headb64, $bodyb64, $cryptob64) = $tks;
        $user_verify = \Firebase\JWT\JWT::jsonDecode(Firebase\JWT\JWT::urlsafeB64Decode($bodyb64));
        $user_verify = new Usuario($user_verify->email, base64_decode($user_verify->clave));
        
        if(userLogin($user_verify, $users)){
            $flag = true;
        }
    }    
    return $flag;
}

?>