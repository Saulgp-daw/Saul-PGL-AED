import { Image, StyleSheet, Text, View, TextInput, Button, TouchableOpacity } from 'react-native';
import React from 'react'
import Navbar from '../../components/Proyecto/Navbar';
import Busqueda from './Busqueda';
import Registro from './Registro';

type Props = {
	navigation: any;
};

const Login = ({ navigation }: Props) => {
	const logo = "../../resources/Proyecto/logo.jpeg";
	return (
		<View style={styles.container}>
			<Image source={require(logo)} style={styles.logo} />
			<Text style={styles.h2}>Login</Text>
			<Text>Bienvenido de vuelta</Text>

			<View style={styles.inputContainer}>
				<Text>Email o nombre de usuario</Text>
				<TextInput placeholder='Ejm. marcelino@gmail.com' style={styles.textinput} />
			</View>

			<View style={styles.inputContainer}>
				<Text>Contraseña</Text>
				<TextInput placeholder='*************' style={styles.textinput} />
			</View>
			

			<TouchableOpacity style={styles.btnEntrar} onPress={() => navigation.navigate(Busqueda)} >
				<Text>Entrar</Text>
			</TouchableOpacity>
			<TouchableOpacity style={styles.btnEntrar} onPress={() => navigation.navigate(Registro)} >
				<Text>Registro</Text>
			</TouchableOpacity>
		</View>
	);
};

export default Login;

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
