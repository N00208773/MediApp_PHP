<?php
// eliminar_proveedor.php

// Recibir ID desde Android
$id_proveedor = $_GET['id_proveedor'];

// Eliminar en BD
require_once("modelo/proveedor.php");
$resultado = EliminarProveedor($id_proveedor);

// Responder a Android
echo json_encode($resultado);
?>