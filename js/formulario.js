//1. Verificación datos personales formulario


// 1.1 Comprobacion usuario
var usuario = document.getElementById("usuario");
var errorUsuario = document.getElementById("errorUsuario");
var usuarioCorrecto = false;
var usuarioVerificado = false;
usuario.addEventListener('blur', function(){
    usuarioCorrecto = false;
    usuarioVerificado = false;
    const restriccionUsario = /^[a-zA-Z0-9]+$/;
    if(!restriccionUsario.test(usuario.value)){
        errorUsuario.textContent = "El usuario no es válido";
    }
    else {
        var datos = 'usuario=' + $("#usuario").val();
        var url = "../php/validar.php";
        var dataType = "json";  

        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(data) {
                console.log("Respuesta del servidor: ", data);  // Mostrar la respuesta completa en formato JSON
                if (data.exists) {  // Verificar la propiedad "exists" de la respuesta JSON
                    // El usuario ya existe
                    errorUsuario.textContent = "El usuario ya existe";
                    usuarioCorrecto = false;
                } else {
                    // El usuario está disponible
                    errorUsuario.textContent = "";
                    usuarioCorrecto = true;
                    usuarioVerificado = true;
                    //verificarDatos(); // Verificar datos y enviar formulario
                    console.log("El valor del usuario es:", usuarioCorrecto);
                }
            },
            dataType: dataType
        });
    }
});



//1.2 Comprobación contraseña
var contrasena = document.getElementById("contrasena");
var errorContrasena = document.getElementById("errorContrasena");
var contrasenaCorrecta = false;
contrasena.addEventListener('blur', function(){
    contrasenaCorrecta = false;
    const restriccionContrasena = /^[^\s]+$/;
    if(restriccionContrasena.test(contrasena.value) && contrasena.value != null){
        errorContrasena.textContent = "";
        contrasenaCorrecta = true;
    }
    else{
        errorContrasena.textContent = "La contraseña no es válida";
    }
})


//1.3 Comprobacion nombre
var nombre = document.getElementById("nombre");
var errorNombre = document.getElementById("errorNombre");
var nombreCorrecto = false;
nombre.addEventListener('blur',function(){
    nombreCorrecto = false;
    const restriccionNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}$/;
    if(restriccionNombre.test(nombre.value) && nombre.value != null){
        errorNombre.textContent = "";
        nombreCorrecto = true;
    }
    else{
        errorNombre.textContent = "El nombre no es válido";
    }
});


//1.4 Comprobacion apellidos
var apellidos = document.getElementById("apellidos");
var errorApellidos = document.getElementById("errorApellidos");
var apellidosCorrectos = false;
apellidos.addEventListener('blur', function(){
    apellidosCorrectos = false;
    const restriccionApellidos = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/;
    if(restriccionApellidos.test(apellidos.value)){
        errorApellidos.textContent = "";
        apellidosCorrectos = true;
    }
    else{
        errorApellidos.textContent = "Apellidos no válidos";
    }
});


// 1.5 Comprobacion email
var email = document.getElementById("email");
var errorEmail =document.getElementById("errorEmail");
var emailCorrecto = false; //Lado cliente
var emailVerificado = false; //Lado servidor
email.addEventListener('blur', function(){
    emailCorrecto = false;
    emailVerificado = false;
    const restriccionEmail = /^(.+\@.+\..+)$/;
    if(!restriccionEmail.test(email.value)){
        errorEmail.textContent = "Email no válido";
    }
    else{
        var datos = 'email=' + $("#email").val();
        var url = "../php/validar.php";
        var dataType = "json"; // Cambiado a "json"
        console.log("El valor del email es:", email.value);
        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.exists) {
                    // El email ya existe
                    errorEmail.textContent = "El email ya existe";
                    emailCorrecto = false;
                } else {
                    // El email está disponible
                    errorEmail.textContent = "";
                    emailCorrecto = true;
                    emailVerificado = true;
                    console.log("El valor del email es:", emailCorrecto);
                }
            },
            dataType: dataType
        });
    }
});

//1.6 Comprobacion telefono
var telefono = document.getElementById("telefono")
var errorTelefono = document.getElementById("errorTelefono");
var telefonoCorrecto = false;
var telefonoVerificado = false;
telefono.addEventListener('blur', function(){
    telefonoCorrecto = false;
    telefonoVerificado = false;
    const restriccionTelefono = /^[0-9]{9}$/;
    if(!restriccionTelefono.test(telefono.value)){
        errorTelefono.textContent = "Teléfono no válido";
    }
    else{
        var datos = 'telefono=' + $("#telefono").val();
        var url = "../php/validar.php";
        var dataType = "json";

        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.exists) {
                    // El teléfono ya existe
                    errorTelefono.textContent = "El teléfono ya existe";
                    telefonoCorrecto = false;
                } else {
                    // El teléfono está disponible
                    errorTelefono.textContent = "";
                    telefonoCorrecto = true;
                    telefonoVerificado = true;
                }
            },
            dataType: dataType
        });
    }
});


//1.7 Comprobacion fecha nacimiento
var nacimiento = document.getElementById("nacimiento");
var errorNacimiento = document.getElementById("errorNacimiento");
var nacimientoCorrecto = false;

nacimiento.addEventListener('blur', function() {

    nacimientoCorrecto = false;
    //Variables para calcular si el usuario ya tiene 18
    var hoy = new Date();
    var fecha_nac = new Date(nacimiento.value);
    fecha_nac.setFullYear(fecha_nac.getFullYear() + 18);

    if (nacimiento.value === "" || isNaN(Date.parse(nacimiento.value)) || fecha_nac > hoy) {
        errorNacimiento.textContent = "Fecha no válida";
    } else {
        nacimientoCorrecto = true;
        errorNacimiento.innerHTML = "";
    }
});


var registrarse = document.getElementById("registrarse");
var formuario = document.getElementById("formulario");
// Evento submit del formulario -> cuando se quiera enviar el formulario previamente se tiene que comprobar los datos en el servidor
registrarse.addEventListener('click', function() {
    console.log("Se ha hecho click en enviar");
    verificarDatos();
});


// Función para verificar los datos y enviar el formulario
function verificarDatos() {
    var datosCorrectos = usuarioCorrecto && contrasenaCorrecta && nombreCorrecto && apellidosCorrectos && emailCorrecto && telefonoCorrecto && nacimientoCorrecto
    var datosVerificados = usuarioVerificado && emailVerificado && telefonoVerificado
    //Verifica que los datos introducidos son correctos, tanto en el cliente como en el servidor
    if (datosCorrectos && datosVerificados) {
        console.log("Evento click - enviar formulario");
        mensajeErrorForm.style.color = 'green';
        mensajeErrorForm.textContent = "Usuario registrado correctamente.";
        formulario.submit();
    } else {
        mensajeErrorForm.style.color = 'red';
        mensajeErrorForm.textContent = "Por favor, revise los datos introducidos.";
    }
}


// Restablecer los campos después de enviar el formulario
formulario.addEventListener('reset', function(evento) {
    usuarioCorrecto = false;
    contrasenaCorrecta = false;
    nombreCorrecto = false;
    apellidosCorrectos = false;
    emailCorrecto = false;
    telefonoCorrecto = false;
    mensajeErrorForm.textContent = "";
});




