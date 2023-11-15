import React, { useState } from 'react'
import { Pelicula } from '../models/Pelicula'
import { useParams } from 'react-router-dom'
import { useLocation } from 'react-router-dom';
import useDetallePelicula from '../hooks/useDetallePelicula';
import ReactPlayer from 'react-player';
import useBorrarPelicula from '../hooks/useBorrarPelicula';
import useModificarPelicula from '../hooks/useModificarPelicula';

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

    function habilitarInputs() {
        setModificar(!modificar);
    }

    return (
        <div className='vistaDetalle'>
            {modificar ? (
                <div className='vistaDetalle'>
                    <h2>Modificar Película</h2>
                    <div>
                        <form onSubmit={modificarPelicula}>
                            <label htmlFor="idPelicula">Id: </label><input type="text" name='idPelicula' defaultValue={pelicula?.getId()} disabled/><br />
                            <label htmlFor="titulo">Título: </label><input type="text" name='titulo' defaultValue={pelicula?.getTitulo()}/><br />
                            <label htmlFor="direccion">Dirección: </label><input type="text" name='direccion' defaultValue={pelicula?.getDireccion()}/><br />
                            <label htmlFor="actores">Reparto: </label><input type="text" name='actores' defaultValue={pelicula?.getActores()}/><br />
                            <label htmlFor="argumento">Sinopsis: </label><textarea name="argumento" cols={30} rows={10} defaultValue={pelicula?.getArgumento()}></textarea><br />
                            <label htmlFor="imagen">Url imagen: </label><input type="text" name='imagen' defaultValue={pelicula?.getImagen()}/><br />
                            <label htmlFor="trailer">Trailer: </label><input type="text" name='trailer' defaultValue={pelicula?.getTrailer()}/><br />
                            <label htmlFor="categoria">Categoria: </label><input type="text" name='categoria' defaultValue={pelicula?.getCategoria()}/><br />
                            <button onClick={habilitarInputs}>Cancelar</button>
                            <button type='submit'>Actualizar</button>
                        </form>
                    </div>
                </div>
            ) : (
                <div className='vistaDetalle'>
                    <h2>Detalles Película</h2>
                    <div>
                        <img src={uri + pelicula?.getImagen()} alt={pelicula?.getTitulo()} />
                    </div>
                    <div>
                        <h5>{pelicula?.getTitulo()}</h5><br />
                        <ReactPlayer
                            url={pelicula?.getTrailer()}
                            controls
                        />
                        <span>Dirección: {pelicula?.getDireccion()}</span><br />
                        <span>Reparto: {pelicula?.getActores()}</span><br />
                        <span>Categoría: {pelicula?.getCategoria()}</span><br />
                        <span>Sinópsis: {pelicula?.getArgumento()}</span><br />
                        <button onClick={borrarPelicula}>Borrar</button>
                        <button onClick={habilitarInputs}>Modificar</button>
                    </div>
                </div>
            )}



        </div>
    )
}

export default PeliculaCard