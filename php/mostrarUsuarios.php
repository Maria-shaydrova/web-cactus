<?php
    include 'conexion.php';
    include 'datos_usuario.php';

    
        $idUser = $_SESSION['idUser'];
        //Consulta para obtener los datos de los usuarios  
        $consulta = "SELECT ul.idUser, ul.usuario, ul.password, ul.rol, ud.nombre, ud.apellidos, ud.email, ud.telefono, ud.fecha_nac, ud.direccion, ud.sexo
                            FROM users_data ud
                            INNER JOIN users_login ul ON ud.idUser = ul.idUser";
        $resultado = mysqli_query($conexion, $consulta);


        if (mysqli_num_rows($resultado) > 0) {
            $usuarios = array(); // Array para almacenar las citas

            while ($fila = mysqli_fetch_assoc($resultado)) {
                $usuario = array(
                    'idUser' => $fila['idUser'],
                    'usuario' => $fila['usuario'],
                    'password' => $fila['password'],
                    'rol' => $fila['rol'],
                    'nombre' => $fila['nombre'],
                    'apellidos' => $fila['apellidos'],
                    'email' => $fila['email'],
                    'telefono' => $fila['telefono'],
                    'fecha_nac' => $fila['fecha_nac'],
                    'direccion' => $fila['direccion'],
                    'sexo' => $fila['sexo']
                );
                $usuarios[] = $usuario; // Agregar la cita al array de citas
            }
            
            echo json_encode($usuarios);
        }       
   
?>