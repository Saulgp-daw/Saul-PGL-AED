import { View, Text, Button, Alert } from 'react-native'
import React, { useState } from 'react'
import { useAppContext } from '../contexts/TokenContextProvider';
import { TextInput } from 'react-native-gesture-handler';
import axios from 'axios';

type Props = {}

const BorrarAlumno = (props: Props) => {
  
  const ruta = "http://192.168.1.51:8080/api/v2/alumnos";
  const [loading, setLoading] = useState(false);
  const { token, settoken } = useAppContext();
  const [dni, setDni] = useState("");

  async function borrar(){
    try{
      const response = await axios.delete(ruta+"/"+dni, { headers: { 'Authorization': `Bearer ${token}` } });
    console.log(response);
    Alert.alert("Alumno borrado", "Respuesta: "+response.status);
    }catch(error){
      Alert.alert("Algo ha ido mal", error.message);
    }
  }

  return (
    <View>
      <Text>Borrar Alumno</Text>
      <Text>Dni: </Text>
      <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setDni(texto)} />
      <Button title={loading ? 'Un momento...' : 'Borrar'} onPress={borrar} />
    </View>
  )
}

export default BorrarAlumno