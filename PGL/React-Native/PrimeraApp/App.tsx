/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */

import React, { useState } from 'react';
import type { PropsWithChildren } from 'react';
import Practica04 from './src/screens/Practica04';
import {
  Button,
  SafeAreaView,
  ScrollView,
  StatusBar,
  StyleSheet,
  Text,
  useColorScheme,
  View,
} from 'react-native';

import {
  Colors,
  DebugInstructions,
  Header,
  LearnMoreLinks,
  ReloadInstructions,
} from 'react-native/Libraries/NewAppScreen';
import Practica05 from './src/screens/Practica05';
import Practica08 from './src/screens/Practica08';
import Practica09 from './src/screens/Practica09';
import Practica10 from './src/screens/Practica10';
import Practica12 from './src/screens/Practica12';
import Practica15 from './src/screens/Practica15';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
type SectionProps = PropsWithChildren<{
  title: string;
}>;

type Props = {
  navigation: any;
};




function HomeScreen({navigation}: Props) {
  return (
    <SafeAreaView style={{ flex: 1 }}>
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text>Home Screen</Text>
        <Button title='Practica08' onPress={() => navigation.navigate('Practica08')}></Button>
        <Button title='Practica09' onPress={() => navigation.navigate('Practica09')}></Button>
      </View>
    </SafeAreaView>
  )
}

export type RootStackParamList = {
  Gatos: undefined;
  Home: undefined;
  Practica08: undefined;
  Practica09: undefined;
}
const Stack = createNativeStackNavigator<RootStackParamList>();



function App(): JSX.Element {
  return (
    <NavigationContainer>
      <Stack.Navigator>
        {/* se ponen todas las screen que queramos el navigation */}
        <Stack.Screen name="Home" component={HomeScreen} />
        <Stack.Screen name="Practica08" component={Practica08} />
        <Stack.Screen name="Practica09" component={Practica09} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default App;


// const [contador, setContador] = useState(0);
//   return (
//     <View style={{
//       flex: 1,
//       borderWidth: 3,
//       borderColor: "black",
//       backgroundColor: "lightgray",
//       margin: 1

//     }}>
//      <Text>Ejercicio Básico. Contador: {contador}</Text>
//      <Button title="púlsame" onPress={() => setContador(contador+1)}/>
//     </View>
//   );