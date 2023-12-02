import { StyleSheet, Text, TouchableOpacity, View, FlatList } from 'react-native'
import React, { useEffect, useState } from 'react'
import * as rssParser from 'react-native-rss-parser';
import WebView from 'react-native-webview';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';

type Props = {
    navigation: any;
};

const Practica31 = ({ navigation }: Props) => {
    const [articulos, setArticulos] = useState<rssParser.Feed | undefined>();
    const uri: string = 'https://www.xataka.com/feedburner.xml';

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get(uri);
                const data = response.data;
                AsyncStorage.setItem(uri, JSON.stringify(data));
                const responseData = await rssParser.parse(data);
                //console.log(responseData);
                setArticulos(responseData);
            } catch (error) {
                const dat = await AsyncStorage.getItem(uri);
                if (dat) {
                    const data = JSON.parse(dat);
                    const responseData = await rssParser.parse(data);
                    setArticulos(responseData);
                }
            }
        };

        fetchData();
    }, [uri]);

    // useEffect(() => {
    //     console.log(articulos?.items);
    // }, [articulos]);


    return (
        <View style={styles.container}>
            {articulos && articulos.items ? (
                <FlatList data={articulos.items} renderItem={({ item }) => (
                    <TouchableOpacity
                        style={styles.elementos}
                        onPress={() => navigation.navigate('Articulo', { articulo: item.description })}
                    >
                        <Text style={styles.estiloTexto}>{item.title}</Text>
                    </TouchableOpacity>
                )} />
            ) : (
                <Text>No hay noticias cargadas</Text>
            )}
        </View>
    );


};


export default Practica31;

const styles = StyleSheet.create({
    container: {
        flex: 1,
    },

    elementos: {
        marginTop: 5,
    },

    estiloTexto: {
        color: "blue",
        textDecorationLine: "underline"

    }
})