import { View, Text, TextInput, Button, TouchableHighlight } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { useAppContext } from '../contexts/TokenContextProvider';
import { useNavigate } from 'react-router-dom';


export interface iRegistro {
    username: string,
    password: string,
    email: string
}

type Props = {
    navigation: any;
};

const Registro = ({ navigation }: Props) => {
    const ruta = "http://172.26.13.0:8080/api/v1/register";
    const { token, settoken } = useAppContext();
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [email, setEmail] = useState("");


    function registro() {

        const nuevoRegistro: iRegistro = {
            username: username,
            password: password,
            email: email
        }

        console.log(nuevoRegistro);

        const axiospost = async () => {
            try {

                const response = await axios.post(ruta, nuevoRegistro);
                console.log(response.data);
                let status = response.status;
                console.log(status);
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
            <Text>Registro</Text>
            <Text>Email</Text>
            <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setEmail(texto)} />
            <Text>Username</Text>
            <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setUsername(texto)} />
            <Text>Password</Text>
            <TextInput style={{ backgroundColor: "lightblue" }} onChangeText={(texto) => setPassword(texto)} />

            <Button title='Login' onPress={registro} />
            <TouchableHighlight onPress={() => navigation.navigate("Login")}>
                <Text>Login</Text>
            </TouchableHighlight>
        </View>
    )
}

export default Registro