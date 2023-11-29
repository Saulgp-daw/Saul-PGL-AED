import { Button, StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React from 'react'
import { useTareaContext } from '../contexts/TareaContextProvider'
import { Tarea } from '../models/Tarea'
import Icon from 'react-native-vector-icons/Ionicons';
import { SafeAreaView } from 'react-native-safe-area-context';
import useTarea from '../hooks/useTarea';
import AgregarTarea from '../components/AgregarTarea';


type Props = {
    navigation: any;
};


const Practica23 = ({ navigation }: Props) => {
    const { tareas, settareas } = useTareaContext();
    const {toggleCompletado, borrarTarea} = useTarea();

  

    return (
        <SafeAreaView style={{ flex: 1 }}>
            <View style={{ flex: 1 }}>
                <Text>Listado</Text>
                {
                    tareas.map(tarea => (
                        <View key={tarea.getId()} style={{ flex: 0.1, flexDirection: 'row', justifyContent: 'space-evenly' }}>
                             {/*<Text>{tarea.getId()}</Text>*/}
                            <TouchableOpacity  onPress={() => toggleCompletado(tarea)}>
                                {tarea.getCompletado() ? <Icon name="checkbox-outline" size={30}></Icon> : <Icon name="square-outline" size={30}></Icon>}
                            </TouchableOpacity >
                            {tarea.getCompletado() ?  <Text style={styles.tachado}>{tarea.getTitulo()}</Text> :  <Text>{tarea.getTitulo()}</Text>}
                            <TouchableOpacity><Icon onPress={() => navigation.navigate('AgregarTarea', {tareita: tarea} )} name='pencil-outline' size={30}></Icon></TouchableOpacity>
                            <TouchableOpacity><Icon onPress={() => borrarTarea(tarea.getId())} name='trash-outline' size={30}></Icon></TouchableOpacity>
                        </View>
                    ))
                }

            </View>
            <Button title='Agregar Tarea' onPress={() => navigation.navigate('AgregarTarea')}></Button>
        </SafeAreaView>
    )
}

export default Practica23

const styles = StyleSheet.create({
    tachado: {
        textDecorationLine: 'line-through',
        color: 'red', // Puedes ajustar el color según tus preferencias
      }
})