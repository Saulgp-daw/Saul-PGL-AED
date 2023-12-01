import 'react-native-gesture-handler';


import React from 'react';
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

import {
	Colors,
	DebugInstructions,
	Header,
	LearnMoreLinks,
	ReloadInstructions,
} from 'react-native/Libraries/NewAppScreen';
import { NavigationContainer } from '@react-navigation/native';
import AgregarTarea from './src/components/AgregarTarea';
import TareaContextProvider from './src/contexts/TareaContextProvider';
import Practica23 from './src/screens/Practica23';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Practica26 from './src/screens/Practica26';
import RazaContextProvider from './src/contexts/RazaContextProvider';
import Practica28 from './src/screens/Practica28';

type SectionProps = PropsWithChildren<{
	title: string;
}>;

const Stack = createNativeStackNavigator();


//Practica 23
// function App(): JSX.Element {

//   return (
//     <NavigationContainer>
//       <TareaContextProvider>
//         <Stack.Navigator>
//           <Stack.Screen name="Tareas" component={Practica23} />
//           <Stack.Screen name="AgregarTarea" component={AgregarTarea} />
//         </Stack.Navigator>
//       </TareaContextProvider>
//     </NavigationContainer>
//   );
// }

//Practica 26
// function App(): JSX.Element {

// 	return (
// 		<NavigationContainer>
// 			<RazaContextProvider>
// 				<Practica26 />
// 			</RazaContextProvider>
// 		</NavigationContainer>
// 	);
// }

//Practica 28
function App(): JSX.Element {

	return (
		<Practica28/>
	);
}

export default App;
