<?php 
require_once(__DIR__ . '/../conexion.php');

function RegistrarCliente($nombre, $ape_paterno, $ape_materno, $correo, $usuario, $password)
{
    $con = conectar();
    
    // Verificar si el usuario ya existe
    $sql_verificar = "SELECT * FROM cliente WHERE user_cliente = '$usuario'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) > 0) {
        return array(
            "success" => false,
            "message" => "El nombre de usuario ya está registrado",
            "status" => 400
        );
    }

    // Registrar nuevo cliente
    $sql = "INSERT INTO cliente (
            nom_cliente,
            apePa_cliente,
            apeMa_cliente,
            correo_cliente,
            user_cliente,
            pass_cliente,
            est_cliente
        ) VALUES (
            '$nombre',
            '$ape_paterno',
            '$ape_materno',
            '$correo',
            '$usuario',
            '$password',
            1
        )";

    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true,
            "message" => "Cliente registrado exitosamente",
            "status" => 201
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al registrar: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}

function EliminarCliente($id_cliente)
{
    $con = conectar();
    
    // Verificar si existe el cliente
    $sql_verificar = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) == 0) {
        return array(
            "success" => false,
            "message" => "El cliente no existe",
            "status" => 404
        );
    }

    // Eliminación física (DELETE)
    $sql = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true,
            "message" => "Cliente eliminado permanentemente",
            "deleted_id" => $id_cliente,
            "status" => 200
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Error al eliminar: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}


function RegistrarUsuario($username, $password, $nombre, $ape_paterno, $ape_materno, $email, $celular, $edad, $id_cargo)
{
    $con = conectar();
    
    // Primero verificamos si el usuario ya existe
    $sql_verificar = "SELECT * FROM usuarios WHERE user_usuario = '$username'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) > 0) {
        return array("success" => false, "message" => "El nombre de usuario ya existe");
    }
    
    // Si no existe, procedemos a registrarlo
    $fecha_actual = date('Y-m-d H:i:s');
    $estado = 1; // 1 = Activo
    
    $sql = "INSERT INTO usuarios (
            id_cargos,
            user_usuario,
            pass_usuario,
            nom_usuario,
            apePa_usuario,
            apeMa_usuario,
            email_usuario,
            cel_usuario,
            edad_usuario,
            fc_re_usuario,
            est_usuario
        ) VALUES (
            '$id_cargo',
            '$username',
            '$password',
            '$nombre',
            '$ape_paterno',
            '$ape_materno',
            '$email',
            '$celular',
            '$edad',
            '$fecha_actual',
            '$estado'
        )";
    
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array("success" => true, "message" => "Usuario registrado correctamente");
    } else {
        $response = array("success" => false, "message" => "Error al registrar usuario: " . mysqli_error($con));
    }
    
    mysqli_close($con);
    return $response;
}

function EliminarUsuario($id_usuario)
{
    $con = conectar();
    
    // Verificamos si el usuario existe
    $sql_verificar = "SELECT * FROM usuarios WHERE id_usuarios = '$id_usuario'";
    $result_verificar = mysqli_query($con, $sql_verificar);
    
    if(mysqli_num_rows($result_verificar) == 0) {
        return array(
            "success" => false, 
            "message" => "El usuario no existe",
            "status" => 404
        );
    }
    
    // Eliminación FÍSICA (borrado permanente)
    $sql = "DELETE FROM usuarios WHERE id_usuarios = '$id_usuario'";
    
    $result = mysqli_query($con, $sql);
    
    if($result) {
        $response = array(
            "success" => true, 
            "message" => "Usuario eliminado permanentemente",
            "deleted_id" => $id_usuario,
            "status" => 200
        );
    } else {
        $response = array(
            "success" => false, 
            "message" => "Error al eliminar usuario: " . mysqli_error($con),
            "status" => 500
        );
    }
    
    mysqli_close($con);
    return $response;
}
function MostrarUsuarios()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
     $sql = "SELECT u.*, c.nom_cargo 
            FROM usuarios u
            INNER JOIN cargos c ON u.id_cargos = c.id_cargos";
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
function MostrarCliente()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
    $sql = "SELECT * FROM cliente";
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









function AutenticarUsuario($username, $password)
{
    //Estableciendo la conexión a la BD
    $con = conectar();

    //consulta SQL
    $sql = "SELECT * FROM usuarios u
    INNER JOIN cargos c ON u.id_cargos=c.id_cargos
    WHERE u.user_usuario = '$username' 
    AND u.pass_usuario = '$password'
    AND u.est_usuario = 1";
    
    //Ejecución de consulta SQL
    $result = mysqli_query($con,$sql);

    $datos = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $datos[] =  $row; 
    }

    //cerrar la conexion a BD
    mysqli_close($con);

    return $datos;
}   

function CambiarPassword($username, $nueva_password)
{
    require_once("conexion.php");

    $sql = "UPDATE empleado 
            SET pass_empleado = '$nueva_password' 
            WHERE usu_empleado = '$username'";

    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    return $result;
}

function ObtenerDatosEmpleado($id_empleado)
{
    require_once("conexion.php");
    
    $sql = "SELECT * FROM empleado WHERE id_empleado = '$id_empleado'";
    $result = mysqli_query($con, $sql);
    
    $datos = array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $datos[] = $row;
    }
    
    mysqli_close($con);
    return $datos;
}

function ActualizarDatosEmpleado($id_empleado, $nom_empleado, $apat_empleado, $amat_empleado, 
                               $ndoc_empleado, $cel_empleado, $dir_empleado, $fn_empleado, $usu_empleado)
{
    require_once("conexion.php");
    
    $sql = "UPDATE empleado SET 
            nom_empleado = '$nom_empleado',
            apat_empleado = '$apat_empleado',
            amat_empleado = '$amat_empleado',
            ndoc_empleado = '$ndoc_empleado',
            cel_empleado = '$cel_empleado',
            dir_empleado = '$dir_empleado',
            fn_empleado = '$fn_empleado',
            usu_empleado = '$usu_empleado'
            WHERE id_empleado = '$id_empleado'";
            
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    
    return $result;
}



?>