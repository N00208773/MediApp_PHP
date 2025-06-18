<?php
require_once(__DIR__ . '/../conexion.php');

function RegistrarProducto($id_proveedor, $nombre, $descripcion, $precio_venta, $precio_compra, $stock)
{
    $con = conectar();
    
    // Validar datos numéricos
    if (!is_numeric($precio_venta) || !is_numeric($precio_compra)) {
        return array(
            "success" => false,
            "message" => "Los precios deben ser valores numéricos",
            "status" => 400
        );
    }

    // Registrar nuevo producto
    $sql = "INSERT INTO productos (
            id_proveedor,
            nom_producto,
            desc_producto,
            precio_venta,
            precio_compra,
            stock,
            est_producto
        ) VALUES (
            '$id_proveedor',
            '$nombre',
            '$descripcion',
            '$precio_venta',
            '$precio_compra',
            '$stock',
            1
        )";

    $result = mysqli_query($con, $sql);
    
    if($result) {
        $id_insertado = mysqli_insert_id($con);
        $response = array(
            "success" => true,
            "message" => "Producto registrado exitosamente",
            "id_producto" => $id_insertado,
            "status" => 201
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al registrar producto: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function EliminarProducto($id_producto)
{
    $con = conectar();
    
    // Verificar si existe el producto
    $sql_verificar = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) == 0) {
        return array(
            "success" => false,
            "message" => "El producto no existe",
            "status" => 404
        );
    }

    // Eliminación lógica (cambiar estado a 0)
    $sql = "DELETE FROM productos WHERE id_producto = '$id_producto'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true,
            "message" => "Producto Eliminado correctamente",
            "id_producto" => $id_producto,
            "status" => 200
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al desactivar producto: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function MostrarProducto()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
    $sql = "SELECT * FROM productos";
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