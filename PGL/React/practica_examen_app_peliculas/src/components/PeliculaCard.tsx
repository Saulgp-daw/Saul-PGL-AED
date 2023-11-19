import React, { useState } from 'react'
import { Pelicula } from '../models/Pelicula'
import { useParams } from 'react-router-dom'
import { useLocation } from 'react-router-dom';
import useDetallePelicula from '../hooks/useDetallePelicula';
import ReactPlayer from 'react-player';
import useBorrarPelicula from '../hooks/useBorrarPelicula';
import useModificarPelicula from '../hooks/useModificarPelicula';
import useObtenerCategorias from '../hooks/useObtenerCategorias';
//css
import "../styles/peliculacard.css"


type Props = {
}

interface iPelicula {
    id: string,
    titulo: string,
    direccion: string,
    actores: string,
    argumento: string,
    imagen: string,
    trailer: string,
    categoria: string
}


const PeliculaCard = (props: Props) => {
    const uri: string = "http://localhost:3000/";
    const { id } = useParams();
    const { pelicula } = useDetallePelicula(id);
    const { borrarPelicula } = useBorrarPelicula(id);
    const { modificarPelicula } = useModificarPelicula();
    const [modificar, setModificar] = useState(false);
    const { categorias } = useObtenerCategorias();

    function habilitarInputs() {
        setModificar(!modificar);
    }

    return (
        <div className='vistaDetalle'>
            {modificar ? (
                <div>
                    <h2>Modificar Película</h2>
                    <div>
                        <form onSubmit={modificarPelicula}>
                            <label htmlFor="idPelicula">Id: </label><input type="text" name='idPelicula' defaultValue={pelicula?.getId()} disabled /><br />
                            <label htmlFor="titulo">Título: </label><input type="text" name='titulo' defaultValue={pelicula?.getTitulo()} /><br />
                            <label htmlFor="direccion">Dirección: </label><input type="text" name='direccion' defaultValue={pelicula?.getDireccion()} /><br />
                            <label htmlFor="actores">Reparto: </label><input type="text" name='actores' defaultValue={pelicula?.getActores()} /><br />
                            <label htmlFor="argumento">Sinopsis: </label><textarea name="argumento" cols={30} rows={10} defaultValue={pelicula?.getArgumento()}></textarea><br />
                            <label htmlFor="imagen">Url imagen: </label><input type="text" name='imagen' defaultValue={pelicula?.getImagen()} /><br />
                            <label htmlFor="trailer">Trailer: </label><input type="text" name='trailer' defaultValue={pelicula?.getTrailer()} /><br />
                            <label htmlFor="categoria">Categoria: </label>
                            <select name="categoria">
                                {
                                    categorias.map(categoria => (
                                        <option value={categoria.id} selected={categoria.nombre === pelicula?.getCategoria()}>{categoria.nombre}</option>
                                    ))
                                }
                            </select>
                            <br />
                            <button onClick={habilitarInputs}>Cancelar</button>
                            <button type='submit'>Actualizar</button>
                        </form>
                    </div>
                </div>
            ) : (
                <div>
                    <h2>Detalles Película</h2>
                    <div>
                        <img src={uri + pelicula?.getImagen()} alt={pelicula?.getTitulo()} />
                    </div>
                    <div>
                        <h4><span className="tipo">{pelicula?.getTitulo()}</span></h4><br />
                        <ReactPlayer
                            url={pelicula?.getTrailer()}
                            controls
                        />
                        <span><span className="tipo">Dirección:</span> {pelicula?.getDireccion()}</span><br />
                        <span><span className="tipo">Reparto: </span>{pelicula?.getActores()}</span><br />
                        <span><span className="tipo">Categoría:</span> {pelicula?.getCategoria()}</span><br />
                        <span><span className="tipo">Sinópsis:</span> {pelicula?.getArgumento()}</span><br />
                        <button onClick={borrarPelicula}>Borrar</button>
                        <button onClick={habilitarInputs}>Modificar</button>
                    </div>
                </div>
            )}



        </div>
    )
}

export default PeliculaCard