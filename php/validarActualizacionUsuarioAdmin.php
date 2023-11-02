<?php

include 'conexion.php';

$respuesta = array();
$usuarioCorrecto = false;
$emailCorrecto = false;
$telefonoCorrecto = false;

$idUser = $_POST['idUser'];

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM `users_login` WHERE `usuario` = '$usuario' AND `idUser` != '$idUser'");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        $respuesta['usuario'] = true;
        $respuesta['mensaje'] = 'El usuario ya existe';
    } else {
        $respuesta['usuario'] = false;
        $usuarioCorrecto = true;
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificar_email = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `email` = '$email' AND `idUser` != '$idUser'");

    if (mysqli_num_rows($verificar_email) > 0) {
        $respuesta['email'] = true;
        $respuesta['mensaje'] = 'El email ya existe';
    } else {
        $respuesta['email'] = false;
        $emailCorrecto = true;
    }
}

if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
    $verificar_telefono = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `telefono` = '$telefono' AND `idUser` != '$idUser'");

    if (mysqli_num_rows($verificar_telefono) > 0) {
        $respuesta['telefono'] = true;
        $respuesta['mensaje'] = 'El teléfono ya existe';
    } else {
        $respuesta['telefono'] = false;
        $telefonoCorrecto = true;
    }
}

if (!$usuarioCorrecto || !$emailCorrecto || !$telefonoCorrecto) {
    $respuesta['exists'] = true;
} else {
    $respuesta['exists'] = false;
    
}

echo json_encode($respuesta);


?>