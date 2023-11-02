<?php

    include 'conexion.php';

    if(isset($_POST['titulo']) && isset($_POST['idNoticia'])){
        $titulo = $_POST['titulo'];
        $idNoticia = $_POST['idNoticia'];

        $consulta = "SELECT * FROM noticias WHERE titulo = '$titulo' AND idNoticia != '$idNoticia'";
        $resultado = mysqli_query($conexion, $consulta);

        $response = [];
        if(mysqli_num_rows($resultado) > 0){
            $response['exists'] = true;
        }
        else{
            $response['exists'] = false;
        }
        echo json_encode($response);
    }

?>