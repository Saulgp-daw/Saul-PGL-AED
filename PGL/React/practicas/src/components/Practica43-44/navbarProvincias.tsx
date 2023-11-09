import React from 'react'
import { Link } from 'react-router-dom'
type Props = {}

function NavbarProvincias() {
    return (
        <nav className="Minavbar">
            <Link to="/crear_capital"> Crear </Link>
            <Link to="/borrar_capital"> Borrar </Link>
            <Link to="/modificar_capital"> Modificar </Link>
        </nav>
    )
}


export default NavbarProvincias