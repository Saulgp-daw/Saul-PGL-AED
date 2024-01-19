import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Login from '../screens/Login';


type Props = {}
const Stack = createNativeStackNavigator();

const StackNavigation = (props: Props) => {
    return (

        <Stack.Navigator>
            <Stack.Screen name='Login' component={Login} options={{ headerShown: false }} />
        </Stack.Navigator>

    )
}

export default StackNavigation

const styles = StyleSheet.create({})


