import { StyleSheet, Text, View } from 'react-native'
import React from 'react'

type Props = {}

const Prueba = (props: Props) => {
  return (
    <View style={styles}>
      <Text>Prueba</Text>
    </View>
  )
}

export default Prueba

const styles = StyleSheet.create({
    background: "red"
})