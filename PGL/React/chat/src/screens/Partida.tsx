import React, { useState } from 'react'
import axios from 'axios';

type Props = {}

const Partida = (props: Props) => {
    const ruta = "http://localhost:8080/api/v1/partidas/";
    const [sala, setSala] = useState("");
    const [nickJug1, setNickJug1] = useState("");
    const [simbolo, setSimbolo] = useState("O");
    const [nickJug2, setNickJug2] = useState("");
    const [simbolo2, setSimbolo2] = useState("O");
    const [apuesta, setApuesta] = useState("");
    const [posicion, setPosicion] = useState("");
    const [tablero, setTablero] = useState("--------");
    const [mensaje, setMensaje] = useState("hola");

    async function nuevaPartida() {
        let response = await axios.post(ruta + "nueva", {
            "nickJug1": nickJug1,
            "simboloJug1": simbolo
        });
        console.log(response.data);


    }
    async function unirsePartida() {
        try {
            let response = await axios.put(ruta + sala + "/unirse", {
                "nickJug2": nickJug2,
                "simboloJug2": simbolo2
            });
            console.log(response);
            if (response.status == 200) {
                setTablero(response.data.tablero);
                setMensaje("Nuevo tablero");
            }

        } catch (error) {
            console.error('Error en la solicitud:', error);
        }

    }

    async function apuestas() {
        console.log(Number(posicion));
        console.log(apuesta);
        console.log(sala);
        try {
            let response = await axios.post(ruta + Number(sala) + "/apuestas", {
                "simbolo": apuesta,
                "posicion": Number(posicion)
            });
            console.log(response);
            if (response.status == 200) {
                setTablero(response.data.tablero);
                setMensaje("Movimiento aprobado");
            }

        } catch (error) {
            if (axios.isAxiosError(error) && error.response != undefined) {
                setMensaje(error.response.data);
            }
            console.log(mensaje);


            console.error('Error en la solicitud:', error);
        }
    }

    return (
        <div>
            <h3>Partida</h3>
            <label htmlFor="nick">Tu nick: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setNickJug1(texto);
                }}
                placeholder='Enuji'

            /> <br />
            <label htmlFor="numSala">Tu simbolo: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setSimbolo(texto);
                }}
                placeholder='X'

            /> <br />
            <button onClick={nuevaPartida}>Crear nueva partida</button>  <br />

            <br />


            {/* UNIRSE */}
            <label htmlFor="numSala">Num. Sala: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setSala(texto);
                }}
                placeholder='1'

            /> <br />
            <label htmlFor="nick">Tu nick: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setNickJug2(texto);
                }}
                placeholder='Enuji'

            />  <br />
            <label htmlFor="numSala">Tu simbolo: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setSimbolo2(texto);
                }}
                placeholder='X'

            /> <br />
            <button onClick={unirsePartida}>Unirse partida</button>  <br />
            <label htmlFor="numSala">Num. Sala: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setSala(texto);
                }}
                placeholder='1'

            /> <br />
            <label htmlFor="simboloApuesta">Tu simbolo: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setApuesta(texto);
                }}
                placeholder='O'

            />  <br />
            <label htmlFor="posicion">Tu posicion: </label>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setPosicion(texto);
                }}
                placeholder='0-8'

            /> <br />
            <button onClick={apuestas}>Apostar</button>  <br />

            <br />
            <div>/////////////////////////////////////////////</div>
                <div>
                    {tablero && tablero.match(/.{1,3}/g)?.map((fila, index) => (
                        <div key={index}>{fila}</div>
                    ))}
                </div>

            <div>{mensaje}</div>
        </div>
    )
}

export default Partida