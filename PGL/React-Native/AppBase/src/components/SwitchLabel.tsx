import { StyleSheet, Switch, Text, View } from 'react-native'
import React, { useState } from 'react'

type Props = {
    nombre: string,
    setData: Function,
    data: boolean
}

const SwitchLabel = (props: Props) => {
    const { nombre, data, setData } = props;

    function establecerData() {
      setData(!data);
      
    }
    return (
        <View style={{ flexDirection: 'row', marginTop: 2 }}>
            <Text>{nombre}</Text>
            <Switch onValueChange={() => establecerData()} value={data} />

        </View>
    )
}

export default SwitchLabel

const styles = StyleSheet.create({})