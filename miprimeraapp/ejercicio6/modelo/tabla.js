
function getTabla(tabla) {
    let limite = 10;
    let respuesta =
        `---------------------------
 TABLA DEL ${tabla}
---------------------------
`;
    for (let i = 1; i <= limite; i++) {
        respuesta += `${tabla} * ${i} = ${tabla * i} \n`;

    }
    return respuesta;
}
exports.crearTabla = getTabla;