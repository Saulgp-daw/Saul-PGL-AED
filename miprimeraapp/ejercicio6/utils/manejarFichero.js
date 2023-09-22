const fs = require("fs");

async function manejarFichero(nombre, info){
    fs.writeFileSync(
        nombre, //nombre del fichero
        info, //información a guardar
        (err) => { //callback respuesta al finalizar
            if (err)
                throw err;
            else
                console.log("se ha grabado");
        }
    );
}

exports.escribir = manejarFichero;
