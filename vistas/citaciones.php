<?php
    include '../php/conexion.php';
    include '../php/datos_usuario.php';
    //include '../php/mostrarCitas.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citaciones</title>
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
                        echo '<li><a class="activo" href="../vistas/citaciones.php">Citaciones</a></li>';
                        echo '<li><a href="../vistas/perfil.php">Perfil</a></li>';
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <section id="citaciones">
        <h2>Citas del usuario <?php echo $usuario ?></h2>
        
            <ul class="lista-citas">
                <li class="elemento-citas"><a class="enlace-citas activo" id="misCitas">Mis citas</a></li>
                <li class="elemento-citas"><a class="enlace-citas" id="pedirCita">Pedir cita</a></li>     
            </ul> 

            <section class="seccionCitas" id="seccionMisCitas">
                <p id="mensajeCitas" style="display:flex; justify-content: center; height: 20px;"></p>
                <!-- Aqui se añaden los div con citas en js -->
                
            </section>  

            <section class="seccionCitas" id="seccionPedirCita" style="display: none;">

                <form id="formulario-pedir-cita" action="../php/pedirCita.php" method="post">
                    <div class="elemento-formulario-citas">
                        <p id="mensajeFormCitas"></p>
                    </div>
                    <div class="elemento-formulario-citas">
                        <label for="fecha-cita" style="font-family: 'Monserrat', sans-serif;">Fecha de la cita:</label>
                        <input class="entradaFormCitas" type="date" id="fecha-cita" name="fecha-cita">
                        <p class="errorForm"></p>
                    </div>
                    <div class="elemento-formulario-citas">
                        <label for="motivo-cita" style="font-family: 'Monserrat', sans-serif;">Motivo de la cita:</label>
                        <input class="entradaFormCitas" type="text" id="motivo-cita" name="motivo-cita" placeholder="Ej.: Cita con el diseñador.">
                        <p class="errorForm"></p>
                    </div>
                    <div class="elemento-formulario-citas" style="align-items: center;">
                        <button id ="enviarCita" class="boton" type="submit">Enviar</button>
                    </div>

                </form>

            </section>
        <!-- </nav> -->
        


    </section>
    <script src="../js/citas.js"></script>  
</body>
</html>
