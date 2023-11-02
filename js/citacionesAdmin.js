//Hacemos llamada ajax para recuperar los usuarios de la base de datos
document.addEventListener("DOMContentLoaded", function() {

    var usuariosArray = [];

    $.ajax({
        url: "../php/recuperarUsuariosAdm.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // El servidor devuelve un array JSON de citas
            // Recorrer el array de citas
            for (var i = 0; i < response.length; i++) {
                var usuario = response[i];
                // Agregar la cita al array
                usuariosArray.push(usuario);
                console.log(usuario);
            }
            //Llamamos a la funcion para agregar los idUser al desplegable
            agregarUsuario(usuariosArray);
        }
    });
});

var selectUsuarios = document.getElementById("selectUsuarios");

function agregarUsuario(usuariosArray){
    
    selectUsuarios.append(document.createElement('option'));

    for (var i = 0; i < usuariosArray.length; i++){
        var option = document.createElement('option');
        option.value = usuariosArray[i].idUser;
        option.textContent = 'idUser: ' + usuariosArray[i].idUser;
        selectUsuarios.appendChild(option);
    }
}

var seleccionar = document.getElementById("seleccionar");
var lista = document.getElementById("lista");
var citasUsuario = document.getElementById("citasUsuario");
var nuevaCitaUsuario = document.getElementById("nuevaCitaUsuario");
var seccionCitasUsuario = document.getElementById("seccionCitasUsuario");
var seccionNuevaCitaUsuario = document.getElementById("seccionNuevaCitaUsuario");
var mensajeDesplegable = document.getElementById("mensajeDesplegable");
var mensajeCitas = document.getElementById("mensajeCitas");

seleccionar.addEventListener('click', function(){

    mensajeCitas.textContent = '';
    seccionCitasUsuario.innerHTML = '';

    if (selectUsuarios.value !== '') {

        var idUser = selectUsuarios.value;

        mensajeDesplegable.textContent = "";
        mensajeCitas.textContent = "";

        lista.style.display = 'flex';
        citasUsuario.classList.add('activo');
        nuevaCitaUsuario.classList.remove('activo');
        seccionNuevaCitaUsuario.style.display = 'none';
        seccionCitasUsuario.style.display = 'flex';   

        recuperarCitas(idUser);
    }
    else{
        ocultarTodo();
        mensajeDesplegable.textContent = "Seleccione usuario para ver las citas"
    }
})

citasUsuario.addEventListener('click', function(){
    citasUsuario.classList.add('activo');
    nuevaCitaUsuario.classList.remove('activo');
    seccionNuevaCitaUsuario.style.display = 'none';
    seccionCitasUsuario.style.display = 'flex';   
});

nuevaCitaUsuario.addEventListener('click', function(){
    mensajeFormCitasAdm.textContent = "";
    citasUsuario.classList.remove('activo');
    nuevaCitaUsuario.classList.add('activo');
    seccionCitasUsuario.style.display = 'none';
    seccionNuevaCitaUsuario.style.display = 'flex';
});

function ocultarTodo(){
    lista.style.display = 'none';
    seccionNuevaCitaUsuario.style.display = 'none';
    seccionCitasUsuario.style.display = 'none';
    mensajeCitas.textContent = "";
}

function recuperarCitas(idUser){

    var datos = {idUser: idUser};
    var url = "../php/mostrarCitasAdm.php";
    var citasArray = [];

    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function(response) {
    
            if (response.exists === true) {
                citasArray = response.citas;
                console.log(citasArray);
                cargarCitas(citasArray);
            }
            else {
                mensajeCitas.textContent = "El usuario no ha realizado ninguna cita.";
                mensajeCitas.style.color = 'black';
                seccionCitasUsuario.appendChild(mensajeCitas);
            }           
        },
        dataType: "json"
    });
}

