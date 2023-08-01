//querySelector
const heading = document.querySelector(".header__texto h2") //Retorna o un elemento
heading.textContent = 'Nuevo heading';
console.log(heading)

//querySelectorAll
const enlaces = document.querySelectorAll('.navegacion a');
enlaces[0].textContent = 'nuevo texto de enlace';
console.log(enlaces)

//getElementById
const heading2 = document.getElementById('heading');
console.log(heading2)

//Generar un enlace con codigo javascript
const nuevoEnlace = document.createElement('A');

//Agregar el href
nuevoEnlace.href = 'nuevo-enlace.html';

//Agregar el texto
nuevoEnlace.textContent = 'Tienda virtual';

//Agregar la clase
nuevoEnlace.classList.add('navegacion__enlace');

//Agregarlo al documento
const navegacion = document.querySelector('.navegacion');
navegacion.appendChild(nuevoEnlace);

console.log(nuevoEnlace);






//Eventos
console.log(1);

window.addEventListener('load', function(){ //load espera a que todo esté cargado
    console.log(2);
});

window.onload = function(){ //Es lo mismo que la funcion load con addEventListener
    console.log(3);
}

document.addEventListener('DOMContentLoaded', function(){ //solo espera que se descargue el html pero no espera css ni imagenes
    console.log(4);
})

console.log(5);

window.onscroll = function(){
    console.log("scroll");
}






//Seleccionar elementos y asociarles un evento
// const btnEnviar = document.querySelector('.boton--primario');
// btnEnviar.addEventListener('click', function(evento){
//     console.log(evento);
//     evento.preventDefault();
//     console.log('enviando formulario');
// });





//Eventos de los inputs y los textarea
const datos = {
    nombre: '',
    email: '',
    mensaje: ''
}

const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');

nombre.addEventListener('input', leerTexto);

email.addEventListener('input', leerTexto);

mensaje.addEventListener('input', leerTexto);

function leerTexto(e){
    //console.log(e.target.value);
    datos[e.target.id] = e.target.value;
    console.log(datos);
}






//EL evento de Submit
const formulario = document.querySelector('.formulario');
formulario.addEventListener('submit', function(e){
    e.preventDefault();
    console.log('Enviando formulario'); 

    //Validar el formulario
    const{nombre, email, mensaje } = datos;
    
    if(nombre === '' || email === '' || mensaje === ''){
        mostrarMensaje('Todos los campos son obligatorios', true);
        return;
    }
    //Enviar formulario
    mostrarMensaje('Mensaje enviado correctamente');

});

function mostrarMensaje(mensaje, error = null){
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;

    if(error){
        alerta.classList.add('error');
    }else{
        alerta.classList.add('correctos')
    }

    formulario.appendChild(alerta);

    setTimeout(() => {
        alerta.remove();
    }, 5000);
}