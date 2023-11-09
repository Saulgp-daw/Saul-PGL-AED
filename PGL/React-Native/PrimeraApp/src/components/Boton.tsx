import { StyleSheet, Text, TouchableHighlight, View } from 'react-native'
import React from 'react'
import StylesP10 from '../themes/CalculadoraStyles'

type Props = {
    elemento: string,
    width: number,
    colour: string
}

const Boton = (props: Props) => {
    const texto: string = props.elemento;
    const width: number = props.width;
    const colour: string = props.colour;

    return (
        <TouchableHighlight>
            <View style={{ ...StylesP10.botones, width: width, backgroundColor: colour }}>
                <Text style={StylesP10.textoBotones}>{texto}</Text>
            </View>
        </TouchableHighlight>
    )
}

export default Boton

const styles = StyleSheet.create({})