function cargarCitas(citasArray) {
    
    seccionCitasUsuario.innerHTML = "";
    mensajeCitas.textContent = "";
    
    seccionCitasUsuario.appendChild(mensajeCitas);
    console.log(citasArray);

    if(citasArray.length === 0){
        mensajeCitas.textContent = "";
    }
    else{
        for (var i = 0; i < citasArray.length; i++) {
            var cita = citasArray[i];
            var idCita = cita.idCita;
            var idUser = cita.idUser;
            var fechaCita = cita.fechaCita;
            var motivoCita = cita.motivoCita;
            
            var divCita = document.createElement('div');
            divCita.classList.add('divCita');
            divCita.setAttribute('data-id', idCita); // Agregamos el atributo data-id con el valor del idCita

            var labelIdCita = document.createElement('label');
            labelIdCita.textContent = 'idCita: ';
        
            var inputIdCita = document.createElement('input');
            inputIdCita.type = 'text';
            inputIdCita.value = idCita;
            inputIdCita.style.width = '5%';
            inputIdCita.disabled = true;
            inputIdCita.classList.add('idCita');

            var labelIdUser = document.createElement('label');
            labelIdUser.textContent = 'idUser: ';
        
            var inputIdUser = document.createElement('input');
            inputIdUser.type = 'text';
            inputIdUser.value = idUser;
            inputIdUser.style.width = '5%';
            inputIdUser.disabled = true;
            inputIdUser.classList.add('idUser');

        
            var labelFecha = document.createElement('label');
            labelFecha.textContent = 'Fecha: ';
        
            var inputFecha = document.createElement('input');
            inputFecha.type = 'date';
            inputFecha.value = fechaCita;
            inputFecha.style.width = '10%';
            inputFecha.disabled = true;
            inputFecha.classList.add('fecha');

        
            var labelMotivo = document.createElement('label');
            labelMotivo.textContent = 'Motivo: ';
        
            var inputMotivo = document.createElement('input');
            inputMotivo.type = 'text';
            inputMotivo.value = motivoCita;
            inputMotivo.style.width = '20%';
            inputMotivo.disabled = true;
            inputMotivo.classList.add('motivo');

        
            var modificar = document.createElement('button');
            modificar.textContent = 'Modificar';
            modificar.classList.add('modificar'); // Agregamos la clase "modificar"

            
            var eliminar = document.createElement('button');
            eliminar.textContent = 'Eliminar';
            eliminar.classList.add('eliminar'); // Agregamos la clase "eliminar"


            divCita.appendChild(labelIdCita);
            divCita.appendChild(inputIdCita);

            divCita.appendChild(labelIdUser);
            divCita.appendChild(inputIdUser);

            divCita.appendChild(labelFecha);
            divCita.appendChild(inputFecha);

            divCita.appendChild(labelMotivo);
            divCita.appendChild(inputMotivo);

            var separacion = document.createElement('div');

            divCita.appendChild(separacion);
        
            divCita.appendChild(modificar);
            divCita.appendChild(eliminar);

            
            seccionCitasUsuario.appendChild(divCita);
            seccionCitasUsuario.appendChild(document.createElement('p'));

            //Escuchador de eventos para boton modificar
            // Envolver la función modificarCita en una función adicional para capturar la referencia correcta al divCita
            modificar.addEventListener('click', (function(div) {
                return function() {
                    modificarCita(div);
                };
            })(divCita));
        
            //Escuchador de eventos para boton eliminar
            eliminar.addEventListener('click', (function (div) {
                return function () {
                    eliminarCita(div);
                };
            })(divCita));
        }
    }   
}


function modificarCita(divCita) {

    var inputs = divCita.querySelectorAll('input');
    console.log(inputs);

    for (var i = 2; i < inputs.length; i++) {
        inputs[i].disabled = false;
    }

    var modificar = divCita.querySelector('.modificar');
    var eliminar = divCita.querySelector('.eliminar');

    var guardar = document.createElement('button');
    guardar.textContent = 'Guardar';
    guardar.classList.add('guardar');

    var cancelar = document.createElement('button');
    cancelar.textContent = 'Cancelar';
    cancelar.classList.add('cancelar');

    divCita.replaceChild(guardar, modificar);
    divCita.replaceChild(cancelar, eliminar);

    guardar.addEventListener('click', function(){
        verificarDatos(divCita);
    });

    cancelar.addEventListener('click', function(){
        seleccionar.click();
    });
}

function eliminarCita(divCita){
    
    var idCita = divCita.querySelector('.idCita').value;

    $.ajax({
        url: "../php/eliminarCitaAdm.php",
        type: "POST",
        data: { idCita: idCita },
        success: function(respuesta) {

            if(respuesta.exists){
                mensajeCitas.textContent = "La cita Nº " + idCita + " se ha eliminado correctamente."
                mensajeCitas.style.color = 'green';
                setTimeout(function() {
                    seleccionar.click();
                    mensajeCitas.textContent = "";
                }, 1000);
                
            }
        },
        dataType: "json"
    });
}

function verificarDatos(divCita){

    var idCita = divCita.querySelector('.idCita').value;
    var fecha = divCita.querySelector('.fecha').value;
    var motivo = divCita.querySelector('.motivo').value;

    var fechaCorrecta = verificarFecha(fecha);
    
    if (fechaCorrecta) {   
        // Crear un objeto con los datos a enviar
        var data = {
            idCita: idCita,
            fecha: fecha,
            motivo: motivo
        };
        // Realizamos la llamada AJAX 
        $.ajax({
            url: '../php/actualizarCitaAdm.php',
            type: 'POST',
            data: data,
            success: function(response) {
                if(response.exists){
                    mensajeCitas.style.color = 'green';
                    mensajeCitas.textContent = "Cita nº " +idCita + " modificada correctamente.";
                    // Esperar 1 segundo antes de recargar la página
                    setTimeout(function() {
                        seleccionar.click();
                    }, 1000);
                }
            },
            dataType: "json"
        });
    } else {
      // La fecha de la cita es anterior a la fecha actual
      mensajeCitas.style.color = 'red';
      mensajeCitas.textContent = "Por favor, revise la fecha introducida.";
    }
    
}

function verificarFecha(fecha){

    console.log("se ha pasado la fecha de: " + fecha);
    var fechaHoy = new Date();

    if (fecha !== "" && new Date(fecha) >= fechaHoy) {

        //Verificar que la cita no se pide en fin de semana
        var diaSemana = new Date(fecha).getDay();

        if(diaSemana !== 6 && diaSemana !== 0 ){
            mensajeCitas.textContent = "";
            return true;
        }
    }
    else{
        return false;
    }
}

// seccion pedir cita para usuario seleccionado

var mensajeFormCitasAdm = document.getElementById("mensajeFormCitasAdm");
var enviarCitaAdm = document.getElementById("enviarCitaAdm");

enviarCitaAdm.addEventListener("click", function(){
    var fechaCitaAdm = document.getElementById("fechaCitaAdm").value;
    var motivoCitaAdm = document.getElementById("motivoCitaAdm").value;
    var idUser = selectUsuarios.value;

    var fechaCorrecta = verificarFecha(fechaCitaAdm);

    console.log('fecha correcta: ' + fechaCorrecta);

    if (fechaCorrecta) {   
        // Crear un objeto con los datos a enviar
        var data = {
            idUser: idUser,
            fecha: fechaCitaAdm,
            motivo: motivoCitaAdm
        };
            // Realizar la llamada AJAX utilizando jQuery.ajax
        $.ajax({
            url: '../php/nuevaCitaAdm.php',
            type: 'POST',
            data: data,
            success: function(response) {
                if(response.exists){
                    console.log('La cita se guardó correctamente.');
                    mensajeFormCitasAdm.style.color = 'green';
                    mensajeFormCitasAdm.textContent = "Cita solicitada correctamente.";
                    // Esperar 1 segundo antes de recargar la página
                    setTimeout(function() {
                    seleccionar.click();
                }, 1000);
                }
            },
            dataType: "json"
        });
    } else {
        // La fecha de la cita es anterior a la fecha actual
        mensajeFormCitasAdm.style.color = 'red';
        mensajeFormCitasAdm.textContent = "Por favor, revise la fecha introducida.";
    }


})







