import { Button, SafeAreaView, StyleSheet, Text, View } from 'react-native'
import React from 'react'

type Props = {
    navigation: any;
};

const CambiarPagina = ({ navigation }: Props) => {

    return (
        <SafeAreaView style={{ flex: 1 }}>
            <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
                <Button title='Practica08' onPress={() => navigation.navigate('Practica08')}></Button>
                <Button title='Practica10' onPress={() => navigation.navigate('Practica10')}></Button>
            </View>
        </SafeAreaView>
    )
}

export default CambiarPagina

const styles = StyleSheet.create({})
