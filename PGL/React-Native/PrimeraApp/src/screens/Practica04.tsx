import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import Caja from '../components/Caja'

type Props = {}

const Practica04 = (props: Props) => {
  return (
    <View style={styles.principal}>
      <Text>Practica04</Text>
      <View style={{flex: 1, borderColor: "black", borderWidth: 2, justifyContent: "center"}}>
        <Caja color={'white'}/>
        <Caja color={'green'}/>
        <Caja color={'purple'}/>
      </View>
      
    </View>
  )
}

export default Practica04

const styles = StyleSheet.create({
    principal: {
        backgroundColor: "lightblue",
        flex: 1,
        padding: 10
        

    }
})