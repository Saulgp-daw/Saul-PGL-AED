import { StyleSheet, Text, View, TouchableOpacity, Image, ScrollView, FlatList, TextInput } from 'react-native';
import React, { useState } from 'react'
import { PokemonData, usePokemonContext } from '../../contexts/PokemonContextProvider';

type Props = {
    navigation: any;
}

const PokemonScreen = ({ navigation }: Props) => {
    const { pokemon } = usePokemonContext();
    const [ filtrado, setFiltrado] = useState<PokemonData[]>(pokemon);




    return (
        <View style={{ flex: 1 }}>
          <TextInput style={{ backgroundColor: "#6da2f7" }} placeholder='Busca aquí por nombre'></TextInput>
        <FlatList
          data={pokemon}
          renderItem={({ item }) => (
            <TouchableOpacity
              key={item.dexEntry}
              style={{ flex: 1, flexDirection: 'row', justifyContent: 'center', alignItems: 'center' }}
              onPress={() => navigation.navigate("PokemonCard", { poke: item })}
            >
              <Image source={{ uri: item.mini_sprite }} style={{ width: 50, height: 50, resizeMode: 'contain' }} />
              <Text style={{ fontSize: 20, color: "red" }}>#{item.dexEntry}</Text>
              <Text style={{ fontSize: 20 }}> - {item.nombre}</Text>
            </TouchableOpacity>
          )}
        />
      </View>
    )
}

export default PokemonScreen

const styles = StyleSheet.create({})