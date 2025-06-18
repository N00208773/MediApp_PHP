<?php
// registrar_proveedor.php

// Recibir datos desde Android
$nombre = $_GET['nombre'];
$direccion = $_GET['direccion'];
$celular = $_GET['celular'];
$email = $_GET['email'];

// Registrar en BD
require_once("modelo/proveedor.php");
$resultado = RegistrarProveedor($nombre, $direccion, $celular, $email);

// Responder a Android
echo json_encode($resultado);
?>