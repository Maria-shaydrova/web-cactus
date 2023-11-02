<?php
include 'conexion.php';

if (isset($_POST['idUser'])) {
    $idUser = $_POST['idUser'];

    $consultaCitas = "SELECT * FROM `citas` WHERE idUser='$idUser'";
    $resultado_consultaCitas = mysqli_query($conexion, $consultaCitas);

    if (mysqli_num_rows($resultado_consultaCitas) > 0) {
        $citas = array();
        while ($fila = mysqli_fetch_assoc($resultado_consultaCitas)) {
            $cita = array(
                'idCita' => $fila['idCita'],
                'idUser' => $fila['idUser'],
                'fechaCita' => $fila['fecha_cita'],
                'motivoCita' => $fila['motivo_cita']
            );
            $citas[] = $cita;
        }
        $response = array('exists' => true, 'citas' => $citas);
        echo json_encode($response);
    } else {
        $response = array('exists' => false, 'citas' => array());
        echo json_encode($response);
    }
    
}
?>
