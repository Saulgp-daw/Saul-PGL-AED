import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Login from '../screens/Login';
import Registro from '../screens/Registro';
import TokenContextProvider from '../contexts/TokenContextProvider';
import DrawerGestion from './DrawerGestion';



type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigation = (props: Props) => {
    return (

        <TokenContextProvider>
            <Stack.Navigator>
                <Stack.Screen name='Login' component={Login} options={{ headerShown: false }} />
                <Stack.Screen name='Registro' component={Registro} options={{ headerShown: false }} />
                <Stack.Screen name='DrawerGestion' component={DrawerGestion} options={{ headerShown: false }}/>
            </Stack.Navigator>
        </TokenContextProvider>

    )
}

export default StackNavigation

const styles = StyleSheet.create({})


