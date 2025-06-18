<?php
// Recibe el ID del usuario a eliminar desde Android
$id_usuario = $_GET['id_usuario'];

// Elimina el usuario en la BD
require_once("modelo/usuario.php");
$resultado = EliminarUsuario($id_usuario);

// Responde a Android
echo json_encode($resultado);
?>