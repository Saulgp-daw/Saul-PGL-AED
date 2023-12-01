import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import StackNavigationPokemon from './Practica28/StackNavigationPokemon';
import { usePokemonContext } from '../contexts/PokemonContextProvider';
import StackNavigationBusqueda from './Practica28/StackNavigationBusqueda';

const Tab = createBottomTabNavigator();

const TabPokemon = (props: any) => {
    const { pokemon, setpokemon } = usePokemonContext();
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Pokemon' component={StackNavigationPokemon} />
            <Tab.Screen name='Pokedex' component={StackNavigationBusqueda} />
        </Tab.Navigator>
    )
}

export default TabPokemon

const styles = StyleSheet.create({})