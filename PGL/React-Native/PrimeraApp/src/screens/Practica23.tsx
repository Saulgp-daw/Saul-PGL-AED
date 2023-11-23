import { Button, StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { useTareaContext } from '../contexts/TareaContextProvider'
import { Tarea } from '../models/Tarea'
import { FaRegSquare } from "react-icons/fa6";
import { FaRegCheckSquare } from "react-icons/fa";
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
                        <View key={tarea.getId()}>
                            {tarea.getCompletado() ?
                                (
                                    <div>
                                        <Text>Completada</Text>
                                        <Text>{tarea.getTitulo()}</Text>
                                    </div>
                                ) : (
                                    <div>
                                        <Text>Sin completar</Text>
                                        <Text>{tarea.getTitulo()}</Text>
                                    </div>
                                )
                            }
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