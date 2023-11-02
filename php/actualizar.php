<?php
    include 'datos_usuario.php';
    include 'conexion.php';
    //include '../vistas/perfil.php';
    include 'validar-actualizacion.php';
    if($actualizar){
        // Procesar los cambios si se envió el formulario de modificación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los campos del formulario
            $nuevaContrasena = $_POST['contrasena'];
            $nuevaContrasenaEncr = hash('sha512', $nuevaContrasena);
            $nuevoNombre = $_POST['nombre'];
            $nuevosApellidos = $_POST['apellidos'];
            $nuevoEmail = $_POST['email'];
            $nuevoTelefono = $_POST['telefono'];
            $nuevoNacimiento = $_POST['nacimiento'];
            $nuevaDireccion = $_POST['direccion'];
            $nuevoSexo = $_POST['sexo'];

            // Actualizar los datos en la base de datos
            $consulta_datos = "UPDATE users_data SET nombre = '$nuevoNombre',
                                    apellidos = '$nuevosApellidos', 
                                    email = '$nuevoEmail', 
                                    telefono = '$nuevoTelefono',
                                    fecha_nac = '$nuevoNacimiento',
                                    direccion = '$nuevaDireccion',
                                    sexo = '$nuevoSexo'
                            WHERE idUser = (SELECT idUser FROM users_login WHERE usuario = '$usuario')";

            //Consulta para la contraseña, para ver si es la misma o si ha cambiado
            $consulta_contrasena = "SELECT password FROM users_login WHERE usuario = '$usuario'";
            $resultado_contrasena = mysqli_query($conexion, $consulta_contrasena);

            if($resultado_contrasena){
                $fila_contrasena = mysqli_fetch_assoc($resultado_contrasena);
                $contrasenaActual = $fila_contrasena['password'];
                if($nuevaContrasena !== $contrasenaActual){
                    $consulta_login = "UPDATE users_login SET password = '$nuevaContrasenaEncr', rol = '$rol' WHERE usuario = '$usuario'";
                }
                else{
                    $consulta_login = "UPDATE users_login SET rol = '$rol' WHERE usuario = '$usuario'";
                }
            }

            $resultado_datos = mysqli_query($conexion, $consulta_datos);
            $resultado_login = mysqli_query($conexion, $consulta_login);

            if ($resultado_datos && $resultado_login) {
                // Redirigir a la página de perfil para refrescar los datos mostrados
                sleep(0.9);
                header('Location: ../vistas/perfil.php');
                //echo 'Los datos deben actualizarse';
                exit();
            }
        } 
        // elseif (isset($_GET['editar'])) {
        //     // Habilitar la edición si se recibe el parámetro "editar" en la URL
        //     $edicionHabilitada = true;
        // }

    }

?>