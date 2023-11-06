import { Button, Image, StyleSheet, Text, TextInput, View } from 'react-native'

import stylesp08 from '../themes/P8Styles'
import React, { useState } from 'react'

type Props = {}

type AlignItems = "stretch" | "center" | "flex-start" | "flex-end" | "baseline";

const Practica09 = (props: Props) => {
  const [flex, setFlex] = useState<AlignItems>("flex-end");

  function cambiarFlex(nuevoFlex: AlignItems) {
    setFlex(nuevoFlex);
  }

  return (
    <View style={stylesp08.practica09}>
      <Text>Practica09</Text>
      <TextInput style={stylesp08.input} />
      <View style={stylesp08.botones}>
        <Button title='STRETCH' onPress={() => cambiarFlex("stretch")} />
        <Button title='CENTER' onPress={() => cambiarFlex("center")}/>
        <Button title='FLEX-START' onPress={() => cambiarFlex("flex-start")}/>
        <Button title='FLEX-END' onPress={() => cambiarFlex("flex-end")}/>
      </View>
      <View style={{...stylesp08.imagenes, alignItems: flex}} >
        <Image source={{ uri: 'https://shorturl.at/sAMSU', method: 'POST', headers: { Pragma: 'no-cache' } }}
          style={{ width: 50, height: 50 }} />
        <Image source={{ uri: 'https://shorturl.at/anrFQ', method: 'POST', headers: { Pragma: 'no-cache' } }}
          style={{ width: 50, height: 50 }} />
        <Image source={{ uri: 'https://shorturl.at/fEFQ7', method: 'POST', headers: { Pragma: 'no-cache' } }}
          style={{ width: 50, height: 50 }} />
      </View>
    </View>
  )
}

export default Practica09

const styles = StyleSheet.create({})