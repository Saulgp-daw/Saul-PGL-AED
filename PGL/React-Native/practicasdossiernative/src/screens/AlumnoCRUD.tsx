import { View, Text } from 'react-native'
import React from 'react'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'

import Icon from 'react-native-vector-icons/Ionicons';
import AgregarAlumno from './AgregarAlumno';
import BorrarAlumno from './BorrarAlumno';
import StackAlumno from '../navigators/StackAlumno';

type Props = {}
const Tab = createBottomTabNavigator();

const AlumnoCRUD = (props: Props) => {
  return (
    <Tab.Navigator screenOptions={{ headerShown: false }} >
        <Tab.Screen name='Agregar' component={AgregarAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="list" size={30} />
                ),
            }}/>
            <Tab.Screen name='Buscar' component={StackAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="list" size={30} />
                ),
            }}/>
            <Tab.Screen name='Borrar' component={BorrarAlumno} options={{
                tabBarIcon: ({ color, size }) => (
                    <Icon name="list" size={30} />
                ),
            }}/>
            
    </Tab.Navigator>
  )
}

export default AlumnoCRUD