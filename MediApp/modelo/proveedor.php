<?php 
require_once(__DIR__ . '/../conexion.php');

function RegistrarProveedor($nombre, $direccion, $celular, $email)
{
    $con = conectar();
    
    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array(
            "success" => false,
            "message" => "El formato de email no es válido",
            "status" => 400
        );
    }

    // Registrar nuevo proveedor
    $sql = "INSERT INTO proveedores (
            nom_proveedor,
            dir_proveedor,
            cel_proveedor,
            email_proveedor,
            est_proveedor
        ) VALUES (
            '$nombre',
            '$direccion',
            '$celular',
            '$email',
            1
        )";

    $result = mysqli_query($con, $sql);
    
    if($result) {
        $id_insertado = mysqli_insert_id($con);
        $response = array(
            "success" => true,
            "message" => "Proveedor registrado exitosamente",
            "id_proveedor" => $id_insertado,
            "status" => 201
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al registrar proveedor: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function EliminarProveedor($id_proveedor)
{
    $con = conectar();
    
    // Verificar si existe el proveedor
    $sql_verificar = "SELECT * FROM proveedores WHERE id_proveedor = '$id_proveedor'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) == 0) {
        return array(
            "success" => false,
            "message" => "El proveedor no existe",
            "status" => 404
        );
    }

    // Eliminación lógica (cambiar estado a 0)
    $sql = "DELETE FROM proveedores WHERE id_proveedor = '$id_proveedor'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true,
            "message" => "Proveedor desactivado correctamente",
            "id_proveedor" => $id_proveedor,
            "status" => 200
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al desactivar proveedor: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function MostrarProveedor()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
    $sql = "SELECT * FROM proveedores";
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