import { Alert, Button, StyleSheet, Text, View } from 'react-native'
import React, { useState } from 'react'
import usePractica12 from '../hooks/usePractica12'
import stylesp12 from '../themes/P12Styles';

type Props = {}

const Practica12 = (props: Props) => {
    const {mostrarAlerta, colorPreferido} = usePractica12();


  return (
    <View style={{...stylesp12.color, backgroundColor: colorPreferido}}>
      <Button title="Cambiar color" onPress={mostrarAlerta} ></Button>
      <Text >{colorPreferido}</Text>
    </View>
  )
}

export default Practica12
