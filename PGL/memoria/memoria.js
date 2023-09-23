import { duplaCartas } from "./variablesGlobales.js";

const DOM = {
    cartas: document.querySelectorAll(".cruz")
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

function compararCartas(e, cartas) {

    let pos = Array.from(cartas).indexOf(e.target);
    //console.log(e.target);
    //console.log(pos);
    //duplaCartas.push(e.target.innerText);
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


