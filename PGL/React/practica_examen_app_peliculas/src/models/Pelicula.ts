class Pelicula {
    private id: string;
    private titulo: string;
    private direccion: string;
    private actores: string;
    private argumento: string;
    private imagen: string;
    private trailer: string;
    private categoria: string;
  
    constructor(
      id: string,
      titulo: string,
      direccion: string,
      actores: string,
      argumento: string,
      imagen: string,
      trailer: string,
      categoria: string
    ) {
      this.id = id;
      this.titulo = titulo;
      this.direccion = direccion;
      this.actores = actores;
      this.argumento = argumento;
      this.imagen = imagen;
      this.trailer = trailer;
      this.categoria = categoria;
    }
  
    getId = (): string => {
      return this.id;
    }
  
    setId(id: string) {
      this.id = id;
    }
  
    getTitulo(): string {
      return this.titulo;
    }
  
    setTitulo(titulo: string) {
      this.titulo = titulo;
    }
  
    getDireccion(): string {
      return this.direccion;
    }
  
    setDireccion(direccion: string) {
      this.direccion = direccion;
    }
  
    getActores(): string {
      return this.actores;
    }
  
    setActores(actores: string) {
      this.actores = actores;
    }
  
    getArgumento(): string {
      return this.argumento;
    }
  
    setArgumento(argumento: string) {
      this.argumento = argumento;
    }
  
    getImagen(): string {
      return this.imagen;
    }
  
    seImagen(imagen: string) {
      this.imagen = imagen;
    }
  
    getTrailer(): string {
      return this.trailer;
    }
  
    setTrailer(trailer: string) {
      this.trailer = trailer;
    }
  
    getCategoria(): string {
      return this.categoria;
    }
  
    setCategoria(categoria: string) {
      this.categoria = categoria;
    }
  }

  export { Pelicula }