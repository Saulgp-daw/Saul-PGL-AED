export let duplaCartas = {};
export { devolverIntentos };
export const intervalo = 500;
export let dimensiones = 3;
export const totalNumerosAleatorios = 100;

function devolverIntentos(numCasillas){
    return numCasillas + parseInt(numCasillas / 2);
}