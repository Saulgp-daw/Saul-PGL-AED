import { StyleSheet, Switch, Text, View, TextInput } from 'react-native';
import React, { useState } from 'react'
import SwitchLabel from '../components/SwitchLabel';
import useAnexo from '../hooks/useAnexo';
import Icon from 'react-native-vector-icons/Ionicons';
type Props = {}





const Practica15 = (props: Props) => {
   const [jubilado, setJubilado] = useState(false);
    const {formdata, fillFormData} = useAnexo();

    return (
        <View style={{ flex: 1 }}>
            <SwitchLabel nombre={'jubilado'} setData={setJubilado} data={false} />
            <TextInput placeholder='nombre' onChangeText={(texto) => fillFormData(texto, "nombre")}/>
            <TextInput placeholder='edad' onChangeText={(texto) => fillFormData(texto, "edad")}/>
            <Text>
                {JSON.stringify(formdata)}
            </Text>
            <Icon name="color-fill" size={40}></Icon>
        </View>
    )
}

export default Practica15

const styles = StyleSheet.create({})