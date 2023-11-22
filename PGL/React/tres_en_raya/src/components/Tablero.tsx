import React, { useEffect, useState } from 'react'
import useTablero from '../hooks/useTablero';

type Props = {}

const Tablero: React.FC<Props> = () => {
    const { renderizarTabla } = useTablero();



    return (
        <div>
            <h3>Tablero</h3>
            {renderizarTabla()}
        </div>
    )
}

export default Tablero