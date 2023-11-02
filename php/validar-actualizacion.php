<?php
include 'conexion.php';
//include '../vistas/pefil.php';
include 'datos_usuario.php';

$respuesta = array();
$usuarioCorrecto = false;
$emailCorrecto = false;
$telefonoCorrecto = false;

//$usuario = $_SESSION['usuario'];
$idUser = $_SESSION['idUser'];


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificar_email = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `email` = '$email' AND `idUser` != '$idUser'");

    if (mysqli_num_rows($verificar_email) > 0) {
        $respuesta['exists'] = true;
    } else {
        $respuesta['exists'] = false;
        $emailCorrecto = true;
    }
}

if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
    $verificar_telefono = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `telefono` = '$telefono' AND `idUser` != '$idUser'");

    if (mysqli_num_rows($verificar_telefono) > 0) {
        $respuesta['exists'] = true;
    } else {
        $respuesta['exists'] = false;
        $telefonoCorrecto = true;
    }
}

$actualizar = $emailCorrecto && $telefonoCorrecto;


echo json_encode($respuesta);


?>
