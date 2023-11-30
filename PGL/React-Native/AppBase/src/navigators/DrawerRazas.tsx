import { createDrawerNavigator } from '@react-navigation/drawer';
import React from 'react'
import StackNavigationGatos from './StackNavigationGatos';
import StackNavigationPerros from './StackNavigationPerros';

type Props = {}

const Drawer = createDrawerNavigator();
const DrawerRazas = () => {
    return (
        <Drawer.Navigator>
            <Drawer.Screen name="Gatos" component={StackNavigationGatos} />
            <Drawer.Screen name="Perros" component={StackNavigationPerros} />
        </Drawer.Navigator>
    )
}
export default DrawerRazas