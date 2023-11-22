import React, { useState } from 'react'

type Props = {}

const Tablero: React.FC<Props> = () => {
    const elementos: string[] = ["O", "X", "O", "X", "O", "X", "O", "X", "O"];
    const [tablero, setTablero] = useState<string[][]>([
        ["", "", ""],
        ["", "", ""],
        ["", "", ""],
    ]);

    const renderizarTabla = () => (
        <table border={1} style={{ width: '300px', height: '300px' }}>
            {tablero.map((fila, indiceFila) => (
                <tr key={indiceFila}>
                    {fila.map((celda, indiceColumna) => (
                        <td key={indiceColumna}>{celda}</td>
                    ))}
                </tr>
            ))}
        </table>
    );

    return (
        <div>
            <h3>Tablero</h3>
            {renderizarTabla()}
        </div>
    )
}

export default Tablero