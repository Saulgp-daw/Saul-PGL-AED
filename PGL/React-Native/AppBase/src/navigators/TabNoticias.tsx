import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';
import CambiarPagina from '../components/CambiarPagina';
import StackNavigation from './StackNavigation';
import ListaFeeds from '../screens/Practica31Extra/ListaFeeds';
import CrearFeeds from '../screens/Practica31Extra/CrearFeeds';
import ListaNoticiasNoVistas from '../screens/Practica31Extra/ListaNoticiasNoVistas';
import ListaNoticiasVistas from '../screens/Practica31Extra/ListaNoticiasVistas';
import { Feed } from '../data/entity/Feed';
import { RouteProp } from '@react-navigation/native';
import Icon from 'react-native-vector-icons/Ionicons';

const Tab = createBottomTabNavigator();

type RootStackParamList = {
    element: { miFeed: Feed }
}

type ScreenRouteProp = RouteProp<RootStackParamList, "element">;

type Props = {
    navigation?: any;
    route?: ScreenRouteProp
}

const TabNoticias = ({ route }: Props) => {
    const feed = route.params.miFeed;


    return (
        <Tab.Navigator screenOptions={{ headerShown: false }} >
            <Tab.Screen name='Vistas' options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="eye-off" size={30} />
                ),
            }}>
                {(props) => <ListaNoticiasNoVistas {...props} miFeed={feed} />}
            </Tab.Screen>
            <Tab.Screen name='No Vistas' options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="eye" size={30} />
                ),
            }}>
                {(props) => <ListaNoticiasVistas {...props} miFeed={feed} />}
            </Tab.Screen>
        </Tab.Navigator>
    )
}

export default TabNoticias

const styles = StyleSheet.create({})