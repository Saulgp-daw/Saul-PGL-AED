import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Login from '../../screens/Proyecto/Login';
import Busqueda from '../../screens/Proyecto/Busqueda';
import Piso from '../../screens/Proyecto/Piso';
import PerfilPublico from '../../screens/Proyecto/PerfilPublico';
import PerfilPrivado from '../../screens/Proyecto/PerfilPrivado';
import Registro from '../../screens/Proyecto/Registro';
import WatchList from '../../screens/Proyecto/WatchList';
type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigation = (props: Props) => {
    return (
        <Stack.Navigator>
            <Stack.Screen name='Login' component={Login} options={{ headerShown: false }} />
            <Stack.Screen name='Registro' component={Registro} options={{ headerShown: false }} />
            <Stack.Screen name='WatchList' component={WatchList} options={{ headerShown: false }} />
            <Stack.Screen name='Busqueda' component={Busqueda} options={{ headerShown: false }} />
            <Stack.Screen name='Piso' component={Piso} options={{ headerShown: false }} />
            <Stack.Screen name='PerfilPublico' component={PerfilPublico} options={{ headerShown: false }} />
            <Stack.Screen name='PerfilPrivado' component={PerfilPrivado} options={{ headerShown: false }} />
        </Stack.Navigator>
    )
}

export default StackNavigation

const styles = StyleSheet.create({

    darkMode: {
        backgroundColor: 'black'
    }
})