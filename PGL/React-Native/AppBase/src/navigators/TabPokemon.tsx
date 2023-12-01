import { Image, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import StackNavigationPokemon from './Practica28/StackNavigationPokemon';
import { usePokemonContext } from '../contexts/PokemonContextProvider';
import StackNavigationBusqueda from './Practica28/StackNavigationBusqueda';
import { SvgUri } from 'react-native-svg';

const Tab = createBottomTabNavigator();

const TabPokemon = (props: any) => {
    const { pokemon, setpokemon } = usePokemonContext();
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Pokemon' component={StackNavigationPokemon} options={{
                tabBarLabel: 'Pokemon',
                tabBarIcon: ({ size }) => (
                    <Image
                        source={require('../resources/practica28/pokeball.svg')}
                        style={{ width: size, height: size }}
                    />
                ),
            }} />
            <Tab.Screen name='Pokedex' component={StackNavigationBusqueda} options={{
                tabBarLabel: 'Pokedex',
                tabBarIcon: ({ size }) => (
                    <Image
                        source={require('../resources/practica28/pokedex.png')}
                        style={{ width: size, height: size }}
                    />
                ),
            }} />
        </Tab.Navigator>
    )
}

export default TabPokemon

const styles = StyleSheet.create({})