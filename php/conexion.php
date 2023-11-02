

<?php
    // $conexion = mysqli_connect("localhost:3307", "root", "", "empresa");
    $conexion = mysqli_connect("localhost", "root", "", "empresa");

    if ($conexion) {
        //echo "Conectado correctamente";
        
    } else {
        echo "Fallo de conexión";
        echo "<script>console.log('Fallo de conexión');</script>";
    }  

?>