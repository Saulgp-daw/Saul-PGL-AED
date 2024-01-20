import { View, Text } from 'react-native'
import React from 'react'
import { createDrawerNavigator } from '@react-navigation/drawer'
import Perfil from '../screens/Perfil';
import AlumnoCRUD from '../screens/AlumnoCRUD';

type Props = {}

const Drawer = createDrawerNavigator();

const DrawerGestion = () => {
  return (
    <Drawer.Navigator>
        <Drawer.Screen name='Perfil' component={Perfil}/>
        <Drawer.Screen name='AlumnoCRUD' component={AlumnoCRUD}/>
    </Drawer.Navigator>
  )
}

export default DrawerGestion