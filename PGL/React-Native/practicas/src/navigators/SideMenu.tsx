import { createDrawerNavigator } from '@react-navigation/drawer';
import React from 'react'
import Practica04 from '../screens/Practica04';
import Practica05 from '../screens/Practica05';

type Props = {}

const Drawer = createDrawerNavigator();
const SideMenu = () => {
    return (
        <Drawer.Navigator>
            <Drawer.Screen name="Pantalla1" component={Practica04} />
            <Drawer.Screen name="Pantalla2" component={Practica05} />
        </Drawer.Navigator>
    )
}
export default SideMenu