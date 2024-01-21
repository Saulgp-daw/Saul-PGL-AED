import { View, Text, TouchableHighlight } from 'react-native'
import React from 'react'
import { Alumno } from './BuscarAlumno';
import { RouteProp } from '@react-navigation/native';

type RootStackParamList = {
  Alumno: { alumno: Alumno }
}

type AlumnoScreenRouteProp = RouteProp<RootStackParamList, "Alumno">

type Props = {
  navigation: any;
  route?: AlumnoScreenRouteProp;
};

const InfoAlumno = ({ navigation, route }: Props) => {
  const alumno = route?.params?.alumno;
  console.log(alumno);


  return (
    <View>
      <Text>InfoAlumno</Text>
      {alumno ?
        <View>
          <Text>Dni: {alumno.dni}</Text>
          <Text>Nombre: {alumno.nombre}</Text>
          <Text>Apellidos: {alumno.apellidos}</Text>
          
          <Text>Fecha nacimiento: {alumno.fechanacimiento}</Text>
        </View>
        : null
      }
      <TouchableHighlight onPress={() => navigation.navigate("ModificarAlumno")}>
        <Text>Info</Text>
      </TouchableHighlight>
    </View>
  )
}

export default InfoAlumno