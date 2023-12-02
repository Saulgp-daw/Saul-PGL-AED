import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
//import { RootStackParamList } from '../../App';
import Practica04 from '../screens/Practica04';
import Practica10 from '../screens/Practica10';
import CambiarPagina from '../components/CambiarPagina';
import Practica08 from '../screens/Practica08';
import Practica31 from '../screens/Practica31';
import { NavigationContainer } from '@react-navigation/native';
import Articulo from '../components/Articulo';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNoticias = (props: Props) => {
    return (
        <NavigationContainer>
            <Stack.Navigator>
                <Stack.Screen name='Lista Noticias' component={Practica31} />
                <Stack.Screen name='Articulo' component={Articulo} />
            </Stack.Navigator>
        </NavigationContainer>
    )
}

export default StackNoticias

const styles = StyleSheet.create({})