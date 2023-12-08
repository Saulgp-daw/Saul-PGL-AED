import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import Navbar from '../../components/Proyecto/Navbar'

type Props = {}

const Busqueda = (props: Props) => {
  return (
    <View>
        <Navbar/>
      <Text>Busqueda</Text>
    </View>
  )
}

export default Busqueda

const styles = StyleSheet.create({})