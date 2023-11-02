<?php
    include 'conexion.php';
    
    //Consulta para obtener los noticias
    $consulta = "SELECT * FROM noticias";
    $resultado = mysqli_query($conexion, $consulta);

    $noticias = array(); // Array para almacenar las citas
    if (mysqli_num_rows($resultado) > 0) {
        

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $noticia = array(
                'idNoticia' => $fila['idNoticia'],
                'idUser' => $fila['idUser'],
                'titulo' => $fila['titulo'],
                'imagen' => $fila['imagen'],
                'texto' => $fila['texto'],
                'fecha' => $fila['fecha'],
            );
            $noticias[] = $noticia; // Agregar la cita al array de citas
        }
    }       
    echo json_encode($noticias);
?>