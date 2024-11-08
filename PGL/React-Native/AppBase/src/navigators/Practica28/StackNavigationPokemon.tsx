import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { usePokemonContext } from '../../contexts/PokemonContextProvider';
import PokemonScreen from '../../screens/Practica28/PokemonScreen';
import PokemonCard from '../../components/Practica28/PokemonCard';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigationPokemon = (props: Props) => {
   

    return (
        <Stack.Navigator>
            <Stack.Screen name='Lista de Pokemon' component={PokemonScreen} />
            <Stack.Screen name='PokemonCard' component={PokemonCard} />
        </Stack.Navigator>
    )
}

export default StackNavigationPokemon

const styles = StyleSheet.create({})