import React, { useState } from 'react'

type Props = {}
type Moneda = {
    nombre: string,
    pais: string
}

const ListaMonedas = (props: Props) => {
    const [monedas, setmonedas] = useState<Array<Moneda>>([]);
    function addMoneda() {
        const moneda: Moneda = {
            nombre: "libra",
            pais: "uk"
        }
        setmonedas([...monedas, moneda]);
    }
    return (
        <>
            <h3>Cliente de monedas</h3>
            <div>
                <button onClick={addMoneda}>
                    agregar moneda
                </button>
                <h4>Monedas: </h4>
                <ul>
                    {
                        monedas.map((m: Moneda) => {
                            return (
                                <li> {m.nombre} de {m.pais} </li>
                            );
                        })
                    }
                </ul>
            </div>
        </>
    );
}

export default ListaMonedas;