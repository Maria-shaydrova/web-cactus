<?php
include 'conexion.php';

$respuesta = array();
$usuarioCorrecto = false;
$emailCorrecto = false;
$telefonoCorrecto = false;

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM `users_login` WHERE `usuario` = '$usuario'");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        $respuesta['exists'] = true;
    } else {
        $respuesta['exists'] = false;
        $usuarioCorrecto = true;
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificar_email = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `email` = '$email'");

    if (mysqli_num_rows($verificar_email) > 0) {
        $respuesta['exists'] = true;
    } else {
        $respuesta['exists'] = false;
        $emailCorrecto = true;
    }
}

if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
    $verificar_telefono = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `telefono` = '$telefono'");

    if (mysqli_num_rows($verificar_telefono) > 0) {
        $respuesta['exists'] = true;
    } else {
        $respuesta['exists'] = false;
        $telefonoCorrecto = true;
    }
}

$registrar = $usuarioCorrecto && $emailCorrecto && $telefonoCorrecto;

echo json_encode($respuesta);
?>
