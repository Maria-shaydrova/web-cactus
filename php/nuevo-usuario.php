<?php
    // Archivo: nuevo-usuario.php
    include 'conexion.php';
    include 'validar.php';

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    //Encriptamos la contraseña
    $contrasena = hash('sha512', $contrasena);
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nacimiento = $_POST['nacimiento'];
    $direccion = $_POST['direccion'];
    $sexo = $_POST['sexo'];


    if($registrar){
        // Insertar datos en la tabla users_data
        $query_users_data = "INSERT INTO `users_data`(`idUser`,`nombre`, `apellidos`, `email`, `telefono`, `fecha_nac`, `direccion`, `sexo`) 
        VALUES (null, '$nombre','$apellidos','$email','$telefono','$nacimiento','$direccion','$sexo')";
        $ejecutar_data = mysqli_query($conexion, $query_users_data);

        $idUser = mysqli_insert_id($conexion); 
        // Insertar datos en la tabla users_login
        $query_users_login = "INSERT INTO `users_login`(`idLogin`, `idUser`, `usuario`, `password`, `rol`) 
            VALUES (NULL, '$idUser','$usuario','$contrasena', 'user')";

        $ejecutar_login = mysqli_query($conexion, $query_users_login);


        if($ejecutar_data && $ejecutar_login){
            // Esperar 2.5 segundos antes de redirigir
            sleep(2.5);
            // Redirigir al usuario a la página de inicio de sesión
            header('Location: ../vistas/login.php');
            exit();
        }
        else{
            //echo 'Error al registrar al usuario';
        }
    }


    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
?>
