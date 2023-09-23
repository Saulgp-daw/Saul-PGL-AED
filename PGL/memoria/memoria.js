import { duplaCartas } from "./variablesGlobales.js";

const DOM = {
    tablero: document.getElementsByClassName("tablero")[0]
}

iniciarJuego(3);

function iniciarJuego(dimensiones){
    let numCasillas = dimensiones * dimensiones;
    let intentos = numCasillas + parseInt(numCasillas / 2);
    console.log("Casillas: "+numCasillas+" intentos: "+intentos);
    DOM.tablero.style.gridTemplateColumns = `repeat(${dimensiones}, 5em)`;
    DOM.tablero.style.gridTemplateRows  = `repeat(${dimensiones}, 5em)`;
    dibujarCasillas(numCasillas);
}

function dibujarCasillas(numCasillas){
    let arrayParejas = generarArrayAleatorios(numCasillas);
    console.log(arrayParejas);

    for(let i = 0; i < arrayParejas.length; i++){
        let divCarta = document.createElement("div");
        divCarta.classList.add("carta");

        DOM.tablero.appendChild(divCarta);

        let divCruz = document.createElement("div");
        divCruz.classList.add("cruz");
        divCruz.innerText = arrayParejas[i];
        divCarta.appendChild(divCruz);
    }

    DOM.cartas = document.querySelectorAll(".cruz");
}

function generarArrayAleatorios(numCasillas){
    let arrayAleatorios = [];
    for(let i = 0; i < Math.floor(numCasillas / 2); i++){
        const numAleatorio = Math.floor(Math.random() * 100);
        arrayAleatorios.push(numAleatorio);
        arrayAleatorios.push(numAleatorio);
    }
    if(numCasillas % 2 != 0){
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


DOM.cartas.forEach(carta => {
    carta.addEventListener("click", girarCartaClickada);

    carta.addEventListener("click", (e) => {
        compararCartas(e, DOM.cartas);
    });
});

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
function compararCartas(e, cartas) {

    let pos = Array.from(cartas).indexOf(e.target); 
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

    await esperar(2000); // Esperar 2000 milisegundos (2 segundos)

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
        } else {
            cartasVistas.add(valor);
        }
    }

    return coinciden;
}


