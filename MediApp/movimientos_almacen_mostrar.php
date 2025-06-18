<?php
require_once("modelo/almacen.php");
$rpta = MostrarAlmacen();


echo json_encode($rpta);
?>
