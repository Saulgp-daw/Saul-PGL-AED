import { Button, StyleSheet, Text, View } from 'react-native'
import React, { useState } from 'react'

type Props = {
    color: string
}

const Caja = (props: Props) => {
    const [estiloFlex, setEstiloFlex] = useState(1);
  return (
    <View style={{...styles.caja, backgroundColor: props.color, flex:estiloFlex}}>
      <Text>Caja</Text>
      <Button title="Flex +1" onPress={() => setEstiloFlex(estiloFlex+1)}/>
      <Button title="Flex -1" onPress={() => setEstiloFlex(estiloFlex-1)}/>
    </View>
  )
}

export default Caja

const styles = StyleSheet.create({
    caja : {
        backgroundColor: "orange",
        height: 100,
        width: 100,
        margin: 10
    }
})