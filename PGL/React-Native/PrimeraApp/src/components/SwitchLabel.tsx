import { StyleSheet, Switch, Text, View } from 'react-native'
import React, { useState } from 'react'

type Props = {
    nombre: string,
    setData: Function
}

const SwitchLabel = (props: Props) => {
    const [dato, setDato] = useState(false);

    function establecerData(){
        props.setData(!dato);
        setDato(!dato);
    }
    return (
        <View style={{ flexDirection: 'row', marginTop: 2 }}>
            <Text>{props.nombre}</Text>
            <Switch onValueChange={() => establecerData()} value={dato} />

        </View>
    )
}

export default SwitchLabel

const styles = StyleSheet.create({})