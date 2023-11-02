<?php
    include 'conexion.php';

    if(isset($_POST['titulo'])){
        $titulo = $_POST['titulo'];
        $consulta = "SELECT titulo FROM noticias WHERE titulo = '$titulo'";
        $resultado = mysqli_query($conexion, $consulta);
        $respuesta = [];

        if(mysqli_num_rows($resultado) > 0){
            $respuesta['exists'] = true;
        }
        else {
            $respuesta['exists'] = false;
        }
        header('Content-Type: application/json');

        echo json_encode($respuesta);
    }
?>