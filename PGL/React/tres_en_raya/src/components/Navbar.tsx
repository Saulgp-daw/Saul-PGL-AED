import React from 'react'
import { Link } from 'react-router-dom';
import "../styles/navbar.css";

type Props = {}

const Navbar = (props: Props) => {
  return (
    <div className='navbar'>
      <h3>Tres en raya</h3>
      <Link to="/jugar">Jugar </Link>
      <Link to="/historial">Historial</Link>
    </div>
  )
}

export default Navbar