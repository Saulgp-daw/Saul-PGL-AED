import { Image, StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React from 'react'
import { NativeStackScreenProps } from '@react-navigation/native-stack'
import { useRazaContext } from '../contexts/RazaContextProvider';
import { Raza } from '../models/Raza';


type Props = {
    navigation: any;
}

const PerrosScreen = ({ navigation }: Props) => {
    const { razas, setrazas } = useRazaContext();
    const perros: Array<Raza> = razas[0];

    console.log(perros);

    return (
        <View style={{ flex: 1, justifyContent: 'flex-start', alignItems: 'center' }}>
            {perros.map((perro: Raza, index: number) => (
                <TouchableOpacity key={index} style={{ flex: 0.2 }} onPress={() => navigation.navigate("Perro", { doggo: perro })}>
                    <Text>{perro.getNombre()}</Text>
                </TouchableOpacity>
            ))}
        </View>
    )
}

export default PerrosScreen

const styles = StyleSheet.create({})