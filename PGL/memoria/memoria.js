import { duplaCartas } from "./variablesGlobales.js";
import { devolverIntentos } from "./variablesGlobales.js";
import { intervalo } from "./variablesGlobales.js";
let intentos = 0;
let dimensiones = 3;

const DOM = {
    tablero: document.getElementsByClassName("tablero")[0],
    spanIntentosRestantes: document.getElementById("intentos")
}

iniciarJuego(dimensiones);

/**
 * Aquí recibiremos las dimensiones de la matriz, es decir su dificultad
 * calculamos el número de casillas con una multiplicación
 * calculamos los intentos teniendo en cuenta el número total de casillas y sumándole la mitad de las mismas para
 * hacerlo más "justo" en dimensiones grandes
 * @param {*} dimensiones el tamaño de nuestra matriz
 */
function iniciarJuego(dimensiones) {
    DOM.tablero.innerHTML = "";
    let numCasillas = dimensiones * dimensiones;
    intentos = devolverIntentos(numCasillas);
    console.log("Casillas: " + numCasillas + " intentos: " + intentos);
    DOM.tablero.style.gridTemplateColumns = `repeat(${dimensiones}, 5em)`;
    DOM.tablero.style.gridTemplateRows = `repeat(${dimensiones}, 5em)`;
    dibujarCasillas(numCasillas);
    darEventosACartas();
}

/**
 * Aquí crearemos los elementos dinámicamente dependiendo del número de casillas que nos manden
 * haremos uso de createElement y appendChild para insertarlos dentro de nuestra clase tablero
 * @param {*} numCasillas nuestro número de casillas que se mostrarán en el DOM
 */
function dibujarCasillas(numCasillas) {
    let arrayParejas = generarArrayAleatorios(numCasillas);

    for (let i = 0; i < arrayParejas.length; i++) {
        let divCarta = document.createElement("div");
        divCarta.classList.add("carta");

        DOM.tablero.appendChild(divCarta);

        let divCruz = document.createElement("div");
        divCruz.classList.add("cruz");
        divCruz.innerText = arrayParejas[i];
        divCarta.appendChild(divCruz);
    }

    DOM.cartas = document.querySelectorAll(".cruz"); //lo añadimos al objeto DOM DESPUÉS de haberlas generado porque de lo contrario los eventlistener no lo encontrarán
    DOM.spanIntentosRestantes.innerText = intentos;
}

/**
 * Crearemos un array de aleatorios y luego lo devolveremos para luego trabajar con él
 * @param {*} numCasillas nuestro número de casillas que se mostrarán en el DOM
 * @returns 
 */
function generarArrayAleatorios(numCasillas) {
    let arrayAleatorios = [];
    for (let i = 0; i < Math.floor(numCasillas / 2); i++) {
        const numAleatorio = Math.floor(Math.random() * 100);
        if (arrayAleatorios.includes(numAleatorio)) {
            i--;
        } else {
            arrayAleatorios.push(numAleatorio);
            arrayAleatorios.push(numAleatorio);
        }

    }
    if (numCasillas % 2 != 0) {
        arrayAleatorios.push("🃏");
    }

    console.log(arrayAleatorios);
    arrayAleatorios = mezclarArray(arrayAleatorios);

    return arrayAleatorios;
}

function mezclarArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        // Generar un índice aleatorio entre 0 y i
        const j = Math.floor(Math.random() * (i + 1));

        // Intercambiar elementos array[i] y array[j]
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function darEventosACartas() {
    DOM.cartas.forEach(carta => {
        carta.addEventListener("click", girarCartaClickada);

        /*carta.addEventListener("click", (e) => {
            compararCartas(e, DOM.cartas);
        });*/

        carta.addEventListener("click", compararCartas);
    });
}

function bloquearEventosCartas() {
    DOM.cartas.forEach(carta => {
        carta.removeEventListener('click', girarCartaClickada);
        carta.removeEventListener("click", compararCartas);
    });
}




function girarCartaClickada(e) {
    e.target.classList.add("cara");
}

