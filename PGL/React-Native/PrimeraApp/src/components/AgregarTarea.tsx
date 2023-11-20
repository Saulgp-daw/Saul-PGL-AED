import { StyleSheet, Text, TouchableHighlight, View } from 'react-native'
import React from 'react'

type Props = {}

const AgregarTarea = (props: Props) => {
    return (
        <TouchableHighlight>
            <View>
                <Text>Agregar tarea</Text>
            </View>
        </TouchableHighlight>
    )
}

export default AgregarTarea

const styles = StyleSheet.create({})