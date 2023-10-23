class Partida{
    private arrayNumeros: Array<number>;
    private arrayOrdenados: Array<number>;
    private segundosVisible: number;
    private cantidadNumeros: number;

    constructor(segundosVisible: number = 10, cantidadNumeros: number = 8){
        this.arrayNumeros = this.generarNumerosAleatorios(cantidadNumeros);
        this.arrayOrdenados = [];
        this.segundosVisible = segundosVisible;
        this.cantidadNumeros = cantidadNumeros;
    }

    public generarNumerosAleatorios(cantidadNumeros: number): Array<number> {
        const numAleatorios: Array<number> = [];
        for (let i = 0; i < this.getCantidadNumeros();) {
            const numeroAleatorio = Math.floor(Math.random() * cantidadNumeros) + 1;
            if (!numAleatorios.includes(numeroAleatorio)) {
                numAleatorios.push(numeroAleatorio);
                i++;
            }
        }
        return numAleatorios;
    }

    public getArrayNumeros():Array<number>{
        return this.arrayNumeros;
    } 

    public getArrayOrdenados():Array<number>{
        return this.arrayOrdenados;
    } 

    public setArrayOrdenados(array: Array<number>){
        this.arrayOrdenados = array;
    }

    public getSegundosVisible(): number{
        return this.segundosVisible;
    }

    public getCantidadNumeros(): number{
        return this.cantidadNumeros;
    }
}

export { Partida }