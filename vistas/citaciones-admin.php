<?php
    include '../php/conexion.php';
    include '../php/datos_usuario.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citaciones-admin</title>
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
                    if ($rol == 'admin'){
                        echo '<li><a href="perfil.php">Perfil</a></li>';
                        echo '<li><a href="usuarios-admin.php">Usuarios-admin</a></li>';
                        echo '<li><a class="activo" href="citaciones-admin.php">Citaciones-admin</a></li>';
                        echo '<li><a href="noticias-admin.php">Noticias-admin</a></li>';                       
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <section id="citaciones-admin">
        <h2>Citaciones de los usuarios</h2>
        
        <div>
            <label>Seleccione usuario:</label>
            <select name="selectUsuarios" id="selectUsuarios"></select>
            <button id="seleccionar">Mostrar</button>
            <p></p>
        </div>

        <ul id="lista" class="lista-citas" style="display: none;">
            <li class="elemento-citas"><a class="enlace-citas" id="citasUsuario">Citaciones</a></li>
            <li class="elemento-citas"><a class="enlace-citas" id="nuevaCitaUsuario">Nueva cita</a></li>     
        </ul> 

        <div>
            <p id="mensajeDesplegable"></p>
        </div>
        
        <section class = "seccionCitasAdm" id="seccionCitasUsuario" style="display: none;">
        <div>
            <p id="mensajeCitas" style=""></p>
        </div>
            <!-- Mostrar las citas del usuario seleccionado -->
        </section>

        <section class = "seccionCitasAdm" id="seccionNuevaCitaUsuario" style="display: none;">
            <p id="mensajeCNuevaCita"></p>

            <form id="formNuevaCitaAdm" action="" method="post">

                    <div class="elemento-formulario-citas">
                        <p id="mensajeFormCitasAdm" style="display: flex; justify-content: center; height: 20px;"></p>
                    </div>

                    <div class="elemento-formulario-citas">
                        <label for="fecha-cita" style="font-family: 'Monserrat', sans-serif;">Fecha de la cita:</label>
                        <input class="entradaFormCitas" type="date" id="fechaCitaAdm" name="fecha-cita">
                        <p class="errorForm"></p>
                    </div>

                    <div class="elemento-formulario-citas">
                        <label for="motivo-cita" style="font-family: 'Monserrat', sans-serif;">Motivo de la cita:</label>
                        <input class="entradaFormCitas" type="text" id="motivoCitaAdm" name="motivo-cita" placeholder="Ej.: Cita con el diseñador.">
                        <p class="errorForm"></p>
                    </div>
                    
                    <div class="elemento-formulario-citas" style="align-items: center;">
                        <button id ="enviarCitaAdm" class="boton" type="button">Enviar</button>
                    </div>

                    <div>
                        <p></p>
                    </div>

                </form>
        </section>
    </section>
    <script src="../js/citacionesAdmin.js"></script>  
<body>
<html>    