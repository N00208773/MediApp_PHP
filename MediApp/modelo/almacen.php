<?php 
require_once(__DIR__ . '/../conexion.php');

function MostrarAlmacen()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
    $sql = "SELECT * FROM movimientos_almacen";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    $datos = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datos[] = $row;
    }

    mysqli_close($con);

    return $datos;
}



?>