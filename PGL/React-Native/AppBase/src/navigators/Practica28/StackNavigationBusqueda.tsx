import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import PokemonCard from '../../components/Practica28/PokemonCard';
import PokedexScreen from '../../screens/Practica28/PokedexScreen';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigationBusqueda = (props: Props) => {
   

    return (
        <Stack.Navigator>
            <Stack.Screen name='Lista de Pokemon' component={PokedexScreen} />
            <Stack.Screen name='PokemonCard' component={PokemonCard} />
        </Stack.Navigator>
    )
}

export default StackNavigationBusqueda

const styles = StyleSheet.create({})