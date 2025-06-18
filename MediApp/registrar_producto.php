<?php
// registrar_producto.php

// Recibir datos desde Android
$id_proveedor = $_GET['id_proveedor'];
$nombre = $_GET['nombre'];
$descripcion = $_GET['descripcion'];
$precio_venta = $_GET['precio_venta'];
$precio_compra = $_GET['precio_compra'];
$stock = $_GET['stock'];

// Registrar en BD
require_once("modelo/producto.php");
$resultado = RegistrarProducto($id_proveedor, $nombre, $descripcion, $precio_venta, $precio_compra, $stock);

// Responder a Android
echo json_encode($resultado);
?>