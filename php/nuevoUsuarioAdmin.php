<?php
    include 'conexion.php';

    $respuesta = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Verificar y asignar los valores de las variables
        $usuario = isset($_POST['nuevoUsuario']) ? $_POST['nuevoUsuario'] : "";
        $contrasena = isset($_POST['nuevaContrasena']) ? $_POST['nuevaContrasena'] : "";
        $contrasenaEncr = hash('sha512', $contrasena);
        $rol = isset($_POST['nuevoRol']) ? $_POST['nuevoRol'] : "";
        $nombre = isset($_POST['nuevoNombre']) ? $_POST['nuevoNombre'] : "";
        $apellidos = isset($_POST['nuevosApellidos']) ? $_POST['nuevosApellidos'] : "";
        $email = isset($_POST['nuevoEmail']) ? $_POST['nuevoEmail'] : "";
        $telefono = isset($_POST['nuevoTelefono']) ? $_POST['nuevoTelefono'] : "";
        $fecha = isset($_POST['nuevoNacimiento']) ? $_POST['nuevoNacimiento'] : "";
        $direccion = isset($_POST['nuevaDireccion']) ? $_POST['nuevaDireccion'] : "";
        $sexo = isset($_POST['nuevoSexo']) ? $_POST['nuevoSexo'] : "";

        $consulta_data = "INSERT INTO `users_data`(`idUser`,`nombre`, `apellidos`, `email`, `telefono`, `fecha_nac`, `direccion`, `sexo`) 
                            VALUES (null, '$nombre','$apellidos','$email','$telefono','$fecha','$direccion','$sexo')";
        $resultado_data = mysqli_query($conexion, $consulta_data);

        $idUser = mysqli_insert_id($conexion); 
        // Insertar datos en la tabla users_login
        $consulta_login = "INSERT INTO `users_login`(`idLogin`, `idUser`, `usuario`, `password`, `rol`) 
                            VALUES (NULL, '$idUser','$usuario','$contrasenaEncr', '$rol')";

        $resultado_login = mysqli_query($conexion, $consulta_login);
        
        if($resultado_data && $resultado_login){
            // Esperar 2.5 segundos antes de redirigir
            sleep(2.5);
            // Redirigir al usuario a la página de inicio de sesión
            header('Location: ../vistas/usuarios-admin.php');
            exit();
        }
        else{
            //echo 'Error al registrar al usuario';
        }
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    
?>