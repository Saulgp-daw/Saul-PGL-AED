const {escribir} = require("./utils/manejarFichero");
const {crearTabla} = require("./modelo/tabla");


escribir("tabla.txt", crearTabla(process.argv[2]))
    .then(console.log("ok grabado"))
    .catch(err => console.log(err));