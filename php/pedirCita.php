<?php
    include 'conexion.php';
    include 'datos_usuario.php';

    $fechaCita = $_POST['fecha-cita'];
    $motivoCita = $_POST['motivo-cita'];
    $idUser = $_SESSION['idUser'];

    if (isset($_SESSION['idUser']) && $idUser) {
        $query_citas  = "INSERT INTO `citas`(`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) 
                            VALUES (NULL,'$idUser','$fechaCita','$motivoCita')";
        
        $ejecutar_consulta = mysqli_query($conexion, $query_citas);

        if($ejecutar_consulta){
            // Esperar 1 segundo antes de redirigir
            sleep(1);
            // Redirigir al usuario a la página de inicio de sesión
            header('Location: ../vistas/citaciones.php');
            exit();
        }
        else{
            echo 'Error al solicitar cita';
        }

    }



?>