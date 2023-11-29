import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { NativeStackScreenProps } from '@react-navigation/native-stack'
import { useAppContext } from '../../../../React/practicas/src/components/Practica47/PokemonContextProvider';

type Props = NativeStackScreenProps<RootStackParamList, 'Gatos'>;

const GatosScreen = (props: Props) => {
    const context = useAppContext();
  return (
    <View>
      <Text>GatosScreen</Text>
    </View>
  )
}

export default GatosScreen

const styles = StyleSheet.create({})