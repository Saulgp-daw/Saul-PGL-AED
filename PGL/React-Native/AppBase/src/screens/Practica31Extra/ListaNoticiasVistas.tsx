import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { Feed } from '../../data/entity/Feed'

type Props = {
    miFeed: Feed
}

const ListaNoticiasNoVistas = ({ miFeed }: Props) => {
    const feed = miFeed;
    console.log(feed);


    return (
        <View>
            <Text>Lista Noticias Vistas</Text>
        </View>
    )
}

export default ListaNoticiasNoVistas

const styles = StyleSheet.create({})