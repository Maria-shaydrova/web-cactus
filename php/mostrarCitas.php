<?php
    include 'conexion.php';
    include 'datos_usuario.php';

    
        $idUser = $_SESSION['idUser'];
        //Consulta para obtener los datos de los usuarios  
        $consultaCitas = "SELECT * FROM `citas` WHERE idUser='$idUser' ORDER BY idCita desc";
        $resultado_consultaCitas = mysqli_query($conexion, $consultaCitas);

        if (mysqli_num_rows($resultado_consultaCitas) > 0) {
            $citas = array(); // Array para almacenar las citas

            while ($fila = mysqli_fetch_assoc($resultado_consultaCitas)) {
                $cita = array(
                    'fechaCita' => $fila['fecha_cita'],
                    'motivoCita' => $fila['motivo_cita'],
                    'idCita' => $fila['idCita']
                );
                $citas[] = $cita; // Agregar la cita al array de citas
            }
            
            echo json_encode($citas);
        }
        else{
            echo 0;
        }
        
   
?>