/**
 * En esta función recogeremos todos los div del DOM para crear un array y obtener tanto su posición como su valor
 * una vez los tengamos los añadiremos a nuestra dupla y calcularemos su longitud de valores, si es mayor que dos sabremos 
 * que tenemos una pareja de dos ya clickada y haremos las comprobaciones
 * @param {*} e evento
 * @param {*} cartas los elementos del DOM
 */
function compararCartas(e) {

    let pos = Array.from(DOM.cartas).indexOf(e.target);
    duplaCartas[pos] = e.target.innerText;

    const longitud = Object.keys(duplaCartas).length;

    if (longitud == 2) {
        let coincidenCartas = obtenerCoincidencia();
        coincidenCartas ? limpiarDupla() : quitarClaseDespuesDeEsperar();

        /* if (coincidenCartas) {
             console.log("Son iguales");
             limpiarDupla();
 
         } else {
             console.log("Son diferentes");
             quitarClaseDespuesDeEsperar();
         }*/
    }

    console.log(duplaCartas);
}

// Función para esperar un período de tiempo
function esperar(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Función asincrónica para quitar la clase después de un período de tiempo
async function quitarClaseDespuesDeEsperar() {

    await esperar(1000); // Esperar 2000 milisegundos (2 segundos)

    for (const clave in duplaCartas) {
        console.log("pos: " + clave + " valor: " + duplaCartas[clave]);
        DOM.cartas[clave].classList.remove("cara");
    }

    limpiarDupla();
}

/**
 * Aquí es donde borraremos los elementos dentro de la dupla para futuras comparaciones
 * no interesa nunca tener más de dos dentro de nuestro objeto
 */
function limpiarDupla() {
    for (const clave in duplaCartas) {
        if (duplaCartas.hasOwnProperty(clave)) {
            delete duplaCartas[clave];
        }
    }
}

/**
 * En duplaCartas tenemos clave y valor que desconocemos, por lo tanto recorreremos el objeto, recogemos su valor y 
 * lo añadiremos a un set, en este set preguntaremos si dicho valor se encuentra ya en él, si no, lo añade
 * @returns bool
 */
function obtenerCoincidencia() {
    const cartasVistas = new Set();
    let coinciden = false;
    for (const clave in duplaCartas) {
        const valor = duplaCartas[clave];

        if (cartasVistas.has(valor)) {
            coinciden = true;
            comprobarResultado();
        } else {
            cartasVistas.add(valor);
            restarIntentos();
        }
    }
    console.log("Intentos: " + intentos);
    return coinciden;
}

function restarIntentos() {
    if (intentos > 0) {
        intentos--;
        DOM.spanIntentosRestantes.innerText = intentos;
    } else {
        //alert("Has perdido, reiniciando juego...");
        bloquearEventosCartas();
        revelarElementosSecuencialmente();

    }
}

// Función para revelar un elemento
function revelarElemento(elemento) {
    elemento.classList.add('revelada');
}

// Función para mostrar el alert después de revelar todos los elementos
function mostrarAlert() {
    alert('Has perdido, más suerte la próxima vez');
    location.reload();
}

// Itera a través de los elementos con un intervalo de tiempo
//const intervalo = 500; // La hice una variable global
let indice = 0;

function revelarElementosSecuencialmente() {
    console.log(DOM.cartas);
    if (indice < DOM.cartas.length) {
        revelarElemento(DOM.cartas[indice]);
        indice++;
        setTimeout(revelarElementosSecuencialmente, intervalo);
    } else {
        mostrarAlert();
    }
}

/**
 * Aquí hacemos conteo con la cantidad de cartas que tienen cara, dependiendo de si es par o impar y el número de cartas cruz aún en la 
 * mesa sabremos si se ha conseguido superar el juego
 */
function comprobarResultado() {
    let cartasConCruz = 0;
    DOM.cartas.forEach(carta => {
        if (!carta.classList.contains('cara')) {
            cartasConCruz++;
        }
    });

    if (DOM.cartas.length % 2 == 0 && cartasConCruz == 0 || DOM.cartas.length % 2 != 0 && cartasConCruz == 1) {
        alert("Has ganado el juego, enhorabuena");
        iniciarJuego(++dimensiones);
    }

}


