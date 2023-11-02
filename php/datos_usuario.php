<?php
    include 'conexion.php';
    include 'login-usuario.php';
    //session_start();

    if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && isset($_SESSION['idUser']) ) {
        $usuario = $_SESSION['usuario'];
        $rol = $_SESSION['rol'];
        $idUser = $_SESSION['idUser'];


        // Obtener los datos personales del usuario desde la base de datos
        $consulta_datos = "SELECT ul.password, ud.nombre, ud.apellidos, ud.email, ud.telefono, ud.fecha_nac, ud.direccion, ud.sexo
                  FROM users_login ul
                  INNER JOIN users_data ud ON ul.idUser = ud.idUser
                  WHERE ul.usuario = '$usuario'";

        $resultado_datos = mysqli_query($conexion, $consulta_datos);

        if ($resultado_datos) {
            $fila = mysqli_fetch_assoc($resultado_datos);
            // $idUser = $fila['idUser'];
            $contrasena = $fila['password'];
            $nombre = $fila['nombre'];
            $apellidos = $fila['apellidos'];
            $email = $fila['email'];
            $telefono = $fila['telefono'];
            $nacimiento = $fila['fecha_nac'];
            $direccion = $fila['direccion'];
            $sexo = $fila['sexo'];
            //session_start();
        }
        else{
            
        }

        
    }
    else{
        $rol = 'visitante';
        session_destroy();
    }
?>
