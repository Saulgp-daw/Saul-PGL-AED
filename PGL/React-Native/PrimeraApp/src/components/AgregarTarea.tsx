import { Button, GestureResponderEvent, StyleSheet, Text, TextInput, TouchableHighlight, View } from 'react-native'
import React from 'react'

type Props = {}

const AgregarTarea = (props: Props) => {
    function crearTarea(event: GestureResponderEvent) {
        event.preventDefault();

    }

    return (
        <TouchableHighlight style={{ flex: 1 }}>
            <View style={{ flex: 1 }}>
                <Text style={{ flex: 0.1 }}>Agregar tarea</Text>
                <TextInput placeholder="Escribe aquí..." multiline={true} style={{ flex: 1, backgroundColor: "red", height: 450, textAlignVertical: 'top' }} numberOfLines={20} ></TextInput>
                <Button title='Finalizar edición' onPress={(e) => crearTarea(e)}></Button>
            </View>
        </TouchableHighlight>
    )
}

export default AgregarTarea

const styles = StyleSheet.create({})