<?php
// Recibe datos desde Android
$username = $_GET['username'];
$password = $_GET['password'];
$nombre = $_GET['nombre'];
$ape_paterno = $_GET['ape_paterno'];
$ape_materno = $_GET['ape_materno'];
$email = $_GET['email'];
$celular = $_GET['celular'];
$edad = $_GET['edad'];
$id_cargo = $_GET['id_cargo'];

// Registra datos en la BD
require_once("modelo/usuario.php");
$resultado = RegistrarUsuario($username, $password, $nombre, $ape_paterno, $ape_materno, $email, $celular, $edad, $id_cargo);

// Responde a Android
echo json_encode($resultado);
?>