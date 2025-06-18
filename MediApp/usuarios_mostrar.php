<?php
require_once("modelo/usuario.php");
$rpta = MostrarUsuarios();


echo json_encode($rpta);
?>
