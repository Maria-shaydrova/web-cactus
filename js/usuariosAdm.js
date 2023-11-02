var enlaceUsuarios = document.getElementById("enlaceUsuarios");
var enlaceCrearUsuario = document.getElementById("crearUsuario");

var seccionUsuarios = document.getElementById("seccionUsuarios");
var seccionCrearUsuario = document.getElementById("seccionCrearUsuario");

enlaceUsuarios.addEventListener('click', function(){
    //console.log("click en usuarios");
    window.location.reload();
    enlaceUsuarios.classList.add('activo');
    enlaceCrearUsuario.classList.remove('activo');
    seccionCrearUsuario.style.display = 'none';
    seccionUsuarios.style.display = 'flex';   
});

if (enlaceUsuarios.classList.contains("activo")) {
    recuperarUsuarios();
    //console.log("Mostrando usuarios.");
} 

enlaceCrearUsuario.addEventListener('click', function(){
    //console.log("Clic en crear nuevo usuario");
    enlaceUsuarios.classList.remove('activo');
    enlaceCrearUsuario.classList.add('activo');
    seccionUsuarios.style.display = 'none';
    seccionCrearUsuario.style.display = 'flex';
});

//Variable donde se va a guardar la respuesta del servidor
var usuariosArray = [];

//funcion para cargar los datos y mostrar las citas:
function recuperarUsuarios(){
    console.log("Ha entrado en la funcion recuperarUsuarios()");
    $.ajax({
        url: "../php/mostrarUsuarios.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // El servidor devuelve un array JSON de citas
            // Recorrer el array de citas
            console.log("Ha entrado en la funcion succes.");
            for (var i = 0; i < response.length; i++) {
                var usuario = response[i];
                // Agregar la cita al array
                usuariosArray.push(usuario);
            }
                mostrarUsuarios();
        }
    });
}

var tbody = document.createElement('tbody'); // Crea el cuerpo de la tabla
tbody.classList.add('cuerpo');

function mostrarUsuarios() {
    //console.log("Ha entrado en la funcion mostrarUsuario()");
    var tabla = document.querySelector('.tabla-usuarios');

    for (var i = 0; i < usuariosArray.length; i++) {
        construirFila(usuariosArray[i]);
    }
    tabla.appendChild(tbody);
}

function construirFila(usuario) {
    //console.log("Ha entrado en la funcion construir fila");
    //console.log(usuario);

    // Creamos una fila y le añadimos el atributo data-id que será el idUser
    var fila = document.createElement('tr');
    fila.setAttribute('data-id', usuario.idUser);

    for (var key in usuario) {
        var celda = document.createElement('td');

        if (key === "rol") {
            var select = document.createElement('select');
            select.classList.add(key);
            select.type = 'select';

            var option1 = document.createElement('option');
            option1.value = "user";
            option1.textContent = "User";
            select.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = "admin";
            option2.textContent = "Admin";
            select.appendChild(option2);

            select.value = usuario[key];
            select.disabled = true;

            celda.appendChild(select);
        } else if (key === "sexo") {
            var select = document.createElement('select');
            select.classList.add(key);

            var option1 = document.createElement('option');
            option1.value = "";
            option1.textContent = " ";
            select.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = "Hombre";
            option2.textContent = "Hombre";
            select.appendChild(option2);

            var option3 = document.createElement('option');
            option3.value = "Mujer";
            option3.textContent = "Mujer";
            select.appendChild(option3);

            select.value = usuario[key];
            select.disabled = true;

            celda.appendChild(select);
        } else {
            var input = document.createElement('input');
            input.classList.add(key);
            input.value = usuario[key];
            input.disabled = true;
            if(key === "password"){
                input.type = 'password';
            }
            else if(key === "fecha_nac"){
                input.type = "date";
            }
            else{
                input.type="text" ;
            }
            celda.appendChild(input);
        }
        fila.appendChild(celda);

    }
    console.log("ha terminado de construir las filas");
    crearBotones(fila);
    tbody.appendChild(fila);
}

