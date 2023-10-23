class Persona {
    public id: number;
    public nombre: string;
    public apellido: string;
    public altura: number;
    public edad: number;
    public peso: number;
    public imc: number;

    constructor(id: number = 0, nombre: string = "", apellido: string = "", altura: number = 0, edad: number = 0, peso: number = 0, imc: number = 0) {
        this.id = id;
        this.nombre = nombre;
        this.apellido = apellido;
        this.altura = altura;
        this.edad = edad;
        this.peso = peso;
        this.imc = imc;
    }

    public getId(): number {
        return this.id;
    }

    public getNombre(): string {
        return this.nombre;
    }

    public getApellido(): string {
        return this.apellido;
    }

    public getAltura(): number {
        return this.altura;
    }

    public getEdad(): number {
        return this.edad;
    }

    public getPeso(): number {
        return this.peso;
    }

    public getImc(): number {
        return this.imc;
    }

    public setNombre(nombre: string): void {
        this.nombre = nombre;
    }

    public setApellido(apellido: string): void {
        this.apellido = apellido;
    }

    public setAltura(altura: number): void {
        this.altura = altura;
    }

    public setEdad(edad: number): void {
        this.edad = edad;
    }

    public setPeso(peso: number): void {
        this.peso = peso;
    }

    private setImc(imc: number): void {
        this.imc = imc;
    }

    public calcularIMC(): void {
        let imc = this.peso / (this.altura * this.altura);
        this.setImc(imc);
    }


}

export { Persona }