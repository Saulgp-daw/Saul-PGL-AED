export let duplaCartas = {};
export { devolverIntentos };

function devolverIntentos(numCasillas){
    return numCasillas + parseInt(numCasillas / 2);
}