<?php
// registrar_detalle_venta.php

// Recibir datos desde Android
$id_producto = $_GET['id_producto'];
$id_venta = $_GET['id_venta'];
$cantidad = $_GET['cantidad'];
$precio_unitario = $_GET['precio_unitario'];
$subtotal = $_GET['subtotal'];

// Registrar en BD
require_once("modelo/detalle_venta.php");
$resultado = RegistrarDetalleVenta($id_producto, $id_venta, $cantidad, $precio_unitario, $subtotal);

// Responder a Android
echo json_encode($resultado);
?>