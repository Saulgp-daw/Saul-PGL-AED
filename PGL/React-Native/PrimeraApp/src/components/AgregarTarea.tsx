import { Button, GestureResponderEvent, StyleSheet, Text, TextInput, TouchableHighlight, View } from 'react-native'
import React, { useEffect, useState } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context';
import SwitchLabel from './SwitchLabel';
import { useTareaContext } from '../contexts/TareaContextProvider';
import { Tarea } from '../models/Tarea';

type Props = {}

const AgregarTarea = (props: Props) => {
    const [completada, setCompletada] = useState(false);
    const { tareas, settareas } = useTareaContext();
    const [titulo, setTitulo] = useState<string>("");
    const [descripcion, setDescripcion] = useState<string>("");

    function crearTarea(event: GestureResponderEvent) {
        event.preventDefault();
        console.log(completada);

        if (titulo.trim() != "" && descripcion.trim() != "") {
            const nuevaTarea: Tarea = new Tarea(tareas.length, titulo, descripcion, completada);
            settareas([...tareas, nuevaTarea]);
        }


    }

    useEffect(() => {
        console.log(titulo);

    }, [titulo]);

    return (
        <TouchableHighlight style={{ flex: 1 }}>
            <SafeAreaView style={{ flex: 1 }}>
                <View style={{ flex: 1 }}>
                    <SwitchLabel nombre={'Completado'} setData={setCompletada} />
                    <TextInput placeholder='Titulo' style={styles.titulo} defaultValue={titulo} onChangeText={(nuevoValor) => setTitulo(nuevoValor)}></TextInput>
                    <TextInput placeholder="Escribe aquí..." multiline={true} style={styles.descripcion} numberOfLines={20} defaultValue={descripcion} onChangeText={(nuevoValor) => setDescripcion(nuevoValor)} ></TextInput>
                </View>
                <Button title='Finalizar edición' onPress={(e) => crearTarea(e)}></Button>
            </SafeAreaView>
        </TouchableHighlight>
    )
}

export default AgregarTarea

const styles = StyleSheet.create({
    titulo: {
        backgroundColor: "#ff8a82",
        flex: 0.1
    },
    descripcion: {
        backgroundColor: "#9dd0fc",
        flex: 1,
        textAlignVertical: "top"
    }

})