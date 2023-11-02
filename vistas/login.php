<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <li><a href="noticias.php">Noticias</a></li>
                <li><a href="registro.php">Registro</a></li>
                <li><a class="activo" href="login.php">Login</a></li>
            </ul>   
        </nav>
        <div></div>
    </header>
    
        <h1>Iniciar sesión</h1>
        <section id="login">
            
            <form id="formulario-login" class="formulario-login" action="../php/login-usuario.php" method="post">
                <div>
                <p id="mensajeEntrada"></span></p>
                </div>
                <div class="elemento-formulario-login">
                    <input class="entrada-login" type="text" id="usuario" name="usuario" placeholder="Usuario">
                </div>
                <div class="elemento-formulario-login">
                    <input class="entrada-login" type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
                </div>
                <div class="elemento-formulario-login">
                    <button id="entrar" class="boton">Entrar</button>
                </div>
                <div class="elemento-formulario-login">
                    <a href="registro.php" class="enlace">Registrarse</a>
                </div>
            </form>

        </section>

    <footer >
        <div id="pie">
            <p>Visita nuestas instalaciones en: </p><address>calle de San Roque, 17 08001 Barcelona España</address>
            <p>Contacta con nosotros y sigue nuestras novedades:</p>
            <div id="logos">
                <img class="logo" src="../imagenes/logo-facebook.png" alt="Logo facebook">
                <img class="logo" src="../imagenes/logo-instagram.png" alt="Logo instagram">
                <img class="logo" src="../imagenes/logo-whatsapp.png" alt="Logo whatsapp">
                <img class="logo" src="../imagenes/logo-twitter.png" alt="Logo twitter">
            </div>
            <p id="aviso-legal">Esta obra está bajo una <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/">licencia de Creative Commons  </a></p>
            <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" alt="imagen-creative"/></a>
        </div>
    </footer>
    <script src="../js/entrada.js"></script>

</body>
</html>