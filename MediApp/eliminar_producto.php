<?php
// eliminar_detalle_venta.php

// Recibir ID desde Android
$id_producto = $_GET['id_producto'];

// Eliminar en BD
require_once("modelo/producto.php");
$resultado = EliminarProducto($id_producto);

// Responder a Android
echo json_encode($resultado);
?>
