<?php
// eliminar_cliente.php

// Recibir ID desde Android
$id_cliente = $_GET['id_cliente'];

// Eliminar en BD
require_once("modelo/usuario.php");
$resultado = EliminarCliente($id_cliente);

// Responder a Android
echo json_encode($resultado);
?>