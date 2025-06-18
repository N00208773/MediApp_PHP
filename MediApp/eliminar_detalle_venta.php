<?php
// eliminar_detalle_venta.php

// Recibir ID desde Android
$id_detalle = $_GET['id_detalle'];

// Eliminar en BD
require_once("modelo/detalle_venta.php");
$resultado = EliminarDetalleVenta($id_detalle);

// Responder a Android
echo json_encode($resultado);
?>