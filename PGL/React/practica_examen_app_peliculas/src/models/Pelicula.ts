import { Categoria } from "./Categoria";

class Pelicula {
  private id: string;
  private titulo: string;
  private direccion: string;
  private actores: string;
  private argumento: string;
  private imagen: string;
  private trailer: string;
  private categoria: Categoria[];

  constructor(
    id: string,
    titulo: string,
    direccion: string,
    actores: string,
    argumento: string,
    imagen: string,
    trailer: string,
    categoria: Categoria[]
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

  getCategoria(): Categoria[] {
    return this.categoria;
  }

  setCategoria(categoria: Categoria[]) {
    this.categoria = categoria;
  }

  getCategoriasComoString(): string {
    //const categoriasStringArray = (this.getCategoria() as Categoria[]).map(c => c.getNombre());
    const categoriasStringArray = this.getCategoria().map(c => c.nombre);

    // // Utiliza join para unir los nombres de categorías en una cadena
    const categoriasComoString = categoriasStringArray.join(', ');

    return categoriasComoString;
  }
}

export { Pelicula }