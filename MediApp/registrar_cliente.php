<?php
// registrar_cliente.php

// Recibir datos desde Android
$nombre = $_GET['nombre'];
$ape_paterno = $_GET['ape_paterno'];
$ape_materno = $_GET['ape_materno'];
$correo = $_GET['correo'];
$usuario = $_GET['usuario'];
$password = $_GET['password'];

// Registrar en BD
require_once("modelo/usuario.php");
$resultado = RegistrarCliente($nombre, $ape_paterno, $ape_materno, $correo, $usuario, $password);

// Responder a Android
echo json_encode($resultado);
?>