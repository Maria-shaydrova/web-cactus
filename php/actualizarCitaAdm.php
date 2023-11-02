<?php
    include 'conexion.php';

    // Verificar si se recibieron los datos del formulario
    if (isset($_POST['fecha']) && isset($_POST['motivo'])) {
        // Obtener los datos enviados por POST
        $idCita = $_POST['idCita'];
        $fecha = $_POST['fecha'];
        $motivo = $_POST['motivo'];
        

        // Realizar las operaciones necesarias con los datos recibidos
        $consulta = "UPDATE citas SET fecha_cita = '$fecha', motivo_cita = '$motivo' WHERE idCita = '$idCita'";
        $resultado = mysqli_query($conexion, $consulta);

        if($resultado){
            // Enviar una respuesta de éxito
            $response['exists'] = true;
        }

        echo json_encode($response);
        
        
    }
?>
