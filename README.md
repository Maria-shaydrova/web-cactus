# Web-cactus

Web-cactus es un proyecto personal que sirve como ejemplo para un página web con diferentes funcionalidades. Inlcuye una pagina de inicio con galería dinámica, una sección de noticias, una página de **registro** y una página de **login**. Tiene una base de datos donde se almacenan los datos de los usuarios, de las citas solicitadas y las noticias creadas por los administradores. 

## Instalación

1. Es necesario tener instalado un servidor web local multiplataforma que permite la creación y prueba de páginas web u otros elementos de programación. [Descargar Xampp.](https://www.apachefriends.org/es/index.html) [Instalar Xampp](Descargar ).

2. Clonar el repositorio en el directorio **htdocs** dentro de **xampp**, por ejemplo **C:\xampp\htdocs**.

3. Dentro de phpMyAdmin crear una base de datos llamada **empresa** e importar el archivo **empresa.sql** localizado en la carpeta **C:\xampp\htdocs\cactus\sql** del proyecto.

4. Abrir el proyecto en el navegador mediante la dirección [localhost](http://localhost/) y y seleccionar la carpeta del proyecto. Directamente: [http://localhost/cactus/](http://localhost/cactus/)


## Uso

- Registrarse en la página rellenando los datos del formulario.
- Para ver más funcionalidades cambiar el rol del usuario a admin.
- Para cambiar el rol del usuario a administrador entrar en phpMyAdmin y en la tabla users_login cambiar el valor del desplegable rol a admin.


## Licencia

[MIT](https://choosealicense.com/licenses/mit/)
