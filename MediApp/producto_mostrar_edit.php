<?php
require_once("conexion.php");

$con = conectar();

// Consulta que une productos con proveedores
$sql = "SELECT p.*, pr.nom_proveedor 
        FROM productos p
        INNER JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
        WHERE p.est_producto = 1";

$result = mysqli_query($con, $sql);

$productos = array();
while($row = mysqli_fetch_assoc($result)) {
    $productos[] = $row;
}

mysqli_close($con);

// Devolver datos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);
?>