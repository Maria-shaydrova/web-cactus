<?php
include 'conexion.php';

$respuesta = array();
$usuarioCorrecto = true;
$emailCorrecto = true;
$telefonoCorrecto = true;

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM `users_login` WHERE `usuario` = '$usuario'");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        $respuesta['usuario'] = array('mensaje' => 'El usuario ya existe');
        $usuarioCorrecto = false;
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificar_email = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `email` = '$email'");

    if (mysqli_num_rows($verificar_email) > 0) {
        $respuesta['email'] = array('mensaje' => 'El email ya existe');
        $emailCorrecto = false;
    }
}

if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
    $verificar_telefono = mysqli_query($conexion, "SELECT * FROM `users_data` WHERE `telefono` = '$telefono'");

    if (mysqli_num_rows($verificar_telefono) > 0) {
        $respuesta['telefono'] = array('mensaje' => 'El teléfono ya existe');
        $telefonoCorrecto = false;
    }
}

if (!$usuarioCorrecto || !$emailCorrecto || !$telefonoCorrecto) {
    $respuesta['exists'] = true;
} else {
    $respuesta['exists'] = false;
}

echo json_encode($respuesta);

?>
