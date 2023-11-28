import { StyleSheet, Text, View } from 'react-native'
import React from 'react'

type Props = {
    nombre: string,
    color: string
}

const Circulo = (props: Props) => {
    let color = props.color ?? "green";
    let nombre = props.nombre ?? "vacío";
  return (
    <View style={{...styles.estilosCirculo, backgroundColor:color}}>
      <Text>{props.nombre}</Text>
    </View>
  )
}

export default Circulo

const styles = StyleSheet.create({
    estilosCirculo:{
        height: 100,
        width: 100,
        borderRadius: 50,
        backgroundColor: "green"

    }
})