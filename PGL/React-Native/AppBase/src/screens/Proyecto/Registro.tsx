import { Image, StyleSheet, Text, View, TextInput, Button, TouchableOpacity, ScrollView } from 'react-native';
import React from 'react'
import Navbar from '../../components/Proyecto/Navbar';
import Busqueda from './Busqueda';
import WatchList from './WatchList';

type Props = {
	navigation: any;
};

const Registro = ({ navigation }: Props) => {
	const logo = "../../resources/Proyecto/logo.jpeg";
	return (
		<ScrollView>
			<View style={styles.container}>
				<Image source={require(logo)} style={styles.logo} />
				<Text style={styles.h2}>Registro</Text>

				<View style={styles.inputContainer}>
					<Text>Email o nombre de usuario</Text>
					<TextInput placeholder='Ejm. marcelino@gmail.com' style={styles.textinput} />
				</View>
				<View style={styles.inputContainer}>
					<Text>Contraseña</Text>
					<TextInput placeholder='*************' style={styles.textinput} />
				</View>
				<View style={styles.inputContainer}>
					<Text>Repite Contraseña</Text>
					<TextInput placeholder='*************' style={styles.textinput} />
				</View>

				<View style={styles.inputContainer}>
					<Text>Nombre</Text>
					<TextInput placeholder='Ejm. Pepe' style={styles.textinput} />
				</View>

				<View style={styles.inputContainer}>
					<Text>Apellidos</Text>
					<TextInput placeholder='Ejm. Ramirez' style={styles.textinput} />
				</View>

				<View style={styles.inputContainer}>
					<Text>Apellidos</Text>
					<TextInput placeholder='Ejm. Ramirez' style={styles.textinput} />
				</View>



				<TouchableOpacity style={styles.btnEntrar} onPress={() => navigation.navigate(Busqueda)} >
					<Text>Registrarse</Text>
				</TouchableOpacity>

				<TouchableOpacity style={styles.btnEntrar} onPress={() => navigation.navigate(WatchList)} >
					<Text>WatchList</Text>
				</TouchableOpacity>

			</View>

		</ScrollView>
	);
};

export default Registro;

const styles = StyleSheet.create({
	container: {
		display: 'flex',
		justifyContent: 'center',
		alignItems: 'center',
	},

	logo: {
		marginTop: 50,
		height: 150,
		width: 150,
	},

	h2: {
		fontWeight: 'bold',
		fontSize: 23,
	},

	inputContainer: {
		marginTop: 10,
	},

	textinput: {
		width: 300,
		borderColor: 'purple',
		borderWidth: 2,
		borderRadius: 5,
		paddingHorizontal: 10,
	},

	btnEntrar: {
		backgroundColor: "#2bfc23",
		padding: 10,
		borderRadius: 5,
		marginTop: 10,

	}
});
