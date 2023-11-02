<?php
    
    include '../php/conexion.php';
    $edicionHabilitada = false;
    include '../php/datos_usuario.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
</head>
<body>
    <header class="encabezado">
        <div id="logo">
            <a href="../index.php" class="enlaceInicio">MUNDOCACTUS <img src="../imagenes/seedling-solid.svg" alt="icono" /></a>
        </div>
        <nav class="menu">
            <ul class="lista">
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../vistas/noticias.php">Noticias</a></li>
                <?php
                    if ($rol == 'user'){
                        echo '<li><a href="../vistas/citaciones.php">Citaciones</a></li>';
                        echo '<li><a class="activo" href="perfil.php">Perfil</a></li>';
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                    if ($rol == 'admin'){
                        echo '<li><a class="activo" href="vistas/perfil.php">Perfil</a></li>';
                        echo '<li><a href="usuarios-admin.php">Usuarios-admin</a></li>';
                        echo '<li><a href="citaciones-admin.php">Citaciones-admin</a></li>';
                        echo '<li><a href="noticias-admin.php">Noticias-admin</a></li>';                       
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <section id="perfil">
        <!-- Mostrar los datos personales del usuario -->
        <h2>Datos del usuario <?php echo $usuario; ?></h2>
        
            <form id="formularioPerfil" method="post" action="../php/actualizar.php">
                <div class="elemento-formulario merged">
                    <p id="mensajeErrorForm" style="padding-bottom: 3%"></span></p>
                </div>
                <div class="elemento-formulario">
                    <label>Contraseña</label>
                    <input class="entrada" type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorContrasena"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Nombre</label>
                    <input class="entrada" type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorNombre"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Apellidos</label>
                    <input class="entrada" type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorApellidos"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Email</label>
                    <input  class="entrada" type="text" id="email" name="email" value="<?php echo $email; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorEmail"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Telefono</label>
                    <input class="entrada" type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorTelefono"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Fecha de nacimiento</label>
                    <input class="entrada" type="date" id="nacimiento" name="nacimiento" value="<?php echo $nacimiento; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm" id="errorNacimiento" ></p>
                </div>
                <div class="elemento-formulario">
                    <label>Dirección</label>
                    <input class="entrada" type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                    <p class="errorForm"></p>
                </div>
                <div class="elemento-formulario">
                    <label>Sexo</label>
                    <select class="entrada" id="sexo" name="sexo" value="<?php echo $sexo; ?>" <?php echo $edicionHabilitada ? '' : 'disabled'; ?>>
                        <option class="entrada" value="opcion"></option>
                        <option class="entrada" value="hombre" <?php echo ($sexo === 'Hombre') ? 'selected' : ''; ?>>Hombre</option>
                        <option class="entrada" value="mujer" <?php echo ($sexo === 'Mujer') ? 'selected' : ''; ?>>Mujer</option>
                    </select>   
                    <p class="errorForm"></p>  
                </div>
                <div class="elemento-formulario merged">
                    <p></p>
                </div>
                <div class="elemento-formulario merged">
                    <button type="button" class="boton" id="modificar" name="modificar">Modificar</button>
                </div>
                <div style="display:flex; justify-content:center;">
                    <button type="button" class="boton" id="guardar"  style="display: none" >Guardar</button>
                </div>
                <div style="display:flex; justify-content:center;">
                    <button type="button" class="boton" id="cancelar" style="display: none">Cancelar</button>
                </div>
                    
            </form>

    </section>    
    <script src="../js/actualizar.js"></script>
</body>
</html>
