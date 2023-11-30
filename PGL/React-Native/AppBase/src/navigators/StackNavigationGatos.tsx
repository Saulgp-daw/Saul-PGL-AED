import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import GatosScreen from '../screens/GatosScreen';
import Gato from '../components/Gato';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigationGatos = (props: Props) => {
    return (
        <Stack.Navigator>
            <Stack.Screen name='Razas de gatos' component={GatosScreen} />
            <Stack.Screen name='Gato' component={Gato} />
        </Stack.Navigator>
    )
}

export default StackNavigationGatos

const styles = StyleSheet.create({})