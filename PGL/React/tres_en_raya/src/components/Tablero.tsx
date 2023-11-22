import React, { useEffect, useState } from 'react'

type Props = {}

const Tablero: React.FC<Props> = () => {
    const [valor, setValor] = useState(false);

    const [tablero, setTablero] = useState<string[][]>([
        ["", "", ""],
        ["", "", ""],
        ["", "", ""],
    ]);

    function agregarACelda(fila: number, columna: number) {
        if (!tablero[fila][columna]) {
            const nuevoTablero = [...tablero];
            const nuevoValor: string = valor ? "X" : "O";
            setValor(!valor);
            nuevoTablero[fila][columna] = nuevoValor;
            setTablero(nuevoTablero);

        }
    }

    const renderizarTabla = () => (
        <table border={1} style={{ width: '300px', height: '300px' }}>
            {tablero.map((fila, indiceFila) => (
                <tr key={indiceFila}>
                    {fila.map((celda, indiceColumna) => (
                        <td key={indiceColumna} onClick={() => agregarACelda(indiceFila, indiceColumna)}>{celda}</td>
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