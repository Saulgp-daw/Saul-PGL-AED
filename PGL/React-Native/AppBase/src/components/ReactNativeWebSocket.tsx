
//npm install @stomp/stompjs
//hay problema con encoding de react-native:
//npm install text-encoding
//npm install @types/text-encoding





import React, { useRef, useState } from 'react'
import { Button, Text, TextInput, View } from 'react-native';


import * as encoding from 'text-encoding';
import { Client } from '@stomp/stompjs';



const ReactNativeWebSocket = () => {

Object.assign(global, {
  TextEncoder: encoding.TextEncoder,
  TextDecoder: encoding.TextDecoder,
});

  const [historico, setHistorico] = useState<string[]>(new Array<string>() );   
    const stompRef = useRef({} as Client);
  
    const [mensaje, setMensaje] = useState("");

 

    function enviar(){
      
      let stompClient = stompRef.current;     
      let envio = {
        name: mensaje
      }

      stompClient.publish({destination: "/app/publicmessage", body: JSON.stringify(envio) });
      console.log("enviado");
    }


    function onMessageReceived(datos:any){
      console.log("datos: " + datos);
      //setRecibido(datos.body);
      let ahora = JSON.parse( datos.body );
      console.log(ahora.name); 
      let arr = historico;
      arr.push(ahora.name);
      setHistorico( [...arr]  );
    }

    function conectar(){

        
        stompRef.current = new Client({

          brokerURL: 'ws://172.26.255.0:8080/websocket',
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



        function conectarOK(){
          console.log("entra en conectarOK");
          let stompClient = stompRef.current;
          stompClient.subscribe('/topic/chatroom', onMessageReceived);
        }


        function conectarError(){

        }

        stompRef.current.activate();
      }





    return (
      
      
      <View style={ {flex:1} }>
        <Text> MensajeWebSocket</Text>
        <Button onPress={conectar}  title='Conectar' />
        <TextInput 
              onChangeText={(texto)=>{
              
                  setMensaje(texto);
              }} 
              placeholder='mensaje'
              
          />
        <Button onPress={enviar} title='Enviar' />
        <View style={ {flex:1} }>
          {historico.map( 
                (linea,id) => <Text key={"dato"+id}> {linea} </Text>
              )}
      
        </View>
      
    </View>
  
  )
}

export default ReactNativeWebSocket

