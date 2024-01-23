
//npm install @stomp/stompjs
//hay problema con encoding de react-native:
//npm install text-encoding
//npm install @types/text-encoding

import React, { useRef, useState } from 'react'


import { Client } from '@stomp/stompjs';

type Mensaje = {
    autor: string,
    peticion: string,
    idPartida: string,
    apuesta: string
    idPeticion: string
}

type MoiMessage = {
    nick: string,
    message: string
}


type Respuesta = {
    idPartida: string,
    estadoPartida: string,
    jugador1: string,
    jugador2: string,
    peticionRealizada: string,
    respuesta: string,
    resultado: string,
    peticionario: string,
    idPeticion: string
}
const PiedraPapelWebSocket = () => {

    const [historico, setHistorico] = useState<string[]>(new Array<string>());
    const stompRef = useRef({} as Client);

    const refIdPeticion = useRef("");
    const refIdPartida = useRef("");


    const [autor, setAutor] = useState("");
    const [peticion, setPeticion] = useState("");
    const [idPartida, setIdPartida] = useState("");
    const [apuesta, setApuesta] = useState("");
    const [infoPartidaActual, setInfoPartidaActual] = useState("");
    const [idPeticion, setIdPeticion] = useState("");


    const [conectado, setConectado] = useState("desconectado");


    function unirPartida() {

        let stompClient = stompRef.current;
        setPeticion("UNIRME");
        let aleatorio = Math.random() * 100000000;
        setIdPeticion("" + aleatorio);
        refIdPeticion.current = "" + aleatorio;
        let messageTo: Mensaje = {
            autor: autor,
            apuesta: apuesta,
            idPartida: idPartida,
            peticion: "UNIRME",
            idPeticion: "" + aleatorio


        };

        stompClient.publish({ destination: "/app/mensajegeneral", body: JSON.stringify(messageTo) });
        console.log("enviado " + messageTo);

    }


    function partidaNueva() {

        let stompClient = stompRef.current;
        setPeticion("PARTIDANUEVA");
        let aleatorio = Math.random() * 100000000;
        setIdPeticion("" + aleatorio);
        refIdPeticion.current = "" + aleatorio;
        let messageTo: Mensaje = {
            autor: autor,
            apuesta: apuesta,
            idPartida: idPartida,
            peticion: "PARTIDANUEVA",
            idPeticion: "" + aleatorio


        };

        stompClient.publish({ destination: "/app/mensajegeneral", body: JSON.stringify(messageTo) });
        console.log("enviado " + messageTo);

    }



    function apostar() {

        let stompClient = stompRef.current;
        /*setPeticion("APOSTAR");
        let aleatorio = Math.random() * 100000000;
        setIdPeticion("" + aleatorio);
        refIdPeticion.current = "" + aleatorio;
        let messageTo: Mensaje = {
            autor: autor,
            apuesta: apuesta,
            idPartida: idPartida,
            peticion: "APOSTAR",
            idPeticion: "" + aleatorio


        };
*/
        let msg: MoiMessage = {
            nick: autor,
            message: apuesta
        }


        stompClient.publish({ destination: "/app/mensajegeneral", body: JSON.stringify(msg) });
        console.log("enviado " + apuesta);

    }



    function onPublicMessageReceived(datos: any) {
        console.log("datos: " + datos);
        //setRecibido(datos.body);
        let respuesta = JSON.parse(datos.body) as MoiMessage;
        console.log(respuesta);
        let arr = historico;
        arr.push(JSON.stringify(respuesta, null, 3));
        setHistorico([...arr]);

        /*
        
                console.log("antes de peticón: respuesta.idPeticion == idPeticion")
                console.log("respuesta.idPeticion: " + respuesta.idPeticion);
                console.log(" refidPeticion: " + refIdPeticion.current);
                if (respuesta.idPeticion == refIdPeticion.current) {
                    if (respuesta.idPartida)
                        setIdPartida(respuesta.idPartida);
                    refIdPartida.current = respuesta.idPartida;
                    let infoPartida = "partida actual Estado: " + respuesta.estadoPartida
                        + " resultado " + respuesta.resultado;
        
                    if (respuesta.estadoPartida != "FALTA JUGADOR 2") {
                        infoPartida += " jugador1: " + respuesta.jugador1 +
                            " jugador2: " + respuesta.jugador2 +
                            " peticionRealizada: " + respuesta.peticionRealizada +
                            " peticionario: " + respuesta.peticionario +
                            " respuesta: " + respuesta.respuesta;
        
                    }
                    setInfoPartidaActual(infoPartida);
        
                } else if (respuesta.idPartida == refIdPartida.current) {
                    let infoPartida = "partida actual Estado: " + respuesta.estadoPartida
                        + " resultado " + respuesta.resultado;
        
                    if (respuesta.estadoPartida != "FALTA JUGADOR 2") {
                        infoPartida += " jugador1: " + respuesta.jugador1 +
                            " jugador2: " + respuesta.jugador2 +
                            " peticionRealizada: " + respuesta.peticionRealizada +
                            " peticionario: " + respuesta.peticionario +
                            " respuesta: " + respuesta.respuesta;
        
                    }
                    setInfoPartidaActual(infoPartida);
                }
                */


    }




    function conectar() {

        stompRef.current = new Client({

            brokerURL: 'ws://172.26.8.0:8080/websocket',

            debug: function (str) {
                console.log(str);
            },

            onConnect: conectarOK,
            onWebSocketError: (error) => console.log(error),
            onStompError: (frame) => {
                console.log('Additional details: ' + frame.body);
            },
            forceBinaryWSFrames: true,
            appendMissingNULLonIncoming: true,
        });



        function conectarOK() {

            setConectado("conectado");

            console.log("entra en conectarOK");
            let stompClient = stompRef.current;

            stompClient.subscribe('/salas/general', onPublicMessageReceived);
        }

        stompRef.current.activate();
    }





    return (


        <div >
            <p> MensajeWebSocket</p>


            <br />
            <br />
            Estado websocket: {conectado}
            <br />
            <br />

            <button onClick={conectar}>Conectar websocket</button>
            <br /> <br />

            <br />
            <p>
                Petición: {peticion}
                <br />
                id petición: {idPeticion}

            </p>
            <br />
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setAutor(texto);
                }}
                placeholder='autor'
                value={autor}


            />

            <br />
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setApuesta(texto);
                }}
                placeholder='apuesta'
                value={apuesta}

            />
            <br />
            <br />
            id partida actual: {idPartida}

            <br />
            {infoPartidaActual}


            <br />
            <button onClick={unirPartida}>Unirse a partida</button>  <br />
            <button onClick={partidaNueva}>Partida nueva</button>  <br />
            <button onClick={apostar}>Apostar</button>  <br />

            <ul>

                {historico.map(
                    (linea, id) => <li key={"dato" + id}> {linea} </li>
                )}


            </ul>

        </div>

    )
}


export default PiedraPapelWebSocket