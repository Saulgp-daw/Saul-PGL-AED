function getTabla(tabla){
    let limite = 10;
    let respuesta = "";
    for (let i = 1; 1 < limite; i++) {
        respuesta += `${tabla} * ${i} = ${tabla * i}\n`;
    }
    return respuesta;
}

console.log(getTabla(4)); 