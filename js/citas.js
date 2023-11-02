var enlaceMisCitas = document.getElementById("misCitas");
var enlacePedirCita = document.getElementById("pedirCita");

var seccionMisCitas = document.getElementById("seccionMisCitas");
var seccionPedirCita = document.getElementById("seccionPedirCita");
 
enlaceMisCitas.addEventListener('click', function(){
    window.location.reload();
    enlaceMisCitas.classList.add('activo');
    enlacePedirCita.classList.remove('activo');
    seccionPedirCita.style.display = 'none';
    seccionMisCitas.style.display = 'flex';   
});

if (enlaceMisCitas.classList.contains("activo")) {
    recuperarCitas();
    console.log("Mostrando citas.");
} 

enlacePedirCita.addEventListener('click', function(){
    enlaceMisCitas.classList.remove('activo');
    enlacePedirCita.classList.add('activo');
    seccionMisCitas.style.display = 'none';
    seccionPedirCita.style.display = 'flex';
});

//Verificar que la fecha introducida es correcta:
var fechaCita = document.getElementById("fecha-cita");
var fechaHoy = new Date();
var fechaCorrecta;

fechaCita.addEventListener('blur', function(){
    if(fechaCita.value !== "" && new Date(fechaCita.value) > fechaHoy){
        //Verificar que la cita no se pide en fin de semana
        var diaSemana = new Date(fechaCita.value).getDay();
        if(diaSemana !== 6 && diaSemana !== 0 ){
            fechaCorrecta = true;
        }
    }
    else{
        fechaCorrecta = false;
    }
});

//Si fecha es correcta enviar formulario, si no es correcta mostrar mensaje de error
var formulario = document.getElementById("formulario-pedir-cita");
var enviarCita = document.getElementById("enviarCita");
var mensajeFormCitas = document.getElementById("mensajeFormCitas");

enviarCita.addEventListener('click', function(evento){
    evento.preventDefault();
    
    if(!fechaCorrecta){
        mensajeFormCitas.style.color = 'red';
        mensajeFormCitas.textContent = "Por favor, revise los datos introducidos."
    }
    else{
        mensajeFormCitas.style.color = 'green';
        mensajeFormCitas.textContent = "Cita solicitada correctamente."
        formulario.submit();
    }
});

//Variable donde se va a guardar la respuesta del servidor
var citasArray = [];

//funcion para cargar los datos y mostrar las citas:
function recuperarCitas(){

    $.ajax({
        url: "../php/mostrarCitas.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // El servidor devuelve un array JSON de citas
            // Recorrer el array de citas
            for (var i = 0; i < response.length; i++) {
                var cita = response[i];
                // Agregar la cita al array
                citasArray.push(cita);
            }
            //Llamamos a la funcion mostrar citas
            mostrarCitas();
        }
    });
    
}


function mostrarCitas() {

    var seccionMisCitas = document.getElementById('seccionMisCitas');

    if(citasArray.length === 0){
        var mensaje = document.getElementById("mensajeCitas");
        mensaje.textContent = "No tiene citas solicitadas.";
    }
    else{   
        for (var i = 0; i < citasArray.length; i++) {
            var cita = citasArray[i];
            var fechaCita = cita.fechaCita;
            var motivoCita = cita.motivoCita;
            var idCita = cita.idCita;
        
            var divCita = document.createElement('div');
            divCita.classList.add('clase-cita');
            divCita.setAttribute('data-id', idCita); // Agregamos el atributo data-id con el valor del idCita
        
            var labelFecha = document.createElement('label');
            labelFecha.textContent = 'Fecha: ';
        
            var inputFecha = document.createElement('input');
            inputFecha.type = 'date';
            inputFecha.value = fechaCita;
            inputFecha.disabled = true;
            inputFecha.classList.add('fecha');
            inputFecha.style.height = '40%';
        
            var labelMotivo = document.createElement('label');
            labelMotivo.textContent = 'Motivo: ';
        
            var inputMotivo = document.createElement('input');
            inputMotivo.type = 'text';
            inputMotivo.value = motivoCita;
            inputMotivo.disabled = true;
            inputMotivo.classList.add('motivo');
            inputMotivo.style.width = '20%';
            inputMotivo.style.height = '40%';
            inputMotivo.style.fontFamily = 'Quicksand, sans-serif';
        
            var modificar = document.createElement('button');
            modificar.textContent = 'Modificar';
            modificar.classList.add('modificar'); // Agregamos la clase "modificar"
            // modificar.style.height = '40%';
            
            var eliminar = document.createElement('button');
            eliminar.textContent = 'Eliminar';
            eliminar.classList.add('eliminar'); // Agregamos la clase "eliminar"
            // eliminar.style.height = '40%';
            
            //Escuchador de eventos para boton modificar
            modificar.addEventListener('click', (function (id) {
                return function () {
                    modificarCita(id);
                };
            })(idCita));
        
            //Escuchador de eventos para boton eliminar
            eliminar.addEventListener('click', (function (id) {
                return function () {
                    eliminarCita(id);
                };
            })(idCita));

            divCita.appendChild(labelFecha);
            divCita.appendChild(inputFecha);
            divCita.appendChild(labelMotivo);
            divCita.appendChild(inputMotivo);
            var separacion = document.createElement('div');
            separacion.style.width = '20%%';
            divCita.appendChild(separacion);
        
            if (Date.parse(fechaCita) > Date.now()) {
                divCita.appendChild(modificar);
                divCita.appendChild(eliminar);
                
            }
            else{
                var par = divCita.appendChild(document.createElement('p'));
                par.textContent = "Esta cita no está disponible";
            }

            seccionMisCitas.appendChild(divCita);
            seccionMisCitas.appendChild(document.createElement('p'));
        }
    }
}


