import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Practica31 from '../screens/Practica31';
import { NavigationContainer } from '@react-navigation/native';
import Articulo from '../components/Articulo';
import Practica31_2 from '../screens/Practica31Extra/Practica31_2';
import TabFeeds from './TabFeeds';
import TabNoticias from './TabNoticias';

type Props = {}
const Stack = createNativeStackNavigator();

const StackNoticias = (props: Props) => {
    return (
        <NavigationContainer>
            <Stack.Navigator>
                <Stack.Screen name='Feeds' component={TabFeeds} />
                <Stack.Screen name='TabNoticias' component={TabNoticias} />
                <Stack.Screen name='Articulo' component={Articulo} />
            </Stack.Navigator>
        </NavigationContainer>
    )
}

export default StackNoticias

const styles = StyleSheet.create({})