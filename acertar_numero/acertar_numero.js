const DOM = {
    divsNumeros: document.querySelectorAll(".container > div:not(:nth-child(11))"),
    numPantalla: document.getElementById("numero"),
    btnComprobar: document.getElementById("comprobar"),
    cajaRespuesta: document.getElementById("respuesta")
}
const MAX = 9999;
let numRandom = Math.floor(Math.random() * MAX);

//recorremos todos nuestros divs de números para darles un event listener de click, cuando lo hagan a nuestra caja con id "numero" le juntamos el valor
DOM.divsNumeros.forEach(div => {
    div.addEventListener("click", ()=> {
        console.log(div.innerText);
        DOM.numPantalla.innerText += div.innerText;
    });
});

//añadimos un evento para que al hacer click recoja el número de la caja con id numero para comprobar si es mayor, menor o igual al número secreto generado con un aleatorio.
DOM.btnComprobar.addEventListener("click", () => {
    try {
        let texto = document.createElement("p");
        if(numRandom > parseInt(DOM.numPantalla.innerText)){
            texto.innerText = `El número ${DOM.numPantalla.innerText} es menor que el secreto`;
            DOM.cajaRespuesta.appendChild(texto);
        }else if(numRandom < parseInt(DOM.numPantalla.innerText)){
            texto.innerText = `El número ${DOM.numPantalla.innerText} es mayor que el secreto`;
            DOM.cajaRespuesta.appendChild(texto);
        }else if(numRandom == parseInt(DOM.numPantalla.innerText)){
            texto.innerText = `¡El número ${DOM.numPantalla.innerText} es el acertado, enhorabuena!`;
            DOM.cajaRespuesta.appendChild(texto);
            setTimeout(() => {
                location.reload();
            }, 5000);
        }
        DOM.numPantalla.innerText = "";
    } catch (error) {
        console.log(error);
    }
});
