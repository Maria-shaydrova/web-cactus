//Botones
var modificar = document.getElementById("modificar");
var guardar = document.getElementById("guardar");
var cancelar = document.getElementById("cancelar");

//Variables de los datos del formulario
var contrasena = document.getElementById("contrasena");
var nombre = document.getElementById("nombre");
var apellidos = document.getElementById("apellidos");
var email = document.getElementById("email");
var telefono = document.getElementById("telefono")
var nacimiento = document.getElementById("nacimiento");

//Variables para verificar los datos del formulario:
var contrasenaCorrecta;
var nombreCorrecto;
var apellidosCorrectos;
var emailCorrecto;
var emailVerificado;
var telefonoCorrecto;
var telefonoVerificado;
var nacimientoCorrecto;

//Si se hace click en el boton modificar:
modificar.addEventListener("click", function() {

    //ocultamos el boton modificar y mostramos los botones guardar y cancelar
    modificar.style.display = "none";
    guardar.style.display = "block";
    cancelar.style.display = "block";

    //habilitamos los campos para editarlos
    contrasena.disabled = false;
    nombre.disabled = false;
    apellidos.disabled = false;
    email.disabled = false;
    telefono.disabled = false;
    nacimiento.disabled = false;
    direccion.disabled = false;
    sexo.disabled = false;

    //Los valores del formulario -> inicialmente se establecen en true, ya que si están en la base de datos son correctos.
    contrasenaCorrecta = true;
    nombreCorrecto = true;
    apellidosCorrectos = true;
    emailCorrecto = true;
    emailVerificado = true;
    telefonoCorrecto = true;
    telefonoVerificado = true;
    nacimientoCorrecto = true;
});
  

//1. Verificación datos personales formulario

//1.1 Comprobación contraseña
var errorContrasena = document.getElementById("errorContrasena");
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

//1.2 Comprobacion nombre
var errorNombre = document.getElementById("errorNombre");
nombre.addEventListener('blur',function(){
    nombreCorrecto = false;
    const restriccionNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}$/;
    if(restriccionNombre.test(nombre.value) && nombre.value != null){
        errorNombre.textContent = "";
        nombreCorrecto = true;
    }
    else{
        errorNombre.textContent = "El nombre no es válido";
        console.log("Valor de nombre correcto: ", nombreCorrecto);
    }
});


//1.3 Comprobacion apellidos
var errorApellidos = document.getElementById("errorApellidos");
apellidos.addEventListener('blur', function(){
    apellidosCorrectos = false;
    const restriccionApellidos = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/;
    if(restriccionApellidos.test(apellidos.value)){
        errorApellidos.textContent = "";
        apellidosCorrectos = true;
    }
    else{
        errorApellidos.textContent = "Apellidos no válidos";
        apellidosCorrectos = false;
    }
});

// 1.4 Comprobacion email

var errorEmail = document.getElementById("errorEmail");
email.addEventListener('blur', function(){
    
    const restriccionEmail = /^(.+\@.+\..+)$/;
    if(restriccionEmail.test(email.value)){
        console.log("Email correcto: ", email.value);
        var datos = {
            email: email.value
        };
        verificarExistenciaEmail(datos);
        emailCorrecto = true;
    }
    else{
        errorEmail.textContent = "Email no válido";
        emailCorrecto = false;
        emailVerificado = false;
    }
});

// Función para verificar la existencia del correo electrónico en el servidor
function verificarExistenciaEmail(datos) {
    var url = "../php/validar-actualizacion.php";
    var dataType = "json";
    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function(respuesta) {
            if (respuesta.exists) {
                // El email ya existe
                errorEmail.textContent = "El email ya existe";
                emailVerificado = false;
            } else {
                // El email está disponible
                errorEmail.textContent = "";
                emailVerificado = true;
                console.log("Email: ", email.value, emailCorrecto, emailVerificado);
            }
        },
        dataType: dataType
    });
}

//1.5 Comprobacion telefono
var errorTelefono = document.getElementById("errorTelefono");
telefono.addEventListener('blur', function(){
    telefonoCorrecto = false;
    const restriccionTelefono = /^[0-9]{9}$/;
    if(!restriccionTelefono.test(telefono.value)){
        errorTelefono.textContent = "Teléfono no válido";
    }
    else{
        var datos = 'telefono=' + $("#telefono").val();
        var url = "../php/validar-actualizacion.php";
        var dataType = "json";

        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(respuesta) {
                if (respuesta.exists) {
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

//1.6 Comprobacion fecha nacimiento
var errorNacimiento = document.getElementById("errorNacimiento");
nacimiento.addEventListener('blur', function() {

    nacimientoCorrecto = false;
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


//Cuando se presiona el boton de guardar antes de enviar el formulario se comprueban los datos del formulario
guardar.addEventListener('click', function() {
    verificarDatos();
});


// Función para verificar los datos y enviar el formulario
function verificarDatos() {
    datosCorrectos = contrasenaCorrecta && nombreCorrecto && apellidosCorrectos && emailCorrecto && telefonoCorrecto && nacimientoCorrecto;
    datosVerificados = emailVerificado && telefonoVerificado;
    //Verifica que los datos introducidos son correctos, tanto en el cliente como en el servidor
    if (datosCorrectos && datosVerificados) {
        formularioPerfil.submit();
        mensajeErrorForm.style.color = 'green';
        mensajeErrorForm.textContent = "Datos actualizados correctamente.";      
    } else {
        mensajeErrorForm.style.color = 'red';
        mensajeErrorForm.textContent = "Por favor, revise los datos introducidos.";
    }
}

cancelar.addEventListener('click', function(){
    window.location = '../vistas/perfil.php';
})
