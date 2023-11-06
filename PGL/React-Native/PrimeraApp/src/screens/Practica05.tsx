import { Alert, Button, StyleSheet, Text, TouchableHighlight, View } from 'react-native'
import React, { useState } from 'react'

type Props = {}

const Practica05 = (props: Props) => {
    const [estiloFlex, setEstiloFlex] = useState(1);
  return (
    <View style={{flex: estiloFlex}}>
      <Text>Practica05</Text>
      <Button title="Flex +1" onPress={() => setEstiloFlex(estiloFlex+1)}/>
      <Button title="Flex -1" onPress={() => setEstiloFlex(estiloFlex-1)}/>
    </View>
  )
}

export default Practica05

const styles = StyleSheet.create({

})