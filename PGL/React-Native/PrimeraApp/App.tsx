/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */

import React, { useState } from 'react';
import type {PropsWithChildren} from 'react';
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

type SectionProps = PropsWithChildren<{
  title: string;
}>;



function App(): JSX.Element {
  const [contador, setContador] = useState(0);
  return (
    <View style={{
      flex: 1,
      borderWidth: 3,
      borderColor: "black",
      backgroundColor: "lightgray",
      margin: 1

    }}>
     <Text>Ejercicio Básico. Contador: {contador}</Text>
     <Button title="púlsame" onPress={() => setContador(contador+1)}/>
    </View>
  );
}

export default App;
