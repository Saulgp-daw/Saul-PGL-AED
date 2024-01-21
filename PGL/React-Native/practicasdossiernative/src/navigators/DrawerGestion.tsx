import { View, Text } from 'react-native'
import React from 'react'
import { createDrawerNavigator } from '@react-navigation/drawer'
import Perfil from '../screens/Perfil';
import CustomDrawer from '../components/CustomDrawer';
import TabAlumnoCRUD from './TabAlumnoCRUD';

type Props = {}

const Drawer = createDrawerNavigator();

const DrawerGestion = () => {
  return (
    <Drawer.Navigator drawerContent={(props) => <CustomDrawer {...props}/>}>
        <Drawer.Screen name='Perfil' component={Perfil}/>
        <Drawer.Screen name='TabAlumnoCRUD' component={TabAlumnoCRUD}/>
    </Drawer.Navigator>
  )
}

export default DrawerGestion