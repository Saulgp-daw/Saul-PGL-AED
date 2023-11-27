import React, { useEffect, useState } from 'react'
import { usePartidaContext } from '../contexts/PartidaContextProvider';
import { Partida } from '../models/Partida';
import usePartida from './usePartida';

const useTablero = () => {
    const [valor, setValor] = useState(false);
    const [pintar, setPintar] = useState(true);
    const { partida, setpartida } = usePartidaContext();
    const { guardarPartidaJSON } = usePartida();

    // useEffect(() => {

    //     
    //         let filaRandom: number = 0;
    //         let columnaRandom: number = 0;
    //         console.log(tablero);

    //         do {
    //             filaRandom = Math.floor(Math.random() * 2);
    //             columnaRandom = Math.floor(Math.random() * 2);
    //         } while (tablero[filaRandom][columnaRandom] != "");


    //         agregarACelda(filaRandom, columnaRandom);

    //         console.log(filaRandom);
    //         console.log(columnaRandom);
    //     




    // }, [valor == true]);

    const [tablero, setTablero] = useState<string[][]>([
        ["", "", ""],
        ["", "", ""],
        ["", "", ""],
    ]);

    function agregarACelda(fila: number, columna: number) {
        if (pintar) {
            if (!tablero[fila][columna]) {
                const nuevoTablero = [...tablero];
                const nuevoValor: string = valor ? "X" : "O";
                setValor(!valor);
                nuevoTablero[fila][columna] = nuevoValor;
                setTablero(nuevoTablero);
                condicionEmpate(tablero);
                condicionVictoria(nuevoTablero);
            }
        }


    }



    function condicionVictoria(tablero: string[][]) {
        const valores: string[] = ["O", "X"];
        valores.forEach(valor => {
            for (let i: number = 0; i < 3; i++) {
                if (tablero[i][0] === valor && tablero[i][1] === valor && tablero[i][2] === valor) {
                    salvarPartida(valor);
                }
                if (tablero[0][i] === valor && tablero[1][i] === valor && tablero[2][i] === valor) {
                    salvarPartida(valor);
                }
            }
            //diagonal principal
            if (tablero[0][0] === valor && tablero[1][1] === valor && tablero[2][2] === valor) {
                salvarPartida(valor);
            }

            // diagonal secundaria
            if (tablero[0][2] === valor && tablero[1][1] === valor && tablero[2][0] === valor) {
                salvarPartida(valor);
            }
        });
    }

    function condicionEmpate(tablero: string[][]) {
        let empate: boolean = true;
        for (let i = 0; i < tablero.length; i++) {
            for (let j = 0; j < tablero.length; j++) {
                if (tablero[i][j] == "") {
                    empate = false;
                }
            }
        }
        console.log(empate);
        if (empate) {
            salvarPartida("", empate);
        }

    }

    function salvarPartida(valor: string = "", empate: boolean = false) {
        let nuevaPartida: Partida;
        if (empate) {
            nuevaPartida = new Partida(partida.getId(), partida.getJ1(), partida.getJ2(), tablero, "Empate");
        } else {
            nuevaPartida = new Partida(partida.getId(), partida.getJ1(), partida.getJ2(), tablero, descubrirGanador(valor));
        }
        setpartida(nuevaPartida);
        //console.log(nuevaPartida);
        setPintar(false);
        guardarPartidaJSON(nuevaPartida);
    }

    function descubrirGanador(valor: string): string {
        let ganador: string = "J2";
        if (valor === "O") {
            ganador = "J1";
        }

        return ganador;
    }

    const renderizarTabla = (tablero: string[][], width: number = 300, height: number = 300) => (
        <table border={1} style={{ width: `${width}px`, height: `${height}px` }}>
            {tablero.map((fila, indiceFila) => (
                <tr key={indiceFila}>
                    {fila.map((celda, indiceColumna) => (
                        <td style={{ width: `${width / 3}px`, height: `${height / 3}px` }} key={indiceColumna} onClick={() => agregarACelda(indiceFila, indiceColumna)}>{celda}</td>
                    ))}
                </tr>
            ))}
        </table>
    );
    return { valor, setValor, tablero, setTablero, agregarACelda, renderizarTabla }
}

export default useTablero