import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';
import CambiarPagina from '../components/CambiarPagina';
import StackNavigation from './StackNavigation';
import StackNavigationPokemon from './Practica28/StackNavigationPokemon';
import { usePokemonContext } from '../contexts/PokemonContextProvider';

const Tab = createBottomTabNavigator();

const TabPokemon = (props: any) => {
    const { pokemon, setpokemon } = usePokemonContext();
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Pokemon' component={StackNavigationPokemon} />
            <Tab.Screen name='Practica05' component={Practica05} />
        </Tab.Navigator>
    )
}

export default TabPokemon

const styles = StyleSheet.create({})