var noticias = document.getElementById("noticias");
var crearNoticia = document.getElementById("crearNoticia");

var seccionNoticias = document.getElementById("seccionNoticias");
var seccionCrearNoticia = document.getElementById("seccionCrearNoticia");
  
  
noticias.addEventListener('click', function(){
    console.log("click noticias");
    noticias.classList.add('activo');
    crearNoticia.classList.remove('activo');
    seccionCrearNoticia.style.display = 'none';
    seccionNoticias.style.display = 'flex';   
});

crearNoticia.addEventListener('click', function(){
    console.log("click crear noticias");
    noticias.classList.remove('activo');
    crearNoticia.classList.add('activo');
    seccionNoticias.style.display = 'none';
    seccionCrearNoticia.style.display = 'flex';
});

// seccion para crear las noticias
var publicar = document.getElementById("publicar");
var mensajeNuevaNoticia = document.getElementById("mensajeNuevaNoticia");
var formulario = document.getElementById("formNoticias");

publicar.addEventListener('click', function(){
    mensajeNuevaNoticia.textContent = "";
    var titulo = document.getElementById("titulo").value;
    var imagen = document.getElementById("imagen").files;
    var contenido = document.getElementById("contenido").value;
    var fecha = document.getElementById("fecha").value;
   
    var datosCorrectos = verificarTitulo(titulo) && verificarImagen(imagen) && verificarTexto(contenido) && verificarFecha(fecha);

    if (datosCorrectos) {
        console.log("Ha entrado en el if datos correctos");
        var datos = {titulo: titulo};
        url = "../php/validarNoticia.php";
        console.log("Los datos que se envian: " + titulo);
        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            success: function(response) {
                console.log("Ha entrado en el succes");
                if (response.exists) {
                    mensajeNuevaNoticia.textContent = "El titulo ya existe.";
                    mensajeNuevaNoticia.style.color = 'red';
                }
                else {
                    mensajeNuevaNoticia.textContent = "Noticia creada correctamente.";
                    mensajeNuevaNoticia.style.color = 'green';
                    setTimeout(function() {
                        document.getElementById("formNoticias").submit();
                    }, 1000);
                }           
            },
            dataType: "json"
        });
    }
    else{
        mensajeNuevaNoticia.textContent = "Por favor, revise los datos introducidos. Todos los campos son obligatorios.";
        mensajeNuevaNoticia.style.color = 'red';
    }
});

function verificarTitulo(titulo){
    if(titulo.trim() !== ""){
        return true;
    }
    else{
        return false;
    }
}

function verificarTexto(contenido){
    if(contenido.trim() !== ""){
        return true;
    }
    else{
        return false;
    }
}

function verificarImagen(imagen) {
    if (imagen && imagen.length > 0 && imagen[0].type.startsWith('image/')) {
        // El archivo seleccionado es una imagen
        return true;
    }
    // No se ha seleccionado una imagen o el archivo seleccionado no es una imagen
    return false;
}

function verificarFecha(fecha){

    var fechaHoy = new Date();

    if (fecha !== "" && fecha !== null && new Date(fecha) <= fechaHoy) {
        return true;
    }
    else{
        return false;
    }
}

// seccion para mostrar las noticias
document.addEventListener("DOMContentLoaded", function() {
    console.log("dom cargado");
    if (noticias.classList.contains('activo')){
        console.log("seccion noticias activo");
        recuperarNoticias();
    }
});


//Variable array donde se van a guardar las noticias de la base de datos
var noticiasArray = [];

function recuperarNoticias(){
    
    var mensajeNoticias = document.getElementById("mensajeNoticias");
    mensajeNoticias.textContent = "";

    console.log("Ha entrado en la funcion recuperarNoticias()");
    $.ajax({
        url: "../php/mostrarNoticiasAdm.php",
        type: "GET",
        
        success: function(response) {
            console.log("Ha entrado en el succes");
            if(response){
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        var noticia = response[i];
                        // Agregar la cita al array
                        noticiasArray.push(noticia);
                    }
                    mostrarNoticias(noticiasArray);
                }
                else{
                    mensajeNoticias.textContent = "No hay noticias publicadas.";
                }
            }
        },
        dataType: "json"
    });
}

function mostrarNoticias(noticiasArray){

    console.log("Ha entrado en la funcion mostrarNoticias()");

    for(var i = 0; i < noticiasArray.length; i++){
        console.log("Ha entrado en el for");

        var noticia = noticiasArray[i];
        var idNoticia = noticia.idNoticia;
        var idUser = noticia.idUser;
        var titulo = noticia.titulo;
        var imagen = noticia.imagen;
        var texto = noticia.texto;
        var fecha = noticia.fecha;

        //contenedor principal de la noticia
        var divNoticia = document.createElement('div');
        divNoticia.classList.add('divNoticia');
        divNoticia.setAttribute('data-id', idNoticia); // Agregamos el atributo data-id con el valor del idNoticia

        var mensajeNoticia = document.createElement('p');
        mensajeNoticia.textContent = "";
        mensajeNoticia.classList.add('mensajeNoticia');

        //diferentes div para agregar los elementos
        var divPrimeraFila = document.createElement('div');
        divPrimeraFila.classList.add('divPrimeraFila');

        var divTitulo = document.createElement('div');
        divTitulo.classList.add('divTitulo');

        var divImagen = document.createElement('div');
        divImagen.classList.add('divImagen');

        var divContenido = document.createElement('div');
        divContenido.classList.add('divContenido');

        var divBotones = document.createElement('div');
        divBotones.classList.add('divBotones');


        // idNoticia
        var labelINoticia = document.createElement('label');
        labelINoticia.classList.add('label');
        labelINoticia.textContent = 'idNoticia: ';

        var inputidNoticia = document.createElement('input');
        inputidNoticia.type = 'text';
        inputidNoticia.value = idNoticia;
        // inputidNoticia.style.width = '4%';
        inputidNoticia.disabled = true;
        inputidNoticia.classList.add('idNoticia');      

        // idUser
        var labelIdUser = document.createElement('label');
        labelIdUser.classList.add('label');
        labelIdUser.textContent = 'idUser: ';

        var inputIdUser = document.createElement('input');
        inputIdUser.type = 'text';
        inputIdUser.value = idUser;
        // inputIdUser.style.width = '4%';
        inputIdUser.disabled = true;
        inputIdUser.classList.add('idUser');

        // fecha
        var labelFecha = document.createElement('label');
        labelFecha.classList.add('label');
        labelFecha.textContent = 'Fecha: ';

        var inputFecha = document.createElement('input');
        inputFecha.type = 'date';
        inputFecha.value = fecha;
        inputFecha.disabled = true;
        inputFecha.classList.add('fecha');

        //agregamos los tres primeros elementos al divPrimeraFila
        divPrimeraFila.appendChild(labelINoticia);
        divPrimeraFila.appendChild(inputidNoticia);
        divPrimeraFila.appendChild(labelIdUser);
        divPrimeraFila.appendChild(inputIdUser);
        divPrimeraFila.appendChild(labelFecha);
        divPrimeraFila.appendChild(inputFecha);
        

        // titulo
        var labelTitulo = document.createElement('label');
        labelTitulo.classList.add('label');
        labelTitulo.textContent = "Título: ";

        var inputTitulo = document.createElement('input');
        inputTitulo.type = 'text';
        inputTitulo.value = titulo;
        inputTitulo.disabled = true;
        inputTitulo.classList.add('titulo');

        //agregamos al contenedor personal
        divTitulo.appendChild(labelTitulo);
        divTitulo.appendChild(inputTitulo);

        // imagen
        var labelImagen = document.createElement('label');
        labelImagen.classList.add('label');
        labelImagen.textContent = "Imagen: ";

        var inputImagen = document.createElement('input');
        inputImagen.type = 'text';
        inputImagen.value = imagen;
        inputImagen.disabled = true;
        inputImagen.classList.add('inputImagen');

        //agregamos al contenedor personal
        divImagen.appendChild(labelImagen);
        divImagen.appendChild(inputImagen);

        // contenido
        var labelContenido = document.createElement('label');
        labelContenido.classList.add('label');
        labelContenido.textContent = "Contenido: ";

        var inputTexto = document.createElement('textarea');
        inputTexto.type = 'text';
        inputTexto.value = texto;
        // inputTexto.rows = 5;
        // inputTexto.style.lineHeight = '1.5em';
        inputTexto.disabled = true;
        inputTexto.classList.add('texto');

        //agregamos al contenedor personal
        divContenido.appendChild(labelContenido);
        divContenido.appendChild(inputTexto);      

        //botones
        var modificar = document.createElement('button');
        modificar.textContent = 'Modificar';
        modificar.classList.add('modificar'); 

        
        var eliminar = document.createElement('button');
        eliminar.textContent = 'Eliminar';
        eliminar.classList.add('eliminar'); 

        //agregamos al contenedor personal
        divBotones.appendChild(modificar);
        divBotones.appendChild(eliminar);     

        //agregamos los elementos al div principal
        divNoticia.appendChild(mensajeNoticia);
        divNoticia.appendChild(divPrimeraFila);
        divNoticia.appendChild(divTitulo);
        divNoticia.appendChild(divImagen);
        divNoticia.appendChild(divContenido);
        divNoticia.appendChild(divBotones);

        seccionNoticias.appendChild(divNoticia);
        seccionNoticias.appendChild(document.createElement('p'));

        //Escuchador de eventos para boton modificar
        // Envolver la función modificarCita en una función adicional para capturar la referencia correcta al divCita
        modificar.addEventListener('click', (function(div) {
            return function() {
                modificarNoticia(div);
            };
        })(divNoticia));
    
        //Escuchador de eventos para boton eliminar
        eliminar.addEventListener('click', (function (div) {
            return function () {
                eliminarNoticia(div);
            };
        })(divNoticia));
    } 
}

