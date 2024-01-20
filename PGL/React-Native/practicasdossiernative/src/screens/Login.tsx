import { View, Text, TextInput, Button, TouchableHighlight } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { useAppContext } from '../contexts/TokenContextProvider';
import { useNavigate } from 'react-router-dom';
import Registro from './Registro';


export interface iLogin {
    username: string,
    password: string
}

type Props = {
    navigation: any;
};

const Login = ({ navigation }: Props) => {
    const ruta = "http://172.26.13.0:8080/api/v1/login";
    const { token, settoken } = useAppContext();
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    useEffect(() => {
        console.log(username);

    }, [username]);



    function login() {

        const nuevoLogin: iLogin = {
            username: username,
            password: password
        }
        navigation.navigate("DrawerGestion");
        console.log(nuevoLogin);

        const axiospost = async () => {
            try {

                const response = await axios.post(ruta, nuevoLogin);
                console.log(response.data);
                let status = response.status;
                console.log(status);
                //navigation.navigate("DrawerGestion");
                if (status === 200) {
                    settoken(response.data);
                    console.log("todo correcto");
                    //navigate("/");
                }


            } catch (error) {
                console.log(error);
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
            <Button title='Login' onPress={login} />
            <TouchableHighlight onPress={() => navigation.navigate("Registro")}>
                <Text>Registro</Text>
            </TouchableHighlight>
        </View>
    )
}

export default Login