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
    <title>Noticias-admin</title>
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
                        echo '<li><a href="citaciones-admin.php">Citaciones-admin</a></li>';
                        echo '<li><a class="activo" href="noticias-admin.php">Noticias-admin</a></li>';                       
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <section id="noticiasAdmin">
        <h2>Noticias</h2>
        
            <ul class="lista-usuarios">
                <li ><a class="enlace-noticias activo" id="noticias">Noticias</a></li>
                <li ><a class="enlace-noticias" id="crearNoticia">Crear noticia</a></li>     
            </ul> 

            <section id="seccionNoticias">
                    <div><p id="mensajeNoticias"></p></div>
            </section>

            <section id="seccionCrearNoticia" style="display: none;">

            <form id="formNoticias" action="../php/crearNoticiaAdm.php" method="POST" enctype="multipart/form-data">
                <div class="elementoFormNoticias">
                    <p id="mensajeNuevaNoticia"></p>
                </div>
                <div class="elementoFormNoticias">
                    <label class="labelForm" for="titulo">Título: </label>
                    <input type="text" id="titulo" name="titulo">
                </div>
                <div class="elementoFormNoticias" id>
                    <label class="labelForm" for="imagen">Imagen: </label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <div class="elementoFormNoticias">
                    <label class="labelForm" for="contenido">Contenido: </label>
                    <textarea type="text" id="contenido" name="contenido"></textarea>
                </div>
                <div class="elementoFormNoticias">
                    <label class="labelForm" for="fecha">Fecha: </label>
                    <input type="date" id="fecha" name="fecha">
                </div>
                <div class="elementoFormNoticias" style="align-content: center; flex-wrap: wrap;">
                    <label></label>
                    <button type="button" id="publicar">Publicar</button>
                </div>
            </form>

            </section>
    </section>
    <script src="../js/noticiasAdm.js"></script>  
</body>
</html>
