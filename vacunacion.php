
<?php
require_once('conexion.php');
require_once('cors.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, Authorization,X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Origin: *');
$method = $_SERVER['REQUEST_METHOD'];

if (isset($_POST['buscarEstudiantesVacunados']))
{
    $json=[];
    $buscarEstudiantes=$_POST['buscarEstudiantesVacunados'];
    $sentencia=$conexion->prepare("CALL covid.consultas_estudiantes_vacunados(?);");
    $sentencia->bind_param('s',$buscarEstudiantes);
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json[] = $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
    $arreglo=utf8ize($json);
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $arreglo));
    exit();
}

function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
}

if (isset($_POST['buscarEstudiantesNoVacunados']))
{
    $json=[];
    $buscarEstudiantes=$_POST['buscarEstudiantesNoVacunados'];
    $sentencia=$conexion->prepare("CALL covid.consultas_estudiantes_no_vacunados(?);");
    $sentencia->bind_param('s',$buscarEstudiantes);
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json[] = $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
    $arreglo=utf8ize($json);
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $arreglo));
    exit();
}

if (isset($_POST['buscarFuncionariosVacunados']))
{
    $json=[];
    $buscarFuncionarios=$_POST['buscarFuncionariosVacunados'];
    $sentencia=$conexion->prepare("CALL covid.consultar_funcionarios_vacunados(?);");
    $sentencia->bind_param('s',$buscarFuncionarios);
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json[] = $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
    $arreglo=utf8ize($json);
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $arreglo));
    exit();
}


if (isset($_POST['buscarFuncionariosNoVacunados']))
{
    $json=[];
    $buscarFuncionarios=$_POST['buscarFuncionariosNoVacunados'];
    $sentencia=$conexion->prepare("CALL covid.consultar_funcionarios_no_vacunados(?);");
    $sentencia->bind_param('s',$buscarFuncionarios);
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json[] = $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
    $arreglo=utf8ize($json);
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $arreglo));
    exit();
}

if (isset($_POST['porcentajeFuncionarios']))
{
    $json;
    $buscarFuncionarios=$_POST['porcentajeFuncionarios'];
    $sentencia=$conexion->prepare("CALL covid.porcentaje_funcionarios();");
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json= $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
   
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $json));
    exit();
}

if (isset($_POST['porcentajeEstudiantes']))
{
    $json;
    $buscarFuncionarios=$_POST['porcentajeEstudiantes'];
    $sentencia=$conexion->prepare("CALL covid.porcentaje_estudiantes();");
    $res=$sentencia->execute();
    if($res)
    {
        $resultado = $sentencia->get_result();
        foreach($resultado as $row)
        {
            $json= $row;
        }
    }
    $err=mysqli_error($conexion);
    $sentencia->close();
    $conexion->close();
   
    echo json_encode(array( 'respuesta' => $res,'error' =>$err,'datos' => $json));
    exit();
}


?>
