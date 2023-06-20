//Configuración de dropzone

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    //Trabajado con imagen en el contenedor de Dropzone
    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/${imagenPublicada.name}');
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

//Eventos de Dropzone
//Información de la imagen
/*dropzone.on('sending', function(file, xhr, fromdata){
    console.log(file);
});*/

//1. Envío correcto de la imagen
dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen;
});

//2. Evento de envío con error
dropzone.on('error', function(file, message){
    console.log(message);
});

//3. Evento cuando remueves un archivo
dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value = "";
});