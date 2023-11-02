<?php
    include 'conexion.php';
    //include 'datos_usuario.php';

    if (isset($_POST['fecha']) && isset($_POST['motivo'])) {

        $idUser = $_POST['idUser'];
        $fecha = $_POST['fecha'];
        $motivo = $_POST['motivo'];

        $query_citas  = "INSERT INTO `citas`(`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) 
                            VALUES (NULL,'$idUser','$fecha','$motivo')";
        
        $ejecutar_consulta = mysqli_query($conexion, $query_citas);

        if($ejecutar_consulta){
            
            $response['exists'] = true;

        }
        echo json_encode($response);
    }
?>