import React from 'react'
import { Link } from 'react-router-dom'

type Props = {}

function NavbarEjemplos() {
    return (
        <nav className="Minavbar">
            <Link to="/pokemon/303"> Pokemon ejemplo </Link>
            <Link to="/capital/3"> Capital Ejemplo </Link>
            
        </nav>
    )
}


export default NavbarEjemplos