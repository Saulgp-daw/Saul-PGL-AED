const palabras = ["Spider-man", "Chocolate", "Space X", "Area 51", "Ferrari"]; //creamos un array con las palabras de nuestro ahorcado
const MAXPALABRAS = palabras.length; //recogemos la longitud de nuestro array para utilizar un número aleatorio (en este caso entre 0 y 3) para tener la posición de la palabra
let numRandom = Math.floor(Math.random() * MAXPALABRAS);
const VIDAS = 6;
let palabraArray = [];
let palabraOculta = [];
const letrasErroneas = new Set();
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");

const DOM = {
    palabraOculta: document.getElementById("palabra"),
    errores: document.getElementById("errores"),
    btnReiniciar: document.querySelector("button")
}

inicializarAhorcado();

function inicializarAhorcado() {
    DOM.btnReiniciar.addEventListener("click", () => {
        location.reload();
    });

    document.onkeyup = function (e) {
        comprobarLetra(e.key);

    }

    pintarAhorcado();
    crearArrayPalabraOculta();
    mostrarPalabraOculta();
    console.log(palabras[numRandom]);
}

//aquí pintaremos la forma del ahorcado en el canvas al inicializar la página
function pintarAhorcado() {
    ctx.moveTo(100, 500);
    ctx.lineTo(400, 500);
    ctx.lineWidth = 10;
    ctx.stroke();

    ctx.moveTo(100, 500);
    ctx.lineTo(100, 100);
    ctx.stroke();

    ctx.moveTo(100, 100);
    ctx.lineTo(300, 100);
    ctx.stroke();

    ctx.moveTo(300, 100);
    ctx.lineTo(300, 170);
    ctx.stroke();

    ctx.moveTo(100, 410);
    ctx.lineTo(200, 500);
    ctx.stroke();
}

//Pintará el array de la palabra oculta en pantalla
function mostrarPalabraOculta() {
    let palabraOcultaEnPantalla = "";
    for (let i = 0; i < palabraOculta.length; i++) {
        palabraOcultaEnPantalla += palabraOculta[i] + "&nbsp;";
    }
    DOM.palabraOculta.innerHTML = palabraOcultaEnPantalla;
}

//Pintará el array de los errores en pantalla
function mostrarErroresEnPantalla() {
    let erroresEnPantalla = "";
    letrasErroneas.forEach(letra => {
        erroresEnPantalla += letra + ", ";
    });
    DOM.errores.innerHTML = erroresEnPantalla;
}


//usamos un bucle for con el tamaño del número de caracteres dentro del string y los guardamos dentro de otro array donde separaremos las letras
function crearArrayPalabraOculta() {
    for (let i = 0; i < palabras[numRandom].length; i++) {
        palabraArray[i] = palabras[numRandom].charAt(i).toLowerCase();
        if (palabras[numRandom].charAt(i) !== " ") {
            palabraOculta[i] = "_";
        } else {
            palabraOculta[i] = " ";
        }
    }
}

//Nos llegará un parámetro de un caracter, recorremos el array de la palabra, si hay coincidencia cambia
//en esa misma posición una barrabaja con la letra que nos acaba de llevar en el array con las letras ocultadas
function comprobarLetra(letra) {
    let encontrada = false;
    for (let i = 0; i < palabraArray.length; i++) {
        if (letra.toLowerCase() == palabraArray[i]) {
            palabraOculta[i] = letra.toLowerCase();
            encontrada = true;
        }
    }

    if (!encontrada) {
        letrasErroneas.add(letra);
        mostrarErroresEnPantalla();
        dibujarMonigote();
    } else {
        mostrarPalabraOculta();
    }
    finJuego();
}

function dibujarMonigote() {
    switch (letrasErroneas.size) {
        case 1:
            //cabeza
            ctx.beginPath();
            ctx.arc(300, 210, 40, 0, 2 * Math.PI);
            ctx.stroke();
            break;
        case 2:
            //tronco
            ctx.moveTo(300, 250);
            ctx.lineTo(300, 400);
            ctx.stroke();
            break;
        case 3:
            //piernas
            ctx.moveTo(300, 400);
            ctx.lineTo(200, 470);
            ctx.stroke();
            break;
        case 4:
            ctx.moveTo(300, 400);
            ctx.lineTo(400, 470);
            ctx.stroke();
            break;
        case 5:
            //brazos
            ctx.moveTo(300, 250);
            ctx.lineTo(200, 270);
            ctx.stroke();
            break;
        case 6:
            ctx.moveTo(300, 250);
            ctx.lineTo(400, 270);
            ctx.stroke();
            break;
    }
}

//creamos una bandera que detecte si en el array de palabras ocultas no quedan ya barrabaja
//si encuentra una se pondrá a falso
//por otro lado calculamos el número de letras erroneas y lo comparamos con la cantidad de vidas
function finJuego() {
    let ganador = true;
    for (let i = 0; i < palabraOculta.length; i++) {
        if (palabraOculta[i] == "_") {
            ganador = false;
        }
    }

    if (ganador) {
        alert("¡Has ganado la partida! la palabra era: " + palabras[numRandom]);
        location.reload();
    }

    if (letrasErroneas.size >= VIDAS) {
        alert("Has perdido la partida, la palabra era: " + palabras[numRandom]);
        location.reload();
    }
}