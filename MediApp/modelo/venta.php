<?php 
require_once(__DIR__ . '/../conexion.php');

function MostrarVenta()
{
    // Obtenemos la conexión
    $con = conectar();

    // Ahora $con es una conexión válida
    $sql = "SELECT * FROM ventas";
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
    $sql = "SELECT * FROM usuarios 
    WHERE user_usuario = '$username' 
    AND pass_usuario = '$password'
    AND est_usuario = 1";
    
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