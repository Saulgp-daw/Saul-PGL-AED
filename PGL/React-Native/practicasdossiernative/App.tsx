/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */
import 'react-native-gesture-handler';
import React, { useEffect } from 'react';
import type { PropsWithChildren } from 'react';

import {
  SafeAreaView,
  ScrollView,
  StatusBar,
  StyleSheet,
  Text,
  useColorScheme,
  View,
} from 'react-native';
import StackNavigation from './src/navigators/StackNavigation';
import { NavigationContainer } from '@react-navigation/native';

//import { dataSource } from './src/data/Database';


function App(): JSX.Element {

  // useEffect(() => {
  //   async function iniciarDDBB(){
  //     await dataSource.initialize();
  //   }
  //   iniciarDDBB();
  // }, []);


  return (
    <NavigationContainer>
      <StackNavigation />
    </NavigationContainer>

  );
}

export default App;
