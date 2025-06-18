<?php 
//recibe datos desde Android
$username = $_GET['username'];
$password = $_GET['password'];

//Registra datos en la BD
require_once("modelo/usuario.php");
$rpta = AutenticarUsuario($username, $password);


if (count($rpta) > 0) {
    $rpta = json_encode($rpta);
} else {
    //array vacio
    $rpta = array();
    $rpta = json_encode($rpta);
}

//Responde a Android
echo $rpta;
?>