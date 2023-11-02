<?php
    include 'conexion.php';
    // Iniciar o reanudar la sesión
    session_start();

    // Destruir la sesión si está iniciada
    if (isset($_SESSION['sesion_iniciada'])) {
        // Limpiar todas las variables de sesión
        echo 'sesion iniciada';
        $_SESSION = array();

        // Destruir la sesión
        session_destroy();

        // Redirigir a la pagina principal
        header("Location: ../index.php");

        exit();
    } 
    else {
        echo 'No hay sesión activa.';
    }
?>
