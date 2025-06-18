<?php
function conectar() {
    $con = mysqli_connect("localhost", "root", "", "mediapp", "3307");
    if (!$con) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    mysqli_set_charset($con, "utf8");  // <<--- Aquí forzamos UTF-8
    return $con;
}

?>
