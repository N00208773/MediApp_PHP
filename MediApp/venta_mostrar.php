<?php
require_once("modelo/venta.php");
$rpta = MostrarVenta();


echo json_encode($rpta);
?>
