<?php
require_once("modelo/producto.php");
$rpta = MostrarProducto();


echo json_encode($rpta);
?>
