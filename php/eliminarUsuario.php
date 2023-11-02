<?php
    include 'conexion.php';

    $idUser = $_POST['idUser'];
    $respuesta = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $consulta = "DELETE FROM users_data WHERE idUser = '$idUser'";
        $resultado = mysqli_query($conexion, $consulta);

        if($resultado){
            $respuesta['exists'] = true;
            echo json_encode($respuesta);
            exit();
        }
    }

?>