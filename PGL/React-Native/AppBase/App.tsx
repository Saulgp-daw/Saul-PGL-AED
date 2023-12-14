import 'react-native-gesture-handler';


import React, { useEffect, useState } from 'react';
import type { PropsWithChildren } from 'react';
import {
	Button,
	FlatList,
	ListRenderItemInfo,
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
import Practica31 from './src/screens/Practica31';
import StackNavigation from './src/navigators/Proyecto/StackNavigation';
import StackNoticias from './src/navigators/StackNoticias';
import { DataSource } from 'typeorm';
import { dataSource, NoticiaRepository, FeedRepository } from "./src/data/Database"
import { Persona } from './src/data/entity/Persona';
import Navbar from './src/components/Proyecto/Navbar';
import Login from './src/screens/Proyecto/Login';
import StackNoticias2 from './src/navigators/StackNoticias2';
import 'reflect-metadata';


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



//Practica 31
function App(): JSX.Element {
	useEffect(() => {
		async function iniciarDDBB() {
			await dataSource.initialize();
		}
		iniciarDDBB();
	}, [])

	return (
		<StackNoticias2 />
	);
}

// function App(): JSX.Element {
// 	const [personas, setPersonas] = useState<Persona[]>([]);
// 	async function grabar() {
// 		const array = ["Ana", "Martino", "Rebeca"];
// 		let neopersonas = [];
// 		for (let i = 0; i < 3; i++) {
// 			const randomPositionArray = Math.floor(array.length * Math.random());
// 			const nombre = array[randomPositionArray];
// 			const edad = Math.round(Math.random() * 100) + 1;
// 			const persona = {
// 				nombre: nombre,
// 				edad: edad
// 			};
// 			neopersonas.push(persona);
// 			await PersonaRepository.save(neopersonas);
// 			const newpersonas = await PersonaRepository.find();
// 			setPersonas(newpersonas);
// 		}
// 	}

// 	useEffect(() => {
// 		async function iniciarDDBB() {
// 			await dataSource.initialize();
// 		}
// 		iniciarDDBB();
// 	}, [])

// 	return (
// 		<View style={{ flex: 1 }}>
// 			<FlatList data={personas} renderItem={(p) => <Text>{p.item.id + " " + p.item.nombre}</Text>} keyExtractor={(it, index) => "" + index} />
// 			<Button title='Crear Personas' onPress={grabar} />

// 		</View>
// 	);
// }

//Practica 26
// function App(): JSX.Element {

// 	return (
// 		<NavigationContainer>
// 			<StackNavigation />

// 		</NavigationContainer>
// 	);
// }



export default App;
