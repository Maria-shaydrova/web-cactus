

var usuario = document.getElementById("usuario");
var contrasena = document.getElementById("contrasena");

var formularioLogin = document.getElementById("formulario-login");
var mensajeEntrada = document.getElementById("mensajeEntrada");
var datosCorrectos = false;

formularioLogin.addEventListener('submit', function(evento) {
    evento.preventDefault();
    comprobar();
    console.log("Evento submit");
});

function comprobar() {
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var datos = {
        usuario: usuario,
        contrasena: contrasena
    };
    var url = "../php/login-usuario.php";
    var dataType = "html";

    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function(data) {
            if (data == 0) {
                // Datos incorrectos
                mensajeEntrada.style.color = 'red';
                mensajeEntrada.textContent = "Datos introducidos incorrectos";
            } else {
                // Datos correctos -> redirigir al index.php
                window.location.href = "../index.php";
            }
        },
        dataType: dataType
    });
}


