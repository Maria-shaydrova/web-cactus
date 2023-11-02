

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php include '../php/datos_usuario.php'; ?>
</head>
<body>
    <header class="encabezado">
        <div id="logo">
            <a href="../index.php" class="enlaceInicio">MUNDOCACTUS <img src="../imagenes/seedling-solid.svg" alt="icono" /></a>
        </div>
        <nav class="menu">
            <ul class="lista">
                <li><a href="../index.php">Inicio</a></li>
                <li><a class="activo" href="noticias.html">Noticias</a></li>
                <?php
                    if ($rol == 'visitante') {
                        echo '<li><a href="registro.php">Registro</a></li>';
                        echo '<li><a href="login.php">Login</a></li>';
                        
                    }
                    if ($rol == 'user'){
                        echo '<li><a href="citaciones.php">Citaciones</a></li>';
                        echo '<li><a href="perfil.php">Perfil</a></li>';
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                    if ($rol == 'admin'){
                        echo '<li><a href="perfil.php">Perfil</a></li>';
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
    <main>
        <h1>Noticias</h1>
        <section id="contenedorNoticias"></section>
        
    </main>
    <footer >
        <div id="pie">
            <p>Contacta con nosotros y sigue nuestras novedades:</p>
            <div id="logos">
                <img class="logo" src="../imagenes/logo-facebook.svg" alt="Logo facebook">
                <img class="logo" src="../imagenes/logo-instagram.svg" alt="Logo instagram">
                <img class="logo" src="../imagenes/logo-whatsapp.svg" alt="Logo whatsapp">
                <img class="logo" src="../imagenes/logo-twitter.svg" alt="Logo twitter">
            </div>
            <p id="aviso-legal">Esta obra está bajo una <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/">licencia de Creative Commons  </a></p>
            <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" alt="imagen-creative"/></a>
        </div>
    </footer>
    <script src="../js/noticias.js"></script>
</body>
</html>