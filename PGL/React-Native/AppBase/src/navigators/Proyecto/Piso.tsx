import { ScrollView, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import Slider from '../../components/Proyecto/Slider'
import Navbar from '../../components/Proyecto/Navbar'
import Icon from 'react-native-vector-icons/Fontisto';

type Props = {}

const Piso = (props: Props) => {
    const electrodomesticos: string[] = ["Nevera", "Microondas", "Horno", "Plancha", "Cafetera", "Lavadora", "Lavavajillas", "Secadora", "TV"];

    return (
        <View style={styles.container}>
            <Navbar />
            <ScrollView style={styles.container} >
                <Slider images={[
                    { id: 1, source: require('../../resources/Proyecto/piso1.jpg') },
                    { id: 2, source: require('../../resources/Proyecto/piso1-2.jpg') },
                    { id: 3, source: require('../../resources/Proyecto/piso1-3.jpg') },
                    // Agrega más imágenes según sea necesario
                ]} />
                <View style={styles.datosContainer}>
                    <Text style={styles.infoRelevante} >Titulo</Text>
                    <Text style={styles.infoRelevante}>Precio €</Text>
                </View>
                <View style={styles.datosContainer}>
                    <Text>Nº Hab</Text>
                    <Text>Nº inquilinos</Text>
                    <Text>Propietario</Text>
                </View>
                <View>
                    <Text>Detalles: </Text>
                    <View style={styles.detallesContainer}>
                        {electrodomesticos.map((electro, index) => (
                            <View key={index} style={styles.detallesItem}>
                                {index % 4 === 0 && index !== 0 && <View style={styles.lineBreak} />}
                                <Text>
                                    {Math.round(Math.random()) ? <Icon name='checkbox-active' /> : <Icon name='checkbox-passive' />} {electro}
                                </Text>
                            </View>
                        ))}
                    </View>
                </View>
            </ScrollView>

        </View>
    )
}

export default Piso

const styles = StyleSheet.create({
    container: {
        flex: 1
    },
    datosContainer: {
        marginTop: 10,
        display: 'flex',
        flexDirection: 'row',
        justifyContent: 'space-between'
    },
    infoRelevante: {
        fontWeight: 'bold',
        fontSize: 20
    },
    detallesContainer: {
        display: 'flex',
        flexDirection: 'row',
        flexWrap: 'wrap',  // Permite el "reborde" de elementos en una nueva línea
        alignItems: 'center', // Alinea los elementos en el centro del contenedor
    },
    detallesItem: {
        marginRight: 10, // Espaciado entre los elementos
        marginBottom: 0, // Espaciado entre las líneas
        flexDirection: 'row', // Asegura que el icono y el texto estén en la misma fila
        alignItems: 'center', // Alinea los elementos en el centro de su contenedor
    },
    lineBreak: {
        width: '100%', // Ocupa el ancho completo para forzar un salto de línea
    },
})