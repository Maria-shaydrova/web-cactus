<?php
include 'conexion.php';
include 'datos_usuario.php';

$idUser = $_SESSION['idUser'];

if (isset($_POST['titulo']) && isset($_FILES['imagen']['tmp_name']) && isset($_POST['contenido']) && isset($_POST['fecha'])) {

    $titulo = $_POST['titulo'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $contenido = $_POST['contenido'];
    $fecha = $_POST['fecha'];

    // Realizar las validaciones y verificaciones necesarias antes de guardar en la base de datos

    // Generar un nombre único para la imagen
    $nombreImagen = uniqid() . '_' . $_FILES['imagen']['name'];

    // Ruta de destino para guardar la imagens
    $rutaImagen = '../imagenes/noticias/' . $nombreImagen;

    // Mover la imagen al directorio de destino
    move_uploaded_file($imagenTmp, $rutaImagen);

    $consulta = "INSERT INTO `noticias`(`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) 
                    VALUES (NULL,'$titulo','$rutaImagen','$contenido', '$fecha', '$idUser')";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_affected_rows($conexion) > 0) {
        echo json_encode(['exists' => true]);
        header("Location: ../vistas/noticias-admin.php");
        exit();
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    echo 'Tu código es muy malo';
}
?>
