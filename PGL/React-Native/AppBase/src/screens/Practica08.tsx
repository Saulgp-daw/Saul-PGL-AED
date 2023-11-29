import { Button, StyleSheet, Text, View } from 'react-native'
import React, { useState } from 'react'
import stylesp08 from '../themes/P8Styles'
import Circulo from '../components/Circulo'

type Props = {}

interface Circulo {
    numero: string;
    rgb: string;
  }

const Practica08 = (props: Props) => {
    const [circulos, setCirculos]  = useState<Circulo[]>([]);
    const [num, setNum] = useState(1);
    const [red, setRed] = useState(0);
    const [blue, setBlue] = useState(0);
    const [green, setGreen] = useState(0);


    function agregarCirculo(){
        const nuevoCirculo = {numero: "C"+num, rgb: "rgb("+red+","+green+","+blue+")"};

        setCirculos([...circulos, nuevoCirculo]);
    }

  return (
    <View style={stylesp08.principal}>
      <Text>Practica08</Text>
      <Button title='Agregar círculo' onPress={agregarCirculo}/>
      <Button title='wrap. Pulse para cambiar'/>
      <Button title='row. Pulse para cambiar'/>
      <View style={stylesp08.contenedor}>
        {
            circulos.map((circulo) => (
                <Circulo nombre={circulo.numero} color={circulo.rgb}/>
            ))
        }
      </View>

    </View>
  )
}

export default Practica08

const styles = StyleSheet.create({})