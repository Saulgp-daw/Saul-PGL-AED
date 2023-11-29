class Raza {
    private id: number;
    private tipo: string;
    private nombre: string;
    private imagen: string;

    constructor(id: number, tipo: string, nombre: string, imagen: string = "") {
        this.id = id;
        this.tipo = tipo;
        this.nombre = nombre;
        this.imagen = imagen;
    }

    getId() { return this.id; }
    setId(id: number) {
        this.id = id;
    }

    getTipo() { return this.tipo; }
    setTipo(tipo: string) {
        this.tipo = tipo;
    }
    getNombre() { return this.nombre; }
    setNombre(raza: string) {
        this.nombre = raza;
    }

    getImagen() { return this.imagen; }
    setImagen(imagen: string) {
        this.imagen = imagen;
    }
}

export { Raza }