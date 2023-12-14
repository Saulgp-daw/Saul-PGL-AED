import { Button, StyleSheet, Text, TextInput, TextInputChangeEventData, View } from 'react-native'
import React, { useState } from 'react'
import axios from 'axios';
import * as rssParser from 'react-native-rss-parser';
import { Feed } from '../../data/entity/Feed';
import { FeedRepository, NoticiaRepository } from '../../data/Database';
import { Noticia } from '../../data/entity/Noticia';

type Props = {}

const CrearFeeds = (props: Props) => {
    const [titulo, setTitulo] = useState<string>();
    const [url, setUrl] = useState<string>();
    const [feeds, setFeeds] = useState<Feed[]>();




    async function crearFeed() {
        let nuevaFeed = new Feed();
        nuevaFeed.title = titulo;
        nuevaFeed.url = url;

        const savedFeed = await FeedRepository.save(nuevaFeed);


        try {
            const response = await axios.get(url);
            const data = response.data;
            const responseData = await rssParser.parse(data);

            for (const item of responseData.items) {
                let nuevaNoticia = new Noticia();
                nuevaNoticia.titulo = item.title;
                nuevaNoticia.descripcion = item.description;
                nuevaNoticia.visto = false;
                nuevaNoticia.feed = savedFeed;
                NoticiaRepository.save(nuevaNoticia);
            }

            console.log(await FeedRepository.find());


        } catch (error) {
            console.log("Ha habido un error" + error);
        }
    }

    async function LimpiarFeed() {
        NoticiaRepository.clear();
        FeedRepository.clear();

        console.log(await FeedRepository.find());
    }

    return (
        <View>
            <Text>CrearFeeds</Text>
            <TextInput placeholder='Título feed' onChangeText={(value) => {
                setTitulo(value); console.log(titulo);
            }}></TextInput>
            <TextInput placeholder='url del feed' onChangeText={(value) => {
                setUrl(value); console.log(url);
            }}></TextInput>

            <Button title='Crear Feed' onPress={() => crearFeed()}></Button>
            <Button title='Limpiar Feed' onPress={() => LimpiarFeed()}></Button>
        </View>
    )
}

export default CrearFeeds

const styles = StyleSheet.create({})