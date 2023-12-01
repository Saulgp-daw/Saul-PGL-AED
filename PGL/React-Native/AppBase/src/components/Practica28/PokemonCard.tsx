import { Image, ScrollView, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { PokemonData } from '../../contexts/PokemonContextProvider';
import { RouteProp } from '@react-navigation/native';

type RootStackParamList = {
	element: { poke: PokemonData }
}

type ScreenRouteProp = RouteProp<RootStackParamList, "element">;

type Props = {
	navigation?: any;
	route?: ScreenRouteProp
}



const PokemonCard = ({ navigation, route }: Props) => {
	const poke = route?.params.poke;
	console.log(poke);

	return (
		<View style={{ flex: 1 }}>
			<Image source={{ uri: poke?.render }} style={{ width: 200, height: 200, resizeMode: 'contain' }} />
			<Text style={{ fontSize: 30 }}>#{poke?.dexEntry}</Text>
			
			<View style={{  flexDirection: 'row'}}>
			<Text>Tipo: </Text>
				{
					poke?.tipo.map(tipo => (
						<Text key={tipo}>{tipo} </Text>
					))
				}
			</View>
			<Text>Habilidades: {poke?.habilidad.join(', ')}</Text>

			<ScrollView horizontal={true} showsHorizontalScrollIndicator={true}>
				<View style={{ flexDirection: 'row' }}>
					{poke?.sprites.map((sprite, index) => (
						<Image key={index} source={{ uri: sprite }} style={{ width: 200, height: 200, resizeMode: 'contain', marginRight: 10 }} />
					))}
				</View>
			</ScrollView>



		</View>
	)
}

export default PokemonCard

const styles = StyleSheet.create({})