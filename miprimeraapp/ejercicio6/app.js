const {escribir} = require("./utils/manejarFichero");
const {crearTabla} = require("./modelo/tabla");

escribir("tabla.txt", crearTabla(7))
    .then(console.log("ok grabado"))
    .catch(err => console.log(err));