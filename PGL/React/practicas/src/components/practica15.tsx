import React, { useState } from 'react'
import PropTypes from 'prop-types'

type Props = {}

const Practica15 = (props: Props) => {

    const [claseColor, claseColorState] = useState("rojo");

    const cambiarColor = (colorEntrada: string) => {
        claseColorState(colorEntrada);
    }
    return (
        <>
            <h4>Botones y CSS</h4>
            <p className={claseColor}>Este área muestra los resultados de los botones</p>
            <button onClick={() => cambiarColor("verde")}>verde</button>
            <button onClick={() => cambiarColor("rojo")}>rojo</button>
            <button onClick={() => cambiarColor("azul")}>azul</button>
            <button onClick={() => cambiarColor("rosa")}>rosa</button>
        </>

    )
}

export default Practica15