function crearBotones(fila){

    console.log(fila);

    var celda = document.createElement('td');
    
    var modificar = document.createElement('button');
    modificar.textContent = 'Modificar'
    modificar.classList.add('modificar');
    celda.appendChild(modificar);

    fila.appendChild(celda);

    var celda = document.createElement('td');

    var eliminar = document.createElement('button');
    eliminar.textContent = 'Eliminar'
    eliminar.classList.add('eliminar');
    celda.appendChild(eliminar);

    fila.appendChild(celda);

    modificar.addEventListener('click', function() {
        habilitar(fila);
        cambiarBotones(fila);
    });

    eliminar.addEventListener('click', function() {
        eliminarUsuario(fila);       
    });

}

function habilitar(fila){
    // console.log("Ha entrado en la funcion habilitar fila");
    var inputs = fila.querySelectorAll('input, select');
    for(var i = 1; i < inputs.length; i++){
        inputs[i].disabled = false;
    }
}

function cambiarBotones(fila) {
    var celdas = fila.querySelectorAll('td');

    var guardar = document.createElement('button');
    guardar.textContent = 'Guardar';
    guardar.classList.add('guardar');

    var cancelar = document.createElement('button');
    cancelar.textContent = 'Cancelar';
    cancelar.classList.add('cancelar');

    celdas[celdas.length - 2].innerHTML = '';
    celdas[celdas.length - 2].appendChild(guardar);

    celdas[celdas.length - 1].innerHTML = '';
    celdas[celdas.length - 1].appendChild(cancelar);

    guardar.addEventListener('click', function() {
        verificar(fila);
    });

    cancelar.addEventListener('click', function() {
        window.location.reload();
    });
}



function eliminarUsuario(fila){

    var inputs = fila.querySelectorAll('input, select');
    var idUser = inputs[0].value;
    console.log("Ha entrado en la funcion eliminar usuario", idUser);
    //var [idUser, usuario, contrasena, rol, nombre, apellidos, email, telefono, fecha, direccion, sexo] = extraerDatos(fila);
    
    var datos = {idUser: idUser};
    var url = "../php/eliminarUsuario.php";

    $.ajax({
        type: "POST",
        url: url,
        data: datos,
        success: function(respuesta) {
            console.log("Ha entrado en la funcion succes");
            if (respuesta.exists) {
                mensajeUsuarios.style.color = 'green';
                mensajeUsuarios.textContent = 'Usuario ' + idUser + ' eliminado correctamente';
                // Redirigir a la página de perfil para refrescar los datos mostrados después de unos segundos
                setTimeout(function() {
                    window.location.href = '../vistas/usuarios-admin.php';
                }, 2000);
            } 
            else {
            // Enviar los datos del usuario
            }
        },
        dataType: "json"
    });
}


var mensajeUsuarios = document.getElementById("mensajeUsuarios");