function modificarCita(idCita) {
    // Obtener el div de la cita utilizando el idCita
    var divCita = document.querySelector('.clase-cita[data-id="' + idCita + '"]');
    if (divCita) {
        // Habilitar los inputs de la cita encontrada
        var inputFecha = divCita.querySelector('.fecha');
        var inputMotivo = divCita.querySelector('.motivo');

        inputFecha.disabled = false;
        inputMotivo.disabled = false;

        // Crear botones Guardar y Cancelar
        var botonGuardar = document.createElement('button');
        botonGuardar.textContent = 'Guardar';
        botonGuardar.classList.add('guardar');
        // botonGuardar.style.height = '40%';

        var botonCancelar = document.createElement('button');
        botonCancelar.textContent = 'Cancelar';
        botonCancelar.classList.add('cancelar');
        // botonCancelar.style.height = '40%';

        // Reemplazar botones Modificar y Eliminar por Guardar y Cancelar
        var botonModificar = divCita.querySelector('.modificar');
        var botonEliminar = divCita.querySelector('.eliminar');
        

        divCita.replaceChild(botonGuardar, botonModificar);
        divCita.replaceChild(botonCancelar, botonEliminar);

        // Agregar event listener para el botón Guardar
        botonGuardar.addEventListener('click', function () {
            guardarCita(idCita);
        });

        // Agregar event listener para el botón Cancelar
        botonCancelar.addEventListener('click', function () {
            cancelarModificacion(idCita);
        });
    }
}

function guardarCita(idCita) {
    // Obtener los datos actualizados de la cita
    var divCita = document.querySelector('.clase-cita[data-id="' + idCita + '"]');
    var inputFecha = divCita.querySelector('.fecha');
    var inputMotivo = divCita.querySelector('.motivo');
    var fechaCita = inputFecha.value;
    var motivoCita = inputMotivo.value;
    console.log(fechaCita);
  
    var mensaje = document.getElementById("mensajeCitas");
    if (fechaCita !== "" && new Date(fechaCita) >= fechaHoy) {

        //Verificar que la cita no se pide en fin de semana
        var diaSemana = new Date(fechaCita).getDay();
        console.log(diaSemana);

        if(diaSemana !== 6 && diaSemana !== 0 ){
            fechaCorrecta = true;
        }
    }
    else{
        fechaCorrecta = false;
    }
  
    if (fechaCorrecta) {   
        // Crear un objeto con los datos a enviar
        var data = {
            idCita: idCita,
            fechaCita: fechaCita,
            motivoCita: motivoCita
        };
            // Realizar la llamada AJAX utilizando jQuery.ajax
        $.ajax({
            url: '../php/actualizarCita.php',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log('La cita se guardó correctamente.');
                mensaje.style.color = 'green';
                mensaje.textContent = "Cita modificada correctamente.";
                // Esperar 1 segundo antes de recargar la página
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        });
    } else {
      // La fecha de la cita es anterior a la fecha actual
      mensaje.style.color = 'red';
      mensaje.textContent = "Por favor, revise la fecha introducida.";
      console.log(fechaCita);
    }
}

function cancelarModificacion(idCita){
    window.location.reload();
}
  
function eliminarCita(idCita) {
    $.ajax({
        url: "../php/eliminarCita.php",
        type: "POST",
        data: { idCita: idCita },
        success: function(response) {
            window.location.reload();
        }
    });
}
  







  


