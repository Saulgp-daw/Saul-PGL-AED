import { View, Text, FlatList } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios'
import { useAppContext } from '../contexts/TokenContextProvider'

type Props = {}

type Usuario = {
	email: string;
}

const Perfil = (props: Props) => {
	const ruta = "http://192.168.1.51:8080/api/v2/usuarios";
	const { token, settoken } = useAppContext();
	const [informacionUsuario, setInformacionUsuario] = useState<Usuario[]>([]);
	

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
		<FlatList data={informacionUsuario} renderItem={ item => (
			<Text>{item.item.email}</Text>
		)}>

		</FlatList>
    </View>
  )
}

export default Perfil