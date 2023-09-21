const DOM = {
    cartas: document.querySelectorAll(".carta")
}

DOM.cartas.forEach(carta => {
    carta.addEventListener("click", cambiarClase);
});

function cambiarClase(e){
    console.log(e.target.classList);
    e.target.classList.add("cara");

}