import { View, Text, TouchableHighlight, FlatList, TextInput, Button } from 'react-native'
import React, { useEffect, useState } from 'react'
import { useAppContext } from '../contexts/TokenContextProvider';
import axios from 'axios';


type Props = {
  navigation: any;
};

export type Alumno = {
  dni: string;
  nombre: string;
  apellidos: string;
  fechanacimiento: number;
  base64: string;
  imagen: string;
  matriculas: Matricula[];
}

interface iAlumnos {
  alumnos: Array<Alumno>;
}

type Matricula = {
  id: number;
  year: number;
  asignaturas: Asignatura[];
}

type Asignatura = {
  id: number;
  curso: string;
  nombre: string;
}

const BuscarAlumno = ({ navigation }: Props) => {
  //const ruta = "http://192.168.1.51:8080/api/v2/alumnos";
  const ruta = "http://172.26.13.0:8080/api/v2/alumnos";
  const [loading, setLoading] = useState(false);
  const [dni, setDni] = useState("");
  const { token, settoken } = useAppContext();
  const [alumnos, setAlumnos] = useState<Alumno[]>([]);
  const [alumnoEncontrado, setAlumnoEncontrado] = useState<Alumno>();

  useEffect(() => {
    const axiosget = async () => {
      try {
        const response = await axios.get<Alumno[]>(ruta, { headers: { 'Authorization': `Bearer ${token}` } });
        setAlumnos((prevAlumnos) => [...prevAlumnos, ...response.data]);



      } catch (error) {
        console.log(error);

      }
    }
    axiosget();
  }, []);

  async function buscar() {
    const axiosget = async () => {
      try {
        const response = await axios.get<Alumno>(ruta + "/" + dni, { headers: { 'Authorization': `Bearer ${token}` } });
        //console.log(response.data);
        setAlumnoEncontrado(response.data);
        navigation.navigate("InfoAlumno", { alumno: response.data });


      } catch (error) {
        console.log(error);

      }
    }
    axiosget();
  }



  return (
    <View>
      <Text>Buscar Alumnos</Text>

      <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setDni(texto)} />
      <Button title={loading ? 'Enviando...' : 'Buscar'} onPress={buscar} />

      <FlatList data={alumnos} renderItem={({ item }) => (
        <Text>{item.dni + " " + item.nombre + " " + item.apellidos}</Text>
      )} />

      <TouchableHighlight onPress={() => navigation.navigate("InfoAlumno")}>
        <Text>Info</Text>
      </TouchableHighlight>
    </View>
  )
}

export default BuscarAlumno