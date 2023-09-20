const DOM = {
    inputTabla: document.getElementById("numTabla"),
    elementoDivResultado: document.querySelector(".resultado");

}



let elementoDivResultado = document.querySelector(".resultado");

let boton = document.getElementById("miBoton");


boton.addEventListener("click", function () {
    let num = document.getElementById("numTabla");
    for (let i = 1; i < 11; i++) {
        let br = document.createElement("br");
        let p = document.createElement("p");
        p.innertext = num + " x " + i + " = " + (num * i);
        elementoDivResultado.appendChild(p);
        elementoDivResultado.appendChild(br);
    }
});
