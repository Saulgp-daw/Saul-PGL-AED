class Categoria {
    private id: number;
    private nombre: string;

    constructor(id: number, nombre: string) {
        this.id = id;
        this.nombre = nombre;
    }

    getId(): number {
        return this.id;
    }

    getNombre(): string {
        return this.nombre;
    }
}

export { Categoria }