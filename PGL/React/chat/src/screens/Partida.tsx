import React, { useState } from 'react'
import axios from 'axios';
import "../styles/tresenraya.css"

type Props = {}

type Partida = {
    idPartida: String;
    estado: String;
    nickJug1: String;
    nickJug2: String;
    simboloJug1: String;
    simboloJug2: String;
    tablero: String;
}

const Partida = (props: Props) => {
    const ruta = "http://localhost:8080/api/v1/partidas/";
    const [sala, setSala] = useState("");
    const [nickJug1, setNickJug1] = useState("");
    const [simbolo, setSimbolo] = useState("O");
    const [nickJug2, setNickJug2] = useState("");
    const [simbolo2, setSimbolo2] = useState("O");
    const [apuesta, setApuesta] = useState("");
    const [posicion, setPosicion] = useState("");
    const [tablero, setTablero] = useState("---------");
    const [mensaje, setMensaje] = useState("");
    const [partida, setPartida] = useState<Partida>();

    async function nuevaPartida() {
        try {
            let response = await axios.post(ruta + "nueva", {
                "nickJug1": nickJug1,
                "simboloJug1": simbolo.toUpperCase()
            });
            console.log(response.data);

            const nueva: Partida = {
                idPartida: response.data.idPartida,
                estado: response.data.estado,
                nickJug1: response.data.nickJug1,
                nickJug2: response.data.nickJug2,
                simboloJug1: response.data.simboloJug1,
                simboloJug2: response.data.simboloJug2,
                tablero: response.data.tablero,
            }

            setPartida(nueva);



        } catch (error) {
            console.log(error);
        }



    }
    async function unirsePartida() {
        try {
            let response = await axios.put(ruta + sala + "/unirse", {
                "nickJug2": nickJug2,
                "simboloJug2": simbolo2.toUpperCase()
            });
            console.log(response);
            if (response.status == 200) {
                const nueva: Partida = {
                    idPartida: response.data.partida.idPartida,
                    estado: response.data.partida.estado,
                    nickJug1: response.data.partida.nickJug1,
                    nickJug2: response.data.partida.nickJug2,
                    simboloJug1: response.data.partida.simboloJug1,
                    simboloJug2: response.data.partida.simboloJug2,
                    tablero: response.data.partida.tablero,
                }
    
                setPartida(nueva);
                setMensaje("Nuevo tablero");
            }

        } catch (error) {
            if (axios.isAxiosError(error) && error.response != undefined) {
                setMensaje(error.response.data);
            }
            console.log(mensaje);
            console.error('Error en la solicitud:', error);
        }

    }

    async function apuestas() {
        console.log(Number(posicion));
        console.log(apuesta);
        console.log(sala);
        try {
            let response = await axios.post(ruta + Number(sala) + "/apuestas", {
                "simbolo": apuesta.toUpperCase(),
                "posicion": Number(posicion)
            });
            console.log(response);
            if (response.status == 200) {
                const nueva: Partida = {
                    idPartida: response.data.partida.idPartida,
                    estado: response.data.partida.estado,
                    nickJug1: response.data.partida.nickJug1,
                    nickJug2: response.data.partida.nickJug2,
                    simboloJug1: response.data.partida.simboloJug1,
                    simboloJug2: response.data.partida.simboloJug2,
                    tablero: response.data.partida.tablero,
                }
    
                setPartida(nueva);
                setMensaje(response.data.mensaje);
            }

        } catch (error) {
            if (axios.isAxiosError(error) && error.response != undefined) {
                setMensaje(error.response.data.mensaje);
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
            <p>
                Estado: {partida?.estado} - Num. Sala: {partida?.idPartida}
            </p>
            <p>
                Jugador1: {partida?.nickJug1} - Jugador2: {partida?.nickJug2}
            </p>
            <p>
                SimboloJ1: {partida?.simboloJug1} - SimboloJ1: {partida?.simboloJug2}
            </p>
            <div className='tablero'>

                {partida?.tablero &&
                    partida.tablero.split('').map((caracter, index) => (
                        <div key={index} className='casilla'>
                            {caracter}
                        </div>
                    ))}
            </div>

            <div>{mensaje}</div>
        </div>
    )
}

export default Partida
