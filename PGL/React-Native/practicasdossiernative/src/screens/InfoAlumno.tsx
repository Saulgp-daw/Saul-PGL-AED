import { View, Text, TouchableHighlight } from 'react-native'
import React from 'react'

type Props = {
    navigation: any;
};

const InfoAlumno = ({ navigation }: Props) => {
  return (
    <View>
      <Text>InfoAlumno</Text>
      <TouchableHighlight onPress={() => navigation.navigate("ModificarAlumno")}>
                <Text>Info</Text>
            </TouchableHighlight>
    </View>
  )
}

export default InfoAlumno