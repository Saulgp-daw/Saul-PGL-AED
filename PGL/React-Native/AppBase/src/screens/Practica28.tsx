import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { NavigationContainer } from '@react-navigation/native'
import TabPokemon from '../navigators/TabPokemon'
import usePokemon from '../hooks/usePokemon'
import PokemonContextProvider from '../contexts/PokemonContextProvider'

type Props = {}

const Practica28 = (props: Props) => {
    //usePokemon();

    return (
        <NavigationContainer>
            <PokemonContextProvider>
                <TabPokemon />
            </PokemonContextProvider>
        </NavigationContainer>
    )
}

export default Practica28

const styles = StyleSheet.create({})