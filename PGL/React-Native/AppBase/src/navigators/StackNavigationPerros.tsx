import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import PerrosScreen from '../screens/PerrosScreen';
import Perro from '../components/Perro';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigationPerros = (props: Props) => {
    return (
        <Stack.Navigator>
            <Stack.Screen name='Razas de perros' component={PerrosScreen} />
            <Stack.Screen name='Perro' component={Perro} />
        </Stack.Navigator>
    )
}

export default StackNavigationPerros

const styles = StyleSheet.create({})