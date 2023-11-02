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
    <title>Usuario-admin</title>
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
                        echo '<li><a class="activo" href="usuarios-admin.php">Usuarios-admin</a></li>';
                        echo '<li><a href="citaciones-admin.php">Citaciones-admin</a></li>';
                        echo '<li><a href="noticias-admin.php">Noticias-admin</a></li>';                       
                        echo '<li><a href="../php/cerrar.php">Cerrar sesión</a></li>';
                    }
                ?>                
            </ul>   
        </nav>
        <div></div>
    </header>
    <section id="usuarios">
        <h2>Usuarios</h2>
        
        <!-- <nav class="pestana"> -->
            <ul class="lista-usuarios">
                <li ><a class="enlace-usuarios activo" id="enlaceUsuarios">Usuarios</a></li>
                <li ><a class="enlace-usuarios" id="crearUsuario">Crear usuario</a></li>     
            </ul> 
            <section class="seccionUsuarios" id="seccionUsuarios">
                <p id="mensajeUsuarios" style="display:flex; justify-content: center; height: 20px; color: red;"></p>
                    <table class="tabla-usuarios">
                        <thead>
                            <tr>
                                <th style="width: 3%; heigh: 100%;">idUser</th>
                                <th style="width: 5%;">Usuario</th>
                                <th style="width: 5%;">Contraseña</th>
                                <th style="width: 4%;">Rol</th>
                                <th style="width: 7%;">Nombre</th>
                                <th style="width: 8%;">Apellidos</th>
                                <th style="width: 10%;">Email</th>
                                <th style="width: 5%;">Teléfono</th>
                                <th style="width: 7%;">Fecha nacimiento</th>
                                <th style="width: 8%;">Dirección</th>
                                <th style="width: 5%;">Sexo</th>
                                <th style="width: 5%;"></th> <!-- Celda vacía para los botones -->
                                <th style="width: 5%;"></th> <!-- Celda vacía para los botones -->
                            </tr>
                        </thead>
                        <!-- El body se construye dinamicamente en js -->
                    </table>
            </section>

            <section class="seccionCrearUsuario" id="seccionCrearUsuario" style="display: none;">

            <form id="formualarioNuevoUsuario" action="../php/nuevoUsuarioAdmin.php" method="post">
                <div class="elemento-formulario merged">
                    <p id="mensajeNuevoUsuario"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="nuevoUsuario" name="nuevoUsuario" placeholder="Usuario">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="password" id="nuevaContrasena" name="nuevaContrasena" placeholder="Contraseña">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <select class="entrada" id="nuevoRol" name="nuevoRol">
                        <option class="entrada" value="user">user</option>
                        <option class="entrada" value="admin">admin</option>
                    </select>   
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="nuevosApellidos" name="nuevosApellidos" placeholder="Apellidos">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input  class="entrada" type="text" id="nuevoEmail" name="nuevoEmail"  placeholder="Email">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="tel" id="nuevoTelefono" name="nuevoTelefono" placeholder="Teléfono">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="date" id="nuevoNacimiento" name="nuevoNacimiento" placeholder="Fecha de nacimiento">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="nuevaDireccion" name="nuevaDireccion" placeholder="Dirección">
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-formulario">
                    <select class="entrada" id="nuevoSexo" name="nuevoSexo">
                        <option class="entrada" value="">Sexo</option>
                        <option class="entrada" value="Hombre">Hombre</option>
                        <option class="entrada" value="Mujer">Mujer</option>
                    </select>    
                    <p class = "pSeparacion"></p>
                </div>
                <div class="elemento-boton merged">
                    <button id ="enviar" class="boton" type="button">Enviar</button><br>
                </div>
            </form>

            </section>
    </section>
    <script src="../js/usuariosAdm.js"></script>  
</body>
</html>
