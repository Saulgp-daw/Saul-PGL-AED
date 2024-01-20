import { View, Text, TouchableHighlight } from 'react-native'
import React from 'react'


type Props = {
    navigation: any;
};

const BuscarAlumno = ({ navigation }: Props) => {
  return (
    <View>
      <Text>BuscarAlumno</Text>
      <TouchableHighlight onPress={() => navigation.navigate("InfoAlumno")}>
                <Text>Info</Text>
            </TouchableHighlight>
    </View>
  )
}

export default BuscarAlumno