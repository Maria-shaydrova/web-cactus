<?php
    session_start();
    include 'conexion.php';

    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $contraEncriptada = hash('sha512', $contrasena);

        $validar_entrada = mysqli_query($conexion, "SELECT * FROM users_login WHERE usuario = '$usuario' AND password = '$contraEncriptada'");

        if (mysqli_num_rows($validar_entrada) > 0) {
            $fila = mysqli_fetch_assoc($validar_entrada);
            $_SESSION['sesion_iniciada'] = true;
            $_SESSION['usuario'] = $fila['usuario']; // Guardar el valor de usuario en la sesión
            $_SESSION['rol'] = $fila['rol']; // Guardar el valor de rol en la sesión
            $_SESSION['idUser'] = $fila['idUser']; //Guarda el id del usuario en la sesion
            echo 1;
            exit;
        } else {
            echo 0;
            session_destroy(); // Destruir la sesión en caso de credenciales incorrectas
        }
    }
?>
