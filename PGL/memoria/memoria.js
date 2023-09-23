import { duplaCartas } from "./variablesGlobales.js";

const DOM = {
    cartas: document.querySelectorAll(".cruz")
}

DOM.cartas.forEach(carta => {
    carta.addEventListener("click", cambiarClase);

    carta.addEventListener("click", (e) => {
        compararCartas(e, DOM.cartas);
    });
});

function cambiarClase(e) {
    //console.log(e.target.classList);
    e.target.classList.add("cara");
    //console.log(e.target.innerText);

}

function compararCartas(e, cartas) {

    let pos = Array.from(cartas).indexOf(e.target);
    //console.log(e.target);
    //console.log(pos);
    //duplaCartas.push(e.target.innerText);
    duplaCartas[pos] = e.target.innerText;
    const longitud = Object.keys(duplaCartas).length;


    //duplaCartas.length === 2? console.log(duplaCartas[0] == duplaCartas[1] ? "Son iguales" : duplaCartas.length = 0) : null;
    if (longitud == 2) {
        let coincidenCartas = obtenerCoincidencia();

        if (coincidenCartas) {
            console.log("Son iguales");
            

        } else {
            console.log("Son diferentes");
        }

        for (const clave in duplaCartas) {
            if (duplaCartas.hasOwnProperty(clave)) {
                delete duplaCartas[clave];
            }
        }


    }

    console.log(duplaCartas);
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


