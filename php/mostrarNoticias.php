<?php

include 'conexion.php';

$consulta = "SELECT * FROM noticias";
$resultado = mysqli_query($conexion, $consulta);

$noticias = array();

if (mysqli_num_rows($resultado) > 0) {

    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $noticia = array(
            'idNoticia' => $fila['idNoticia'],
            'idUser' => $fila['idUser'],
            'titulo' => $fila['titulo'],
            'texto' => $fila['texto'],
            'fecha' => $fila['fecha'],
        );

        $consultaNombre = "SELECT nombre, apellidos FROM users_data WHERE idUser = '{$fila['idUser']}'";
        $resultadoNombre = mysqli_query($conexion, $consultaNombre);

        if(mysqli_num_rows($resultadoNombre) > 0){
            $filaNombre = mysqli_fetch_assoc($resultadoNombre);
            $noticia['nombre'] = $filaNombre['nombre'];
            $noticia['apellidos'] = $filaNombre['apellidos'];
        }

        // Obtener la ruta de la imagen de la fila
        $imagenSrc = $fila['imagen'];

        // Agregar la ruta de la imagen a los datos de la noticia
        $noticia['imagenSrc'] = $imagenSrc;

        $noticias[] = $noticia;
    }
}

echo json_encode($noticias);
?>
