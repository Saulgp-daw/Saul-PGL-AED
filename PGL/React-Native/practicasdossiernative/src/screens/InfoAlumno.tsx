import { View, Text, TouchableHighlight, Image, FlatList } from 'react-native'
import React, { useEffect, useState } from 'react'
import { Alumno } from './BuscarAlumno';
import { RouteProp } from '@react-navigation/native';
import axios from 'axios';
import { useAppContext } from '../contexts/TokenContextProvider';
import { ScrollView } from 'react-native-gesture-handler';

type RootStackParamList = {
  Alumno: { alumno: Alumno }
}

type AlumnoScreenRouteProp = RouteProp<RootStackParamList, "Alumno">

type Props = {
  navigation: any;
  route?: AlumnoScreenRouteProp;
};

const InfoAlumno = ({ navigation, route }: Props) => {
  const ruta = "http://192.168.1.51:8080/api/v2/alumnos/ficheros/";
  const { token, settoken } = useAppContext();

  const alumno = route?.params?.alumno;
  const fecha = new Date(alumno.fechanacimiento);

  return (
    <View>
      <Text>InfoAlumno</Text>
      <View>
        <Image source={{
          uri: ruta + alumno?.imagen,
          method: "GET",
          headers: { 'Authorization': `Bearer ${token}` }
        }} style={{ width: 150, height: 150 }} />
        <Text>Dni: {alumno?.dni}</Text>
        <Text>Nombre: {alumno?.nombre}</Text>
        <Text>Apellidos: {alumno?.apellidos}</Text>
        <Text>Fecha de nacimiento: {fecha.getDate() + "/" + fecha.getMonth() + "/" + fecha.getFullYear()}</Text>

        <FlatList
          data={alumno.matriculas}
          renderItem={({ item }) => (
            <View>
              <Text>Curso: </Text>
              <Text>Id: {item.id + " - Año: " + item.year}</Text>
              <Text>Asignaturas: </Text>
              <FlatList
                data={item.asignaturas}
                keyExtractor={(asignatura) => asignatura.id.toString()} // Agrega esta línea
                renderItem={({ item }) => (
                    <Text>{item.curso + " " + item.nombre}</Text>
                )}
              />
            </View>
          )}
          keyExtractor={(matricula) => matricula.id.toString()} // Agrega esta línea
        />


      </View>
    </View>
  )
}

export default InfoAlumno