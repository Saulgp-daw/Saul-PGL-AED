class Mascota {
    private id: number;
    private tipo: string;
    private raza: string;
    private imagen: string;

    constructor(id: number, tipo: string, raza: string, imagen: string = "") {
        this.id = id;
        this.tipo = tipo;
        this.raza = raza;
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
    getRaza() { return this.raza; }
    setRaza(raza: string) {
        this.raza = raza;
    }

    getImagen() { return this.imagen; }
    setImagen(imagen: string) {
        this.imagen = imagen;
    }



}