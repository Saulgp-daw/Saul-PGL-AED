import React from 'react'
import { Link } from 'react-router-dom';

type Props = {}

const Navbar = (props: Props) => {
  return (
    <div className='navbar'>
        <h3>Gestor de Partidas</h3>
        <Link to="/jugar">Jugar </Link> 
        <Link to="/historial">Historial</Link> 
    </div>
  )
}

export default Navbar