function verificar(fila){

    //console.log("Ha entrado en la funcion verificar");
    //var inputs = fila.querySelectorAll('input, select');
    var [idUser, usuario, contrasena, rol, nombre, apellidos, email, telefono, fecha, direccion, sexo] = extraerDatos(fila);
    
    //Restricciones de los campos:
    //console.log("Los datos del usuario que se quieren enviar a la base de datos son: ", usuario);
    const restriccionUsario = /^[a-zA-Z0-9]+$/;
    const restriccionContrasena = /^[^\s]+$/;
    const restriccionNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}$/;
    const restriccionApellidos = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/;
    const restriccionEmail = /^(.+\@.+\..+)$/;
    const restriccionTelefono = /^[0-9]{9}$/;
    var hoy = new Date();
    var fecha_nac = new Date(fecha);
    fecha_nac.setFullYear(fecha_nac.getFullYear() + 18);

    mensajeUsuarios.textContent = '';

    //Validamos los datos en el lado del cliente
    if(!restriccionUsario.test(usuario)){
        mensajeUsuarios.textContent = 'El usuario no es válido';
    }
    else if(!restriccionContrasena.test(contrasena)){
        mensajeUsuarios.textContent = 'La contraseña no es válida';
    }
    else if(!restriccionNombre.test(nombre)){
        mensajeUsuarios.textContent = 'El nombre no es válido';
    }
    else if(!restriccionApellidos.test(apellidos)){
        mensajeUsuarios.textContent = 'Los apellidos no son válidos';
    }
    else if(!restriccionEmail.test(email)){
        mensajeUsuarios.textContent = 'El email no es válido';
    }
    else if(!restriccionTelefono.test(telefono)){
        mensajeUsuarios.textContent = 'El teléfono no es válido';
    }
    else if(fecha === "" || fecha === null || (fecha_nac > hoy)){
        mensajeUsuarios.textContent = 'La fecha de nacimiento no es válida.'
    }
    else{
        //Si los datos de los clientes son correctos, verificamos los datos en el lado del servidor
        var datos = {
            idUser: idUser,
            usuario: usuario,
            email: email,
            telefono: telefono
        };
        //console.log(datos);
        var url = "../php/validarActualizacionUsuarioAdmin.php";
    
        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(respuesta) {
                //console.log("Respuesta del servidor:", respuesta);
                if (respuesta.exists) {
                    mensajeUsuarios.style.color = 'red';
                    mensajeUsuarios.textContent = respuesta.mensaje;
                } else {
                    //Enviar los datos del usuario
                    actualizarUsuario(idUser, usuario, contrasena, rol, nombre, apellidos, email, telefono, fecha, direccion, sexo);
                }
        },
        dataType: "json"
        });
    }
}


//Funcion para obtener los valores ingresados por el ususario y crear un objeto con estos datos
function extraerDatos(fila){
    var inputs = fila.querySelectorAll('input, select');
    var idUser = inputs[0].value;
    var usuario = inputs[1].value;
    var contrasena = inputs[2].value
    var rol = inputs[3].value;
    var nombre = inputs[4].value;
    var apellidos = inputs[5].value
    var email = inputs[6].value;
    var telefono = inputs[7].value;
    var fecha = inputs[8].value
    var direccion = inputs[9].value;
    var sexo = inputs[10].value;
    return [idUser, usuario, contrasena, rol, nombre, apellidos, email, telefono, fecha, direccion, sexo];
}

function actualizarUsuario(idUser, usuario, contrasena, rol, nombre, apellidos, email, telefono, fecha, direccion, sexo){
    //console.log("Ha entrado en la funcion actualizar Usuario: " + idUser);
    var datos = {
        idUser: idUser,
        usuario: usuario,
        contrasena: contrasena,
        rol: rol,
        nombre: nombre,
        apellidos: apellidos,
        email: email,
        telefono: telefono,
        fecha: fecha,
        direccion: direccion,
        sexo: sexo
      };
    var url = "../php/actualizarUsuarioAdmin.php";

    $.ajax({
    type: "POST",
    url: url,
    data: datos,
    success: function(respuesta) {
        console.log("Ha entrado en la funcion succes");
        if (respuesta.exists) {
            mensajeUsuarios.style.color = 'green';
            mensajeUsuarios.textContent = 'Datos del usuario ' + idUser + ' actualizados correctamente';
            // Redirigir a la página de perfil para refrescar los datos mostrados después de unos segundos
            setTimeout(function() {
                window.location.href = '../vistas/usuarios-admin.php';
            }, 2000);
        } 
        else {
        // Enviar los datos del usuario
        }
    },
    dataType: "json"
    });
}

// ---- Sección nuevo usuario ------

var enviar = document.getElementById("enviar");
enviar.addEventListener('click', function(){
    console.log("Click en el boton enviar");
    verificarNuevoUsuario();
});
    
function verificarNuevoUsuario(){

    //Obtenemos los valores del formulario
    var nuevoUsuario = document.getElementById("nuevoUsuario").value;
    var nuevaContrasena = document.getElementById("nuevaContrasena").value;
    var nuevoRol = document.getElementById("nuevoRol").value;
    var nuevoNombre = document.getElementById("nuevoNombre").value;
    var nuevosApellidos = document.getElementById("nuevosApellidos").value;
    var nuevoEmail = document.getElementById("nuevoEmail").value;
    var nuevoTelefono = document.getElementById("nuevoTelefono").value;
    var nuevoNacimiento = document.getElementById("nuevoNacimiento").value;
    var nuevaDireccion = document.getElementById("nuevaDireccion").value;
    var nuevoSexo = document.getElementById("nuevoSexo").value;

    //Restricciones para los campos del formulario
    const restriccionUsario = /^[a-zA-Z0-9]+$/;
    const restriccionContrasena = /^[^\s]+$/;
    const restriccionNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}$/;
    const restriccionApellidos = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}$/;
    const restriccionEmail = /^(.+\@.+\..+)$/;
    const restriccionTelefono = /^[0-9]{9}$/;
    var hoy = new Date();
    var fechaNacimiento = new Date(nuevoNacimiento);
    fechaNacimiento.setFullYear(fechaNacimiento.getFullYear() + 18);

    var mensajeNuevoUsuario = document.getElementById("mensajeNuevoUsuario");

    var mensajesError = [];
    //Validamos los datos en el lado del cliente
    if(!restriccionUsario.test(nuevoUsuario)){
        mensajesError.push('· Usuario');
    }
    if(!restriccionContrasena.test(nuevaContrasena)){
        mensajesError.push('· Contraseña');
    }
    if(!restriccionNombre.test(nuevoNombre)){
        mensajesError.push('· Nombre');
    }
    if(!restriccionApellidos.test(nuevosApellidos)){
        mensajesError.push('· Apellidos');
    }
    if(!restriccionEmail.test(nuevoEmail)){
        mensajesError.push('· Email');
    }
    if(!restriccionTelefono.test(nuevoTelefono)){
        mensajesError.push('· Teléfono');
    }
    if (nuevoNacimiento === "" || nuevoNacimiento === null || fechaNacimiento > hoy) {
        mensajesError.push('· Fecha de nacimiento');
    }

    if(mensajesError.length == 0){
        //Verificacion en el lado del servidor:
        var datos = {
            usuario: nuevoUsuario,
            email: nuevoEmail,
            telefono: nuevoTelefono
        };
        var url = "../php/validarNuevoUsuarioAdmin.php";
        
        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(respuesta) {  
                if (respuesta.exists) {
                    for (var key in respuesta) {
                        if (respuesta[key] && key !== 'exists') {
                            mensajesError.push('· ' + respuesta[key].mensaje);
                        }
                    }
                    mensajeNuevoUsuario.style.color = 'red';
                    mensajeNuevoUsuario.innerHTML = 'Revise los siguientes campos:<br>' + mensajesError.join("<br>");
                } 
                else {
                    mensajeNuevoUsuario = '';
                    nuevoUsuarioAdm();
                }
            },
            dataType: "json"
        });
    }
    else{
        mensajeNuevoUsuario.style.color = 'red';

        mensajeNuevoUsuario.innerHTML = 'Revise los siguientes campos:<br>' + mensajesError.join("<br>");
    }
}

function nuevoUsuarioAdm(){

    var formualarioNuevoUsuario = document.getElementById("formualarioNuevoUsuario");
    var mensajeNuevoUsuario = document.getElementById("mensajeNuevoUsuario");
    mensajeNuevoUsuario.style.color = 'green';
    mensajeNuevoUsuario.textContent = "Usuario registrado correctamente.";
    formualarioNuevoUsuario.submit();
    // console.log(formualarioNuevoUsuario);

}