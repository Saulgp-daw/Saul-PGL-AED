import { View, Text } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'

import Icon from 'react-native-vector-icons/Ionicons';
import AgregarAlumno from '../screens/AgregarAlumno';
import BorrarAlumno from '../screens/BorrarAlumno';
import StackAlumno from './StackAlumno';

type Props = {}
const Tab = createBottomTabNavigator();

const TabAlumnoCRUD = (props: Props) => {
  return (
    <Tab.Navigator screenOptions={{ headerShown: false }} >
        <Tab.Screen name='Agregar' component={AgregarAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="add-circle-outline" size={30} />
                  
                ),
            }}/>
            <Tab.Screen name='Buscar' component={StackAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="search-outline" size={30} />
                ),
            }}/>
            <Tab.Screen name='Borrar' component={BorrarAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="trash-outline" size={30} />
                ),
            }}/>
            
    </Tab.Navigator>
  )
}

export default TabAlumnoCRUD