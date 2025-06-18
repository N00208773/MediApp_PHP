<?php
require_once("modelo/usuario.php");
$rpta = MostrarCliente();


echo json_encode($rpta);
?>
