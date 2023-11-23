class Partida {
    private id: number;
    private J1: string;
    private J2: string;
    private tablero: string[][];
    private ganador: string;

    constructor(id: number, J1: string, J2: string, tablero: string[][], ganador = "") {
        this.id = id;
        this.J1 = J1;
        this.J2 = J2;
        this.tablero = tablero;
        this.ganador = ganador;
    }

    public getId = (): number => {
        return this.id;
    }

    public setId(id: number): void {
        this.id = id;
    }

    public getJ1 = (): string => {
        return this.J1;
    }

    public setJ1(J1: string): void {
        this.J1 = J1;
    }

    public getJ2 = (): string => {
        return this.J2;
    }

    public setJ2(J2: string): void {
        this.J2 = J2;
    }

    public getTablero = (): string[][]=> {
        return this.tablero;
    }

    public setTablero(tablero: string[][]): void {
        this.tablero = tablero;
    }

    public getGanador = (): string => {
        return this.ganador;
    }

    public setGanador(ganador: string): void {
        this.ganador = ganador;
    }


}

export { Partida }