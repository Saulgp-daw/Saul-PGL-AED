import { StyleSheet, Text, View } from 'react-native'
import React from 'react'

type RootStackParamList = {
  element: { poke: PokemonData }
}

type ScreenRouteProp = RouteProp<RootStackParamList, "poke">;

type Props = {
  navigation?: any;
  route?: ScreenRouteProp
}



const PokemonCard = (props: Props) => {
  return (
    <View>
      <Text>PokemonCard</Text>
    </View>
  )
}

export default PokemonCard

const styles = StyleSheet.create({})