import React, { useState } from 'react'
import { Alert } from 'react-native';

type Props = {}

function usePractica12() {
    const [colorPreferido, setColorPreferido] = useState("green");
    const colores: Array<string> = ["blue", "green", "orange", "pink", "yellow"];

    function mostrarAlerta(){
        Alert.alert("Cambio de color", "Si acepta cambiará el color", [
            {
                text: "cancel",
                onPress: () => console.log("No se cambia el color")
                
            },
            {
                text: "Ok",
                onPress: () => {
                    const random: number = Math.floor(Math.random()*colores.length-1)
                    setColorPreferido(colores[random])}
            }

        ]);

    }
  return {
    colorPreferido, 
    mostrarAlerta
  }
}

export default usePractica12