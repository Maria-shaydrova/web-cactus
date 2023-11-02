<?php
    include 'conexion.php';
    //include 'datos_usuario.php';

    
        //$idUser = $_SESSION['idUser'];
        //Consulta para obtener los id de los usuarios  
        $consulta = "SELECT idUser FROM users_data";
        $resultado = mysqli_query($conexion, $consulta);

        if (mysqli_num_rows($resultado) > 0) {
            $usuarios = array(); // Array para almacenar las citas

            while ($fila = mysqli_fetch_assoc($resultado)) {
                $usuario = array(
                    'idUser' => $fila['idUser'],
                );
                $usuarios[] = $usuario; // Agregar la cita al array de citas
            }
            
            echo json_encode($usuarios);
        }       
   
?>