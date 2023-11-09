/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */

import React, { useState } from 'react';
import type {PropsWithChildren} from 'react';
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

type SectionProps = PropsWithChildren<{
  title: string;
}>;



function App(): JSX.Element {
  return(
    <View style={{flex:1}}>
      <Practica15/>
    </View>
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