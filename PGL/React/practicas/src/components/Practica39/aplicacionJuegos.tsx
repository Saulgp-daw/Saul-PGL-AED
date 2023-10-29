import React from 'react'
import { Link } from 'react-router-dom'

type Props = {}

function AplicacionJuegos() {
    return (
        <nav className="Minavbar">
            <Link to="/chimp_test"> Chimp test </Link>
            <Link to="/acertar_numero"> Acertar número </Link>
        </nav>
    )
}


export default AplicacionJuegos