import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
//import { RootStackParamList } from '../../App';
import Practica04 from '../screens/Practica04';
import Practica10 from '../screens/Practica10';
import CambiarPagina from '../components/CambiarPagina';
import Practica08 from '../screens/Practica08';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigation = (props: Props) => {
    return (
        <Stack.Navigator>
            <Stack.Screen name='CambiarPagina' component={CambiarPagina} />
            <Stack.Screen name='Practica08' component={Practica08} />
            <Stack.Screen name='Practica10' component={Practica10} />
        </Stack.Navigator>
    )
}

export default StackNavigation

const styles = StyleSheet.create({})