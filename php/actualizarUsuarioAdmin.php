<?php

    include 'conexion.php';

    $idUser = $_POST['idUser'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $ContrasenaEncr = hash('sha512', $contrasena);
    $rol = $_POST['rol'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];

    $respuesta = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $consulta_data = "UPDATE users_data 
                        SET nombre = '$nombre', apellidos = '$apellidos', email = '$email', telefono = '$telefono', 
                            fecha_nac = '$fecha', direccion = '$direccion', sexo = '$sexo'
                        WHERE idUser = '$idUser'";

        //Consulta para la contraseña, para ver si es la misma o si ha cambiado
        $consulta_contrasena = "SELECT password FROM users_login WHERE idUser = '$idUser'";
        $resultado_contrasena = mysqli_query($conexion, $consulta_contrasena);

        if($resultado_contrasena){
            $fila_contrasena = mysqli_fetch_assoc($resultado_contrasena);
            $contrasenaActual = $fila_contrasena['password'];
            if($contrasena !== $contrasenaActual){
                $consulta_login = "UPDATE users_login SET usuario = '$usuario', password = '$ContrasenaEncr', rol = '$rol' WHERE idUser = '$idUser'";
            }
            else{
                $consulta_login = "UPDATE users_login SET usuario = '$usuario', rol = '$rol' WHERE idUser = '$idUser'";
            }
        }

        $resultado_consulta_datos = mysqli_query($conexion, $consulta_data);
        $reusltado_consulta_login = mysqli_query($conexion, $consulta_login);

        if ($resultado_consulta_datos && $reusltado_consulta_login) {
            $respuesta['exists'] = true;
            echo json_encode($respuesta);
            exit();
        }
    }

?>