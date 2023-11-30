import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';
import CambiarPagina from '../components/CambiarPagina';
import StackNavigation from './StackNavigation';

const Tab = createBottomTabNavigator();

const TabPokemon = (props: any) => {
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='StackNavigation' component={StackNavigation} />
            <Tab.Screen name='Practica05' component={Practica05} />
        </Tab.Navigator>
    )
}

export default TabPokemon

const styles = StyleSheet.create({})