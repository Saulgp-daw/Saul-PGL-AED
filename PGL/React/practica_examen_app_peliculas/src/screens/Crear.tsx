import React from 'react'
import usePelicula from '../hooks/usePelicula'
import useObtenerCategorias, { iCategoria } from '../hooks/useObtenerCategorias';

//css
import "../styles/crear.css"
import { Categoria } from '../models/Categoria';

type Props = {}

const Crear = (props: Props) => {
	const { agregarPelicula, agregarQuitarCategoria, setnombrefichero, setphotoBase64 } = usePelicula();
	const { categorias } = useObtenerCategorias();



	return (
		<div className='vistaDetalle'>
			<h3>Añadir Pelicula</h3>
			<form onSubmit={agregarPelicula}>
				<label htmlFor="titulo">Titulo: </label><input type="text" name='titulo' required /><br />
				<label htmlFor="direccion">Dirección: </label><input type="text" name='direccion' required /><br />
				<label htmlFor="actores">Actores: </label><input type="text" name='actores' required /><br />
				<label htmlFor="argumento">Argumento: </label><input type="text" name='argumento' required /><br />
				<label htmlFor="trailer">Trailer: </label><input type="text" name='trailer' /><br />
				<label htmlFor="categoria">Categorias: </label>

				{categorias.map(categoria => (
					<div key={categoria.id}>
						<input
							type="checkbox"
							id={`categoria-${categoria.id}`}
							name="categoriasSeleccionadas"
							value={`${categoria.id}|${categoria.nombre}`}
							onChange={() => agregarQuitarCategoria(new Categoria(categoria.id, categoria.nombre))}
						/>
						<label htmlFor={`categoria-${categoria.id}`}>{categoria.nombre}</label>
					</div>
				))}

				<div>
					<label htmlFor="photo">Photo:</label>
					<input
						type="file"
						id="photo"
						onChange={(event) => {
							if (event.currentTarget.files) {
								const file = event.currentTarget.files[0];
								const fileReader = new FileReader();
								fileReader.readAsDataURL(file);
								fileReader.onload = () => {
									setnombrefichero(file.name);
									setphotoBase64(fileReader.result as string);
								};
							}
						}}
					/>
				</div>



				<br />
				<button type='submit'>Añadir</button>
			</form>
		</div>
	)
}

export default Crear