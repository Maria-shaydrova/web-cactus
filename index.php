<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
    <?php include 'php/datos_usuario.php'; ?>
</head>
<body>
    <header class="encabezado">
        <div id="logo">
            <a href="index.php" class="enlaceInicio">MUNDOCACTUS <img src="imagenes/seedling-solid.svg" alt="icono" /></a>
        </div>
        <nav class="menu">
            <ul class="lista">
                <li><a class="activo" href="index.php">Inicio</a></li>
                <li><a href="vistas/noticias.php">Noticias</a></li>
                <?php
                    if ($rol == 'visitante') {
                        echo '<li><a href="vistas/registro.php">Registro</a></li>';
                        echo '<li><a href="vistas/login.php">Login</a></li>';
                        
                    }
                    if ($rol == 'user'){
                        echo '<li><a href="vistas/citaciones.php">Citaciones</a></li>';
                        echo '<li><a href="vistas/perfil.php">Perfil</a></li>';
                        echo '<li><a href="php/cerrar.php">Cerrar sesión</a></li>';
                    }
                    if ($rol == 'admin'){
                        echo '<li><a href="vistas/perfil.php">Perfil</a></li>';
                        echo '<li><a href="vistas/usuarios-admin.php">Usuarios-admin</a></li>';
                        echo '<li><a href="vistas/citaciones-admin.php">Citaciones-admin</a></li>';
                        echo '<li><a href="vistas/noticias-admin.php">Noticias-admin</a></li>';                       
                        echo '<li><a href="php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <main>
        <h1>Explora la belleza espinosa de la naturaleza</h1>

        <section class="primerContenedorInicio">
            <div class="contenido">
                <p class="textoPrimerContenderInicio">Donde la resistencia es sinónimo de belleza</p>
            </div>
        </section>

        <div class="ful-img" id="fulImgBox">
            <img src="imagenes/echeveria.jpg" id="fulImg" alt="">
            <span onclick="closeImg()"> X </span>
        </div>
        <h2 style="heigh: none;">Nuestras especies</h2>
        <section id="galeria">
            
            <picture class="galeria_img">
                <img src="imagenes/echeveria.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Echeveria</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/asterias.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Astrophytum asterias</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/myriostigma.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Astrophytum myriostigma</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/ornatum.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Astrophytum ornatum</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/capricorne.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Astrophytum capricorne</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/caput-medusae.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Astrophytum caput-medusae</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/pumila.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Haworthia pumila</figcaption>
            </picture>
            <picture class="galeria_img">
                <img src="imagenes/lithops.jpg" onclick="openFulImg(this.src)" alt="">
                <figcaption>Lithops</figcaption>
            </picture>
        </section>
      
        <section id="contacto">
            <h2>Visita nuestras instalaciones</h2>
            <div id="seccion-contacto">
                <div id="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3193.368093173841!2d-2.4047770064095055!3d36.83365951673586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzbCsDUwJzAzLjIiTiAywrAyNCcxMi42Ilc!5e0!3m2!1ses!2ses!4v1698837429386!5m2!1ses!2ses" width="600" height="450" style="border:0.5px solid;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        
                </div>

                <div id="info-empresa">
                    <h2>MUNDOCACTUS</h2>
                    <h3>Visite nuestro local:</h3>
                    <address>C. de la Mar de la Cañada s/n <br>04120 La Cañada, Almería</address>
                    <h3>Contacte con nosotros:</h3>
                        <a href="mailto:info@mundocactus.com" class="enlaceInicio">info@mundocactus.com</a>
                        <a href="tel:+34600700800" class="enlaceInicio">Tlf. +34 600 700 800 </a>
                    <h3>Horario:</h3>
                    <p>Lunes - Viernes: 09:00 - 14:00, 16:00 - 19:00</p>
                </div>
            </div>

        </section>

    </main>

    <footer >
        <div id="pie">
            <p>Contacta con nosotros y sigue nuestras novedades:</p>
            <div id="logos">
                <img class="logo" src="imagenes/logo-facebook.svg" alt="Logo facebook">
                <img class="logo" src="imagenes/logo-instagram.svg" alt="Logo instagram">
                <img class="logo" src="imagenes/logo-whatsapp.svg" alt="Logo whatsapp">
                <img class="logo" src="imagenes/logo-twitter.svg" alt="Logo twitter">
            </div>
            <p id="aviso-legal">Esta obra está bajo una <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/">licencia de Creative Commons  </a></p>
            <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" alt="imagen-creative"/></a>
        </div>
    </footer>
    <script src="js/galeria.js"></script>
</body>
</html>

