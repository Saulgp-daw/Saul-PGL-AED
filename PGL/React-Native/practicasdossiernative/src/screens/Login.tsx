import { View, Text, TextInput, Button } from 'react-native'
import React, { useEffect, useState } from 'react'
import axios from 'axios';

type Props = {}

const Login = (props: Props) => {
    const ruta = "http://172.26.13.0:8080/api/v1/login";
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    useEffect(() => {
        console.log(username);

    }, [username]);

    function login() {
        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, {});
                console.log(response.data);
                let status = response.status;
                console.log(status);
                // if (status === 200) {
                //     settoken(response.data);
                //     navigate("/");
                // }


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
        </View>
    )
}

export default Login