import { Image, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { NativeStackScreenProps } from '@react-navigation/native-stack'
import { useRazaContext } from '../contexts/RazaContextProvider';
import { Raza } from '../models/Raza';
import { TouchableOpacity } from 'react-native-gesture-handler';


type Props = {
  navigation: any;
}

const GatosScreen = ({ navigation }: Props) => {
  const { razas, setrazas } = useRazaContext();
  const gatos: Array<Raza> = razas[1];

  console.log(gatos);

  return (
    <View style={{ flex: 1, justifyContent: 'flex-start', alignItems: 'center' }}>
      {gatos.map((gato: Raza, index: number) => (
        <TouchableOpacity key={index} style={{ flex: 0.2 }} onPress={() => navigation.navigate("Gato", { michi: gato })}>
          <Text>{gato.getNombre()}</Text>
        </TouchableOpacity>
      ))}
    </View>
  )
}

export default GatosScreen

const styles = StyleSheet.create({})