<?php
    include 'conexion.php';

    // Obtener el ID de la cita enviado por JavaScript
    $idCita = $_POST['idCita'];
    $respuesta = array();

    $consulta = "DELETE FROM citas WHERE idCita = '$idCita'";
    $resultado = mysqli_query($conexion, $consulta);

    if(mysqli_affected_rows($conexion) > 0){
        $respuesta['exists'] = true;
    }
    else{
        $respuesta['exists'] = false;
    }

    echo json_encode($respuesta);
?>
