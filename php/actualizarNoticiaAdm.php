<?php
    include 'conexion.php';

    if(isset($_POST['idNoticia']) && isset($_POST['titulo']) && isset($_POST['imagenAntigua']) && isset($_POST['texto']) && isset($_POST['fecha'])){
        $idNoticia = $_POST['idNoticia'];
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];
        $fecha = $_POST['fecha'];

        // Verificar si se ha seleccionado una nueva imagen
        if(isset($_FILES['imagenNueva']['tmp_name']) ){
            $imagenTmp = $_FILES['imagenNueva']['tmp_name'];

            // Ruta de destino para guardar la imagen
            $rutaImagen = '../imagenes/noticias/';

            // Obtener el nombre del archivo original
            $nombreImagen = $_FILES['imagenNueva']['name'];

            // Generar un nombre único para la imagen
            $nombreArchivo = uniqid('imagen_') . '_' . $nombreImagen;

            // Ruta completa de la imagen para almacenar en la base de datos
            $imagen = $rutaImagen . $nombreArchivo;

            // Mover la imagen al directorio de destino
            move_uploaded_file($imagenTmp, $imagen);
        } 
        else {
            // Mantener la imagen existente si no se selecciona una nueva
            $consultaImagen = "SELECT imagen FROM noticias WHERE idNoticia = '$idNoticia'";
            $resultadoImagen = mysqli_query($conexion, $consultaImagen);
            $filaImagen = mysqli_fetch_assoc($resultadoImagen);
            $imagen = $filaImagen['imagen'];
        }

        $consulta = "UPDATE noticias SET titulo = '$titulo', imagen = '$imagen', texto = '$texto', fecha = '$fecha' WHERE idNoticia = '$idNoticia'";
        $resultado = mysqli_query($conexion, $consulta);

        $response = array('exists' => false);

        if(mysqli_errno($conexion) === 0){
            $response['exists'] = true;
        } else {
            // Manejo de errores en la base de datos
            $response['error'] = mysqli_error($conexion);
        }
        

        echo json_encode($response);
    }
?>
