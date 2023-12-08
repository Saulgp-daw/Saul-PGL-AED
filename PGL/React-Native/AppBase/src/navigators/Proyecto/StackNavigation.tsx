import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Login from '../../screens/Proyecto/Login';
import Busqueda from '../../screens/Proyecto/Busqueda';
import Piso from './Piso';
type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigation = (props: Props) => {
    return (
        <Stack.Navigator>
            <Stack.Screen name='Login' component={Login} />
            <Stack.Screen name='Busqueda' component={Busqueda} />
            <Stack.Screen name='Piso' component={Piso} />
        </Stack.Navigator>
    )
}

export default StackNavigation

const styles = StyleSheet.create({})