import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';
import CambiarPagina from '../components/CambiarPagina';
import StackNavigation from './StackNavigation';
import ListaFeeds from '../screens/Practica31Extra/ListaFeeds';
import CrearFeeds from '../screens/Practica31Extra/CrearFeeds';

const Tab = createBottomTabNavigator();

const TabFeeds = (props: any) => {
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Listar Feeds' component={ListaFeeds} />
            <Tab.Screen name='Crear Feed' component={CrearFeeds} />
        </Tab.Navigator>
    )
}

export default TabFeeds

const styles = StyleSheet.create({})