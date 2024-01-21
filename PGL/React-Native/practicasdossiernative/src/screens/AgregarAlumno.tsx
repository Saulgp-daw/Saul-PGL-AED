import React, { useEffect, useState } from 'react';
import { View, Text, TextInput, Button, Platform  } from 'react-native';
import {launchImageLibrary} from 'react-native-image-picker';
import DateTimePicker from '@react-native-community/datetimepicker';
import axios from 'axios';
import { useAppContext } from '../contexts/TokenContextProvider';

type Props = {}

export type Alumno = {
  dni: string;
  nombre: string;
  apellidos: string;
  fechanacimiento: number;
  base64: string;
  imagen: string;
}

const AgregarAlumno = (props: Props) => {
  const ruta = "http://192.168.1.51:8080/api/v2/alumnos";
  const [dni, setDni] = useState("");
  const [nombre, setNombre] = useState("");
  const [apellidos, setApellidos] = useState("");
  const [fechaNacimiento, setFechaNacimiento] = useState(0);
  const [base64, setBase64] = useState("");
  const [imagen, setImagen] = useState("");
  const [date, setDate] = useState(new Date());
  const [show, setShow] = useState(false);
  const [loading, setLoading] = useState(false);
  const { token, settoken } = useAppContext();

  async function selectImage() {
    const options = {
      includeBase64: true,
      maxHeight: 2000,
      maxWidth: 2000,
      mediaType: "photo"
    };

    launchImageLibrary(options, response => {
      console.log(response.assets[0].fileName);
      setBase64(response.assets[0].base64);
      setImagen(response.assets[0].fileName);
      
    });
  }

  const onChange = (event, selectedDate) => {
    const currentDate = selectedDate || date;
    setShow(Platform.OS === 'ios');

    console.log(currentDate.getTime());
    setFechaNacimiento(currentDate.getTime());
    setDate(currentDate);
  };

  const showDatepicker = () => {
    setShow(true);
  };

  async function crear(){
    const nuevoAlumno: Alumno = {
      dni: dni,
      nombre: nombre,
      apellidos: apellidos,
      fechanacimiento: fechaNacimiento,
      base64: base64,
      imagen: imagen
    }

    console.log(nuevoAlumno);

    const axiospost = async () => {
      try{
        const response = await axios.post(ruta, nuevoAlumno, { headers: { 'Authorization': `Bearer ${token}` } });
        console.log(response.data);
        alert("Alumno añadido!");
      }catch(error){
        console.log(error);
      }
    }

    axiospost();
    
  }


  return (
    <View style={{ flex: 1 }}>
      <Text>Agregar Alumno</Text>
      <Text>Dni: </Text>
      <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setDni(texto)} />
      <Text>Nombre: </Text>
      <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setNombre(texto)} />
      <Text>Apellidos: </Text>
      <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setApellidos(texto)} />
      <Text>Imagen: </Text>
      <Button title={imagen ?  "Subir otra imagen" : "Seleccionar Imagen" } onPress={() => selectImage()} />
      {imagen? 
        <Text>Imagen seleccionada: {imagen}</Text> : null
      }
      <Text>Fecha de Nacimiento: </Text>
      <Text>{date.getDate()+"/"+(Number(date.getMonth())+1)+"/"+date.getFullYear()}</Text>
      <Button onPress={showDatepicker} title="Mostrar selector de fecha" />
      {show && (
        <DateTimePicker
          testID="dateTimePicker"
          value={date}
          mode="date"
          is24Hour={true}
          display="default"
          onChange={onChange}
        />
      )}
      
      <Button title={loading ? 'Enviando...' : 'Agregar'} onPress={crear}/>
      


    </View>
  );
}

export default AgregarAlumno;
