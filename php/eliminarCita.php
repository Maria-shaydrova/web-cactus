<?php
    include 'conexion.php';

    // Obtener el ID de la cita enviado por JavaScript
    $idCita = $_POST['idCita'];

    $consulta = "DELETE FROM citas WHERE idCita = '$idCita'";
    $resultado = mysqli_query($conexion, $consulta);

    if(mysqli_num_rows($resultado) > 0){
        header('location: ../vistas/citaciones');
    }

?>
