import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import StylesP10 from '../themes/CalculadoraStyles'
import Boton from '../components/Boton'
import usePractica10 from '../hooks/usePractica10'

type Props = {}

const Practica10 = (props: Props) => {
    const {botones} = usePractica10();

    return (
        <View style={StylesP10.main}>
            <View style={StylesP10.estilo}></View>
            <View style={StylesP10.estiloBotones}>
                {
                    botones.map(boton => {
                        if(boton == "0"){
                            return <Boton elemento={boton} width={150} colour={'RGB(173, 181, 189)'} />
                        }else{
                            return <Boton elemento={boton} width={70} colour={'RGB(245, 159, 0)'} />
                        }
                        
                    })
                }
            </View>
        </View>
    )
}

export default Practica10