function modificarNoticia(divNoticia) {

    var inputs = divNoticia.querySelectorAll('input, textarea');

    console.log(inputs);

    for (var i = 2; i < inputs.length; i++) {
        if(i == 4){
            continue;
        }
        inputs[i].disabled = false;
    }

    var divBotones = divNoticia.querySelector('.divBotones');
    var modificar = divBotones.querySelector('.modificar');
    var eliminar = divBotones.querySelector('.eliminar');

    var guardar = document.createElement('button');
    guardar.textContent = 'Guardar';
    guardar.classList.add('guardar');

    var cancelar = document.createElement('button');
    cancelar.textContent = 'Cancelar';
    cancelar.classList.add('cancelar');

    var inputModificarImagen = document.createElement('input');
    inputModificarImagen.type = 'file';
    inputModificarImagen.style.paddingBottom = '5px';
    inputModificarImagen.classList.add('modificarImagen');

    var divImagen = divNoticia.querySelector('.divImagen');
    var inputImagen = divImagen.querySelector('.inputImagen');
    divImagen.insertBefore(inputModificarImagen, inputImagen);
    divBotones.replaceChild(guardar, modificar);
    divBotones.replaceChild(cancelar, eliminar);

    cancelar.addEventListener('click', function(){
        window.location.reload();
    });

    guardar.addEventListener('click', function() {
        guardarDatos(divNoticia);
    });
}

function eliminarNoticia(divNoticia){

    var mensajeNoticia = divNoticia.querySelector('.mensajeNoticia');
    var idNoticia = divNoticia.querySelector('.idNoticia').value;
    var datos = {idNoticia: idNoticia}; 
    console.log(datos);
    url ="../php/eliminarNoticia.php";

    $.ajax({

        url: url,
        type: 'POST',
        data: datos,

        success: function(response) {
            console.log("Ha entrado en el succes");
            // console.log(response);
            if(response.exists){
                console.log('La noticia se ha eliminado correctamente.');
                mensajeNoticia.style.color = 'green';
                mensajeNoticia.textContent = "Noticia eliminada correctamente.";
                // Esperar 1 segundo antes de recargar la página
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
            // else{
            //     console.log('La noticia NO se ha eliminado correctamente.');
            //     mensajeNoticias.style.color = 'red';
            //     mensajeNoticias.textContent = "Noticia NO eliminada correctamente.";
            // }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", errorThrown);
        },
        dataType: "json"
    });

}

function guardarDatos(divNoticia) {

    var mensajeNoticia = divNoticia.querySelector('.mensajeNoticia');
    var idNoticia = divNoticia.querySelector('.idNoticia').value;
    var titulo = divNoticia.querySelector('.titulo').value;
    var imagenNueva = divNoticia.querySelector('.modificarImagen').files[0]; // Obtener el archivo seleccionado
    var imagenAntigua = divNoticia.querySelector('.inputImagen').value;
    var texto = divNoticia.querySelector('.texto').value;
    var fecha = divNoticia.querySelector('.fecha').value;

    var datosCorrectos = verificarTitulo(titulo) && verificarTexto(texto) && verificarFecha(fecha);

    if (datosCorrectos) {
        
            var datos = {
                idNoticia: idNoticia,
                titulo: titulo,
            };

            var url = "../php/validarActualizacionNoticiaAdm.php";

            $.ajax({
                url: url,
                type: 'POST',
                data: datos, 
                success: function(response) {
                    if (response.exists === true) {
                        mensajeNoticia.style.color = 'red';
                        mensajeNoticia.textContent = "El título ya existe.";
                    } 
                    else {
                        enviarDatos(mensajeNoticia, idNoticia, titulo, imagenAntigua, imagenNueva, texto, fecha);
                    }
                },
                dataType: "json"
            });
    } 
    else {
        mensajeNoticia.style.color = 'red';
        mensajeNoticia.textContent = "Por favor, revise los datos introducidos. Todos los campos son obligatorios.";
    }
}



function enviarDatos(mensajeNoticia, idNoticia, titulo, imagenAntigua, imagenNueva, texto, fecha) {
    var formData = new FormData(); // Crear objeto FormData
    formData.append('idNoticia', idNoticia);
    formData.append('titulo', titulo);
    formData.append('imagenAntigua', imagenAntigua);
    formData.append('imagenNueva', imagenNueva); // Agregar la imagen al FormData
    formData.append('texto', texto);
    formData.append('fecha', fecha);
  
    var url = "../php/actualizarNoticiaAdm.php";
    console.log(formData);
  
    $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      processData: false, // Desactivar el procesamiento de datos
      contentType: false, // Desactivar el tipo de contenido
      success: function(response) {
        if (response.exists) {
          mensajeNoticia.style.color = 'green';
          mensajeNoticia.textContent = "Noticia actualizada correctamente.";
          // Esperar 1 segundo antes de recargar la página
          setTimeout(function() {
            window.location.reload();
          }, 1000);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX:", errorThrown);
      },
      dataType: "json"
    });
  }
  


  