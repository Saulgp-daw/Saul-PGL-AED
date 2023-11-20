class Tarea {
    private id: number;
    private titulo: string;
    private contenido: string;
    private completado: boolean;

    constructor(
        id: number,
        titulo: string = "",
        contenido: string = "",
        completado: boolean = false) {
        this.id = id;
        this.titulo = titulo;
        this.contenido = contenido;
        this.completado = completado;
    }

    getId = (): number => {
        return this.id;
    }
    setId(id: number) {
        this.id = id;
    }
    getTitulo(): string {
        return this.titulo;
    }
    setTitulo(titulo: string) {
        this.titulo = titulo;
    }
    getContenido(): string {
        return this.contenido;
    }
    setContenido(contenido: string) {
        this.contenido = contenido;
    }
    getCompletado(): boolean {
        return this.completado;
    }
    setCompletado(completado: boolean) {
        this.completado = completado;
    }
}

export { Tarea }