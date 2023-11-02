<?php

include 'conexion.php';

if(isset($_POST['idNoticia'])) {

    $idNoticia = $_POST['idNoticia'];

    $consulta = "DELETE FROM noticias WHERE idNoticia = '$idNoticia'";
    $resultado = mysqli_query($conexion, $consulta);

    $response = [];

    if($resultado) {
        if(mysqli_affected_rows($conexion) > 0) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
    } else {
        $response['exists'] = false;
        $response['error'] = mysqli_error($conexion);
    }

    echo json_encode($response);
}


?>