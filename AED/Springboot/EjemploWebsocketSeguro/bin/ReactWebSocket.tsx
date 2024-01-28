

//npm install @stomp/stompjs
//hay problema con encoding de react-native:
//npm install text-encoding
//npm install @types/text-encoding

import React, { useEffect, useRef, useState } from 'react'



import * as encoding from 'text-encoding';
import { Client } from '@stomp/stompjs';
import axios from 'axios';

const ReactWebSocket = () => {
    /*
    Object.assign(global, {
        TextEncoder: encoding.TextEncoder,
        TextDecoder: encoding.TextDecoder,
    });
    */

    const [usuario, setUsuario] = useState("");
    const [clave, setClave] = useState("");
    const [historico, setHistorico] = useState<string[]>(new Array<string>());
    const stompRef = useRef({} as Client);

    const [mensaje, setMensaje] = useState("");

    const [receptor, setReceptor] = useState("");
    const [autor, setAutor] = useState("");

    const [token, setToken] = useState("");

    const [conectado, setConectado] = useState("desconectado");

   
    




    function login() {
        async function getToken(nombre: string, password: string){
            let loginmessage={
                nombre,
                password
            };
            let response = await axios.post("http://localhost:8080/api/login",loginmessage);
            console.log(response.data);
            let token = response.data;
            setToken(token);
            setAutor(nombre);
        }

        getToken(usuario,clave);
    }




    function enviar() {

        let stompClient = stompRef.current;
        let messageTo={
            author:   autor,
            receiver: "no hay receptor específico",
            content: mensaje
        
        };

        stompClient.publish({ destination: "/app/mensajegeneral", body: JSON.stringify(messageTo) });
        console.log("enviado público");
/*
        let arr = historico;
        arr.push("le dices a  todos: "  + messageTo.content);
        setHistorico([...arr]); 
        */
    }


    function enviarPrivado() {


        let stompClient = stompRef.current;
        let messageTo={
            author:   autor,
            receiver: receptor,
            content: mensaje
        
        };
        stompClient.publish({ destination: "/app/privado", body: JSON.stringify(messageTo) });
        console.log("enviado privado");

        let arr = historico;
        arr.push("le dices a  " + messageTo.receiver +": " + messageTo.content);
        setHistorico([...arr]);        
    }


    function onPublicMessageReceived(datos: any) {
        console.log("datos: " + datos);
        //setRecibido(datos.body);
        let nuevoMensaje = JSON.parse(datos.body);
        console.log(nuevoMensaje);
        let arr = historico;
        arr.push(nuevoMensaje.author + " dice a todos: " + nuevoMensaje.content);
        setHistorico([...arr]);
    }

    function onPrivateMessageReceived(datos: any) {
        console.log("datos: " + datos);
        //setRecibido(datos.body);
        let nuevoMensaje = JSON.parse(datos.body);
        console.log(nuevoMensaje);
        let arr = historico;
        arr.push(nuevoMensaje.author + " te dice en privado: " + nuevoMensaje.content);
        setHistorico([...arr]);
    }    

 

    function conectar() {
        async function getMensajesPrivados(){
            let response = await axios.get("http://localhost:8080/api/mensajes",{
                
                headers:{
                    "Access-Control-Allow-Origin" : "*",
                    "Authorization": "Bearer "+token
                }
                
            });
            let nuevoHistorico = response.data.map( (mensaje:any) => JSON.stringify(mensaje));
            setHistorico(nuevoHistorico);
        }


        getMensajesPrivados();

        stompRef.current = new Client({

            brokerURL: 'ws://localhost:8080/websocket',
            connectHeaders:   {
                Authorization: 'Bearer ' + token,
            },            
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
            stompClient.subscribe('/usuarios/cola/mensajes', onPrivateMessageReceived);
        }


        function conectarError() {

        }

        stompRef.current.activate();




    }





    return (


        <div >
            <p> MensajeWebSocket</p>

            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setUsuario(texto);
                }}
                placeholder='usuario'

            />
            <br/>

            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setClave(texto);
                }}
                placeholder='contraseña'

            />

                <br />
             <button onClick={login}>Login</button>
             <br />
            
             <br/>
             Estado websocket: {conectado}
             <br/>             
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setToken(texto);
                }}
                value={token}
                placeholder='token'
                disabled

            />
            <br/>

            <button onClick={conectar}>Conectar websocket</button>
            <br/> <br/>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setReceptor(texto);
                }}
                placeholder='receptor'

            />
            <br/>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setAutor(texto);
                }}
                placeholder='autor'
                value={autor}
                disabled

            />

            <br/>
            <input
                type="text"
                onChange={(e) => {
                    e.preventDefault();
                    let texto = e.currentTarget.value;
                    setMensaje(texto);
                }}
                placeholder='mensaje'

            />
             <br/>
            <button onClick={enviar}>Mensaje a todos</button>  <br/>
            <button onClick={enviarPrivado}>Mensaje privado a receptor</button>
            <ul>
            
                {historico.map(
                    (linea, id) => <li key={"dato" + id}> {linea} </li>
                )}

            
            </ul>

        </div>

    )
}


export default ReactWebSocket