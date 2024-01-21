import { View, Text, FlatList } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios'
import { useAppContext } from '../contexts/TokenContextProvider'

type Props = {}

type Usuario = {
  id: number;
  nombre: string;
	email: string;
  active: boolean;
  hash: string;
  password: string;
  rol: string;
}

const Perfil = (props: Props) => {
	const ruta = "http://192.168.1.51:8080/api/v2/usuarios/profile";
	const { token, settoken } = useAppContext();
	const [informacionUsuario, setInformacionUsuario] = useState<Usuario>(null);
	

  useEffect(() => {
	console.log("hola");
	
    const axiosget = async () => {
      try{
        const response = await axios.get(ruta, { headers: {
			Authorization: `Bearer ${token}`, // Agrega el token a los encabezados
		  },});
        console.log(response.data);
		setInformacionUsuario(response.data);
      }catch(error){
        console.log(error);
        
      }
    }
	axiosget();
  }, [])

  return (
    <View style={{ flex: 1 }}>
      <Text>Perfil</Text>
      {informacionUsuario != null ? 
        <View>
          <Text>Id: {informacionUsuario.id}</Text>
          <Text>Username: {informacionUsuario.nombre}</Text>
          <Text>email: {informacionUsuario.email}</Text>
          <Text>Active: {informacionUsuario.active}</Text>
          <Text>Rol: {informacionUsuario.rol}</Text>
        </View>
        
        : null
      }
    </View>
  )
}

export default Perfil