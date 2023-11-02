<?php
    include 'conexion.php';

    // Verificar si se recibieron los datos del formulario
    if (isset($_POST['fechaCita']) && isset($_POST['motivoCita'])) {
        // Obtener los datos enviados por POST
        $idCita = $_POST['idCita'];
        $fechaCita = $_POST['fechaCita'];
        $motivoCita = $_POST['motivoCita'];
        $idUser = $_SESSION['idUser'];

        // Realizar las operaciones necesarias con los datos recibidos
        $consulta = "UPDATE citas SET fecha_cita = '$fechaCita', motivo_cita = '$motivoCita' WHERE idCita = '$idCita'";
        $resultado = mysqli_query($conexion, $consulta);

        if($resultado){
            // Enviar una respuesta de éxito
            echo "La cita se guardó correctamente.";
        }
        
        
    } else {
        // Enviar una respuesta de error si los datos no fueron recibidos correctamente
        echo "Error al guardar la cita. Faltan datos.";
    }
?>
