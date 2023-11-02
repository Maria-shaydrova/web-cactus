
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
                <li><a class="activo" href="registro.php">Registro</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>   
        </nav>
        <div></div>
    </header>
    <main>
        
        <section id="registro">         
        <h1 style="background-color: transparent; z-index: 1; margin-top: 0;">Registrarse</h1>
            <form id="formulario" action="../php/nuevo-usuario.php" method="post">
                <div class="elemento-formulario merged">
                    <p id="mensajeErrorForm"></span></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <p class="errorForm" id="errorUsuario"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
                    <p class="errorForm" id="errorContrasena"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="nombre" name="nombre" placeholder="Nombre">
                    <p class="errorForm" id="errorNombre"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
                    <p class="errorForm" id="errorApellidos"></p>
                </div>
                <div class="elemento-formulario">
                    <input  class="entrada" type="text" id="email" name="email" placeholder="Email">
                    <p class="errorForm" id="errorEmail"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="tel" id="telefono" name="telefono" placeholder="Teléfono">
                    <p class="errorForm" id="errorTelefono"></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="date" id="nacimiento" name="nacimiento" placeholder="Fecha de nacimiento">
                    <p class="errorForm" id="errorNacimiento" ></p>
                </div>
                <div class="elemento-formulario">
                    <input class="entrada" type="text" id="direccion" name="direccion" placeholder="Dirección">
                    <p class="errorForm"></p>
                </div>
                <div class="elemento-formulario">
                    <select class="entrada" id="sexo" name="sexo">
                        <option class="entrada" value="opcion">Sexo</option>
                        <option class="entrada" value="hombre">Hombre</option>
                        <option class="entrada" value="mujer">Mujer</option>
                    </select>     
                    <p class="errorForm"></p>
                </div>
                <div class="elemento-check">
                    <input type="checkbox" id="terminos" name="terminos" required>
                    <label for="terminos">Acepto la política de privacidad.</label>
                    <p class="errorForm"></p>
                </div>
                <div class="elemento-boton">
                    <button id ="registrarse" class="boton" type="button">Registrarse</button>
                </div>
                <div>
                    <a href="login.php" class="enlace">Ya tengo cuenta</a>
                </div>
            </form>
        </section>
    </main>
    <footer >
    </footer>
    
    <script src="../js/formulario.js"></script>
</body>
</html>

