import React from 'react'
import { Link } from 'react-router-dom'

type Props = {}

function Navbar() {
    return (
        <nav className="Minavbar">
            <Link to="/"> Inicio </Link>
            <Link to="/cronometro"> Cronómetro </Link>
            <Link to="/relojesmundiales"> Relojes mundiales </Link>
            <Link to="/imc"> IMC </Link>
        </nav>
    )
}


export default Navbar