import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';
import CambiarPagina from '../components/CambiarPagina';
import StackNavigation from './StackNavigation';
import ListaFeeds from '../screens/Practica31Extra/ListaFeeds';
import CrearFeeds from '../screens/Practica31Extra/CrearFeeds';

import Icon from 'react-native-vector-icons/Ionicons';

const Tab = createBottomTabNavigator();

const TabFeeds = (props: any) => {
    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Listar Feeds' component={ListaFeeds} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="list" size={30} />
                ),
            }} />
            <Tab.Screen name='Crear Feed' component={CrearFeeds} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="add-circle" size={30} />
                ),
            }} />
        </Tab.Navigator>
    )
}

export default TabFeeds

const styles = StyleSheet.create({})