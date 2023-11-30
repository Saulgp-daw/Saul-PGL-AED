import { Image, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { Raza } from "../models/Raza";
import { RouteProp } from '@react-navigation/native';

type RootStackParamList = {
    Gato: { michi: Raza }
}

type GatoScreenRouteProp = RouteProp<RootStackParamList, "Gato">;

type Props = {
    navigation?: any;
    route?: GatoScreenRouteProp
}



const Gato = ({ navigation, route }: Props) => {
    const michi = route?.params?.michi;
    const calicoImage = '../resources/practica26/Gatos/bengali.jpg';

    return (
        <View style={{ flex: 1 }}>
            <Image source={require(calicoImage)} style={{ width: 150, height: 150 }} />
            <Text>{michi?.getNombre()}</Text>
            <Text>{michi?.getTipo()}</Text>
        </View>
    )
}

export default Gato

const styles = StyleSheet.create({})