import { View, Text, TextInput, Button, TouchableHighlight } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { useAppContext } from '../contexts/TokenContextProvider';
import AsyncStorage from '@react-native-async-storage/async-storage';


export interface iLogin {
    username: string,
    password: string
}

type Props = {
    navigation: any;
};

const Login = ({ navigation }: Props) => {
    //const ruta = "http://172.26.13.0:8080/api/v1/login";
    const ruta = "http://192.168.1.51:8080/api/v1/login";
    const { token, settoken } = useAppContext();
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");
    const [loading, setLoading] = useState(false);
    
    useEffect(() => {
        const verificarToken = async () => {
            try {
                const jsonValue = await AsyncStorage.getItem('token');
                const data = jsonValue != null ? JSON.parse(jsonValue) : null;
                console.log(data);

                if (data != null) {
                    navigation.navigate("DrawerGestion");
                }
            } catch (e) {
                console.error("Error al leer el token", e);
            }
        };

        verificarToken();
    }, [navigation]); 


    async function login() {

        const nuevoLogin: iLogin = {
            username: username,
            password: password
        }
        //navigation.navigate("DrawerGestion");
        console.log(nuevoLogin);

       


        const axiospost = async () => {
            try {
                setLoading(true);
                const response = await axios.post(ruta, nuevoLogin);
                console.log(response.data);
                let status = response.status;
                console.log(status);
                if (status === 200) {
                    settoken(response.data);
                    console.log("todo correcto");
                    const jsonValue = JSON.stringify(response.data);
                    console.log(jsonValue);
                    
                    await AsyncStorage.setItem('token', jsonValue);
                    navigation.navigate("DrawerGestion");
                }


            } catch (error) {
                if (error.response) {
                    // El servidor devolvió una respuesta con un código de estado fuera del rango 2xx
                    console.log(error.response.data); // Aquí puedes acceder a los detalles del error en el lado del servidor
                    setError(error.response.data || "Error desconocido"); // Puedes adaptar esto según la estructura de tu respuesta de error
                } else if (error.request) {
                    // La solicitud fue realizada pero no se recibió respuesta
                    console.log(error.request);
                    setError("No se recibió respuesta del servidor");
                } else {
                    // Hubo un error al configurar o realizar la solicitud
                    console.log(error.message);
                    setError("Error en la configuración o ejecución de la solicitud");
                }
            }finally {
                setLoading(false);
            }
        }
        axiospost();
    }

    return (
        <View>
            <Text>Username</Text>
            <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setUsername(texto)} />
            <Text>Password</Text>
            <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setPassword(texto)} />
            <Button title={loading ? 'Un momento...' : 'Login'} onPress={login} />
            <TouchableHighlight onPress={() => navigation.navigate("Registro")}>
                <Text>Registro</Text>
            </TouchableHighlight>

            {error ? <Text style={{ color: 'red' }}>{error}</Text> : null}
        </View>
    )
}

export default Login