import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createDrawerNavigator } from '@react-navigation/drawer';
import Busqueda from '../../screens/Proyecto/Busqueda';

type Props = {}
const Drawer = createDrawerNavigator();

const DrawerFlatner = (props: Props) => {
    return (
        <Drawer.Navigator>
            <Drawer.Screen name="Busqueda" component={Busqueda} />
        </Drawer.Navigator>
    )
}

export default DrawerFlatner

const styles = StyleSheet.create({})