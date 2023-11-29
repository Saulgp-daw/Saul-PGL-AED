import { Alert, Button, GestureResponderEvent, StyleSheet, Text, TextInput, TouchableHighlight, View } from 'react-native'
import React, { useEffect, useState } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context';
import SwitchLabel from './SwitchLabel';
import { useTareaContext } from '../contexts/TareaContextProvider';
import { Tarea } from '../models/Tarea';
import { useRoute } from '@react-navigation/native';
import { RouteProp } from '@react-navigation/native';

type RootStackParamList = {
    AgregarTarea: { tareita?: Tarea }; // Define la forma de los parámetros de la ruta
};

type AgregarTareaScreenRouteProp = RouteProp<RootStackParamList, 'AgregarTarea'>;

type Props = {
    navigation?: any;
    route?: AgregarTareaScreenRouteProp;
};

const AgregarTarea = ({ navigation, route }: Props) => {
    const tareita = route?.params?.tareita;
    const { tareas, settareas } = useTareaContext();
    const [titulo, setTitulo] = useState(tareita?.getTitulo() || "");
    const [descripcion, setDescripcion] = useState(tareita?.getContenido() || "");
    const [completada, setCompletada] = useState(tareita?.getCompletado() || false);

    function obtenerId(): number {
        let id: number = 0;
        if (tareas.length > 0) {
            id = tareas[tareas.length - 1].getId() + 1;
        }
        return id;
    }

    function crearTarea(event: GestureResponderEvent) {
        event.preventDefault();

        if (titulo.trim() != "" && descripcion.trim() != "") {
            const nuevaTarea = tareita ? new Tarea(tareita.getId(), titulo, descripcion, completada) : new Tarea(obtenerId(), titulo, descripcion, completada);
            const nuevasTareas = tareita ? tareas.map(t => (t.getId() === tareita.getId() ? nuevaTarea : t)) : [...tareas, nuevaTarea];
            settareas(nuevasTareas);
            navigation.goBack();
        } else {
            Alert.alert("Hubieron datos sin rellenar");
        }
    }


    return (
        <TouchableHighlight style={{ flex: 1 }}>
            <SafeAreaView style={{ flex: 1 }}>
                <View style={{ flex: 1 }}>
                    <SwitchLabel nombre={'Completado'} data={completada} setData={setCompletada} />
                    <TextInput placeholder='Titulo' style={styles.titulo} defaultValue={tareita?.getTitulo()} onChangeText={(nuevoValor) => setTitulo(nuevoValor)}></TextInput>
                    <TextInput placeholder="Escribe aquí..." multiline={true} style={styles.descripcion} numberOfLines={20} defaultValue={tareita?.getContenido()} onChangeText={(nuevoValor) => setDescripcion(nuevoValor)} ></TextInput>
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