import { Image, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { Raza } from "../models/Raza";
import { RouteProp } from '@react-navigation/native';

type RootStackParamList = {
    Perro: { doggo: Raza }
}

type GatoScreenRouteProp = RouteProp<RootStackParamList, "Perro">;

type Props = {
    navigation?: any;
    route?: GatoScreenRouteProp
}



const Gato = ({ navigation, route }: Props) => {
    const doggo = route?.params?.doggo;
    const calicoImage = '../resources/practica26/Gatos/bengali.jpg';
    console.log(doggo);

    return (
        <View style={{ flex: 1 }}>
            <Image source={require(calicoImage)} style={{ width: 150, height: 150 }} />
            <Text>{doggo?.getNombre()}</Text>
            <Text>{doggo?.getTipo()}</Text>
        </View>
    )
}

export default Gato

const styles = StyleSheet.create({})