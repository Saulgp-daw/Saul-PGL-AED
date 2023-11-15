import React from 'react'
import "../styles/navbar.css";
import { Link } from 'react-router-dom';

type Props = {}

const Navbar = (props: Props) => {
  return (
    <div className='navbar'>
        <h3>Gestor de Películas</h3>
        <Link to="/mostrar">Mostrar Películas</Link> 
        <Link to="/crear_pelicula">Crear Película</Link> 
        <Link to="/categorias">Categorias</Link> 
    </div>
  )
}

export default Navbar