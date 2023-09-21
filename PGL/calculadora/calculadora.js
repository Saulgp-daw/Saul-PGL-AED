const DOM = {
    num1: document.getElementById("numero1"),
    num2: document.getElementById("numero2"),
    btnCalcular: document.querySelector("button"),
    selectOperador: document.getElementById("operadores"),
    textAreaResultado: document.getElementById("resultado")
}
//preguntar por qué el DOM previene mostrar/recoger los elementos del value


DOM.btnCalcular.addEventListener("click", ()=> {
    let resultado = 0;
    let num1 = parseInt(DOM.num1.value);
    let num2 = parseInt(DOM.num2.value);
    switch(DOM.selectOperador.value){
        case "+":
            resultado = num1 + num2;
            DOM.textAreaResultado.innerText = `El resultado es: ${resultado}`;
            break;
        case "-":
            resultado = num1 - num2;
            DOM.textAreaResultado.innerText = `El resultado es: ${resultado}`;
            break;
        case "*":
            resultado = num1 * num2;
            DOM.textAreaResultado.innerText = `El resultado es: ${resultado}`;
            break;
        case "/":
            resultado = num1 / num2;
            DOM.textAreaResultado.innerText = `El resultado es: ${resultado}`;
            break;
        default: 
            console.log("valor equivocado");
    }

});