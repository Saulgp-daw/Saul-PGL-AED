import { StyleSheet, Text, View, TouchableOpacity, Image, ScrollView, FlatList } from 'react-native';
import React from 'react'
import { usePokemonContext } from '../../contexts/PokemonContextProvider';

type Props = {
    navigation: any;
}

const PokemonScreen = ({ navigation }: Props) => {
    const { pokemon } = usePokemonContext();


    return (
        <View style={{ flex: 1 }}>
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