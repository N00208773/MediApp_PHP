<?php
require_once("modelo/proveedor.php");
$rpta = MostrarProveedor();


echo json_encode($rpta);
?>
