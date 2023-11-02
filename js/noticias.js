document.addEventListener('DOMContentLoaded', function() {
  var contenedorNoticias = document.getElementById("contenedorNoticias");
  recuperarNoticias();
});

function recuperarNoticias(){

  var noticias = [];

  $.ajax({

    url: "../php/mostrarNoticias.php",
    type: "GET",
    dataType: "json",

    success: function(response) {
      // El servidor devuelve un array JSON de noticias
      // Recorrer el array de noticias
      for (var i = 0; i < response.length; i++) {
          var noticia = response[i];
          // Agregar la noticia al array
          noticias.push(noticia);
      }
      mostrarNoticias(noticias);
    }
  });
}

// var contenedorNoticias = document.getElementById("contenedorNoticias");

function mostrarNoticias(noticias){
  
  for(var i = 0; i < noticias.length; i++){
    
    var noticia = noticias[i];
    var idNoticia = noticia.idNoticia;
    var idUser = noticia.idUser;
    var titulo = noticia.titulo;
    var imagenSrc = noticia.imagenSrc;
    var texto = noticia.texto;
    var fecha = noticia.fecha;
    var nombre = noticia.nombre;
    var apellidos = noticia.apellidos;
    console.log(noticia);

    //contenedor principal de la noticia
    var contenedorNoticia = document.createElement('div');
    contenedorNoticia.classList.add('contenedorNoticia');
    contenedorNoticia.setAttribute('data-id', idNoticia); // Agregamos el atributo data-id con el valor del idNoticia

    var tituloNoticia = document.createElement('p');
    tituloNoticia.classList.add('tituloNoticia');
    tituloNoticia.textContent = titulo;

    var contenidoNoticia = document.createElement('p');
    contenidoNoticia.classList.add('contenidoNoticia');
    contenidoNoticia.textContent = texto;

    var publicado = document.createElement('p');
    publicado.classList.add('publicado');
    publicado.textContent = "Publicado: ";

    var autor = document.createElement('span');
    autor.classList.add('autor');
    autor.textContent = nombre + ' ' + apellidos + ', ';

    var fechaNoticia = document.createElement('span');
    fechaNoticia.classList.add('fechaNoticia');
    fechaNoticia.textContent = fecha;

    publicado.appendChild(autor);
    publicado.appendChild(fechaNoticia);

    var imagenNoticia = document.createElement('img');
    imagenNoticia.classList.add('imagenNoticia');
    imagenNoticia.setAttribute('src', imagenSrc);  

    //agregamos los elementos
    contenedorNoticia.appendChild(tituloNoticia);
    contenedorNoticia.appendChild(contenidoNoticia);
    contenedorNoticia.appendChild(publicado);
    // Establecer imagen como fondo del contenedorNoticia
    contenedorNoticia.style.backgroundImage = "url(" + imagenSrc + ")";

    contenedorNoticias.appendChild(contenedorNoticia);
  }
}
