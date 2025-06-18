<?php
require_once(__DIR__ . '/../conexion.php');

function RegistrarDetalleVenta($id_producto, $id_venta, $cantidad, $precio_unitario, $subtotal)
{
    $con = conectar();
    
    // 1. Validar datos numéricos
    if (!is_numeric($cantidad) || !is_numeric($precio_unitario) || !is_numeric($subtotal)) {
        return array(
            "success" => false,
            "message" => "Los campos cantidad, precio y subtotal deben ser numéricos",
            "status" => 400
        );
    }

    // 2. Verificar que exista la venta
    $sql_verificar_venta = "SELECT id_venta FROM ventas WHERE id_venta = '$id_venta'";
    $result_venta = mysqli_query($con, $sql_verificar_venta);
    
    if(mysqli_num_rows($result_venta) == 0) {
        return array(
            "success" => false,
            "message" => "La venta especificada no existe",
            "status" => 404
        );
    }

    // 3. Verificar que exista el producto
    $sql_verificar_producto = "SELECT id_producto FROM productos WHERE id_producto = '$id_producto' AND est_producto = 1";
    $result_producto = mysqli_query($con, $sql_verificar_producto);
    
    if(mysqli_num_rows($result_producto) == 0) {
        return array(
            "success" => false,
            "message" => "El producto especificado no existe o está inactivo",
            "status" => 404
        );
    }

    // 4. Registrar detalle de venta
    $sql = "INSERT INTO detalle_venta (
            id_producto,
            id_venta,
            cantidad,
            precio_unitario,
            subtotal
        ) VALUES (
            '$id_producto',
            '$id_venta',
            '$cantidad',
            '$precio_unitario',
            '$subtotal'
        )";

    $result = mysqli_query($con, $sql);
    
    if($result) {
        $id_insertado = mysqli_insert_id($con);
        
        // 5. Actualizar stock del producto
        $sql_update_stock = "UPDATE productos SET stock = stock - $cantidad WHERE id_producto = '$id_producto'";
        mysqli_query($con, $sql_update_stock);
        
        $response = array(
            "success" => true,
            "message" => "Detalle de venta registrado exitosamente",
            "id_detalle" => $id_insertado,
            "status" => 201
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al registrar detalle: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function EliminarDetalleVenta($id_detalle)
{
    $con = conectar();
    
    // Verificar si existe el detalle
    $sql_verificar = "SELECT * FROM detalle_venta WHERE id_detalle = '$id_detalle'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) == 0) {
        return array(
            "success" => false,
            "message" => "El detalle de venta no existe",
            "status" => 404
        );
    }

    // Eliminación física (DELETE)
    $sql = "DELETE FROM detalle_venta WHERE id_detalle = '$id_detalle'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true,
            "message" => "Detalle de venta eliminado permanentemente",
            "id_detalle" => $id_detalle,
            "status" => 200
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al eliminar detalle: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

// Función para obtener detalles por venta
function ObtenerDetallesPorVenta($id_venta)
{
    $con = conectar();
    
    $sql = "SELECT dv.*, p.nom_producto 
            FROM detalle_venta dv
            JOIN productos p ON dv.id_producto = p.id_producto
            WHERE dv.id_venta = '$id_venta'";
    
    $result = mysqli_query($con, $sql);
    
    $detalles = array();
    while($row = mysqli_fetch_assoc($result)) {
        $detalles[] = $row;
    }
    
    mysqli_close($con);
    return $detalles;
}
?>