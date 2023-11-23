import { Button, GestureResponderEvent, StyleSheet, Text, TextInput, TouchableHighlight, View } from 'react-native'
import React, { useState } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context';
import SwitchLabel from './SwitchLabel';
import { useTareaContext } from '../contexts/TareaContextProvider';

type Props = {}

const AgregarTarea = (props: Props) => {
    const [completada, setCompletada] = useState(false);
    const { tareas, settareas } = useTareaContext();

    function crearTarea(event: GestureResponderEvent) {
        event.preventDefault();
        console.log(completada);



    }

    return (
        <TouchableHighlight style={{ flex: 1 }}>
            <SafeAreaView style={{ flex: 1 }}>
                <View style={{ flex: 1 }}>
                    <Text style={{ flex: 0.1 }}>Agregar tarea</Text>
                    <SwitchLabel nombre={'Completado'} setData={setCompletada} />
                    <TextInput placeholder='Titulo' style={{ flex: 0.1, backgroundColor: "blue" }}></TextInput>
                    <TextInput placeholder="Escribe aquí..." multiline={true} style={{ flex: 1, backgroundColor: "red", height: 450, textAlignVertical: 'top' }} numberOfLines={20} ></TextInput>

                </View>
                <Button title='Finalizar edición' onPress={(e) => crearTarea(e)}></Button>
            </SafeAreaView>
        </TouchableHighlight>
    )
}

export default AgregarTarea

const styles = StyleSheet.create({})