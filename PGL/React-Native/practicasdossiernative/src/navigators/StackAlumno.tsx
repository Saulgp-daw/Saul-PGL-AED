import { View, Text } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import BuscarAlumno from '../screens/BuscarAlumno';
import InfoAlumno from '../screens/InfoAlumno';
import ModificarAlumno from '../screens/ModificarAlumno';

type Props = {}
const Stack = createNativeStackNavigator();

const StackAlumno = (props: Props) => {
  return (
    <Stack.Navigator>
         <Stack.Screen name='BuscarAlumno' component={BuscarAlumno} options={{ headerShown: false }} />
         <Stack.Screen name='InfoAlumno' component={InfoAlumno} options={{ headerShown: false }} />
         <Stack.Screen name='ModificarAlumno' component={ModificarAlumno} options={{ headerShown: false }} />
    </Stack.Navigator>
  )
}

export default StackAlumno