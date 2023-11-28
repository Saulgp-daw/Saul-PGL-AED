import { Button, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { useTareaContext } from '../contexts/TareaContextProvider'
import { Tarea } from '../models/Tarea'
import Icon from 'react-native-vector-icons/Ionicons';
import { SafeAreaView } from 'react-native-safe-area-context';


type Props = {
    navigation: any;
};


const Practica23 = ({ navigation }: Props) => {
    const { tareas, settareas } = useTareaContext();

    return (
        <SafeAreaView style={{ flex: 1 }}>
            <View style={{ flex: 1 }}>
                <Text>Listado</Text>
                {
                    tareas.map(tarea => (
                        <View key={tarea.getId()} style={{ flex: 0.1, flexDirection: 'row', justifyContent: 'space-evenly'}}>
                            {tarea.getCompletado() ? <Icon name="checkbox-outline" size={30}></Icon> : <Icon name="square-outline" size={30}></Icon>}
                            <Text>{tarea.getTitulo()}</Text>
                            <Icon name='pencil-outline' size={30}></Icon>
                            <Icon name='trash-outline' size={30}></Icon>
                            
                        </View>
                    ))
                }

            </View>
            <Button title='Agregar Tarea' onPress={() => navigation.navigate('AgregarTarea')}></Button>
        </SafeAreaView>
    )
}

export default Practica23

const styles = StyleSheet.create({})