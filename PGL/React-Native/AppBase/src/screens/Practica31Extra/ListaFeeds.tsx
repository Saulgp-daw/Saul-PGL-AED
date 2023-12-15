import { FlatList, StyleSheet, Text, TouchableHighlight, View } from 'react-native'
import React, { useEffect, useState } from 'react'
import { FeedRepository } from '../../data/Database'
import { Feed } from '../../data/entity/Feed'
import TabNoticias from '../../navigators/TabNoticias'

type Props = {
    navigation: any;
}

const ListaFeeds = ({ navigation }: Props) => {
    const [lista, setLista] = useState<Feed[]>();

    useEffect(() => {
        const cargarFeeds = async () => {
            const feeds = await FeedRepository.find();
            console.log(feeds);

            setLista(feeds);
        }



        const unsubscribe = navigation.addListener("focus", () => {
            cargarFeeds();
        });

        return unsubscribe;
    }, [navigation])

    useEffect(() => {
        const cargarFeeds = async () => {
            const feeds = await FeedRepository.find();
            console.log(feeds);

            setLista(feeds);
        }
        cargarFeeds();

    }, [])

    return (
        <View>
            <Text>ListaFeeds</Text>
            {lista != undefined && lista.length === 0 ? null : (
                <FlatList
                    data={lista}
                    keyExtractor={(item) => item.id.toString()}
                    renderItem={({ item }) => (
                        <View>
                            <TouchableHighlight onPress={() => { navigation.navigate("TabNoticias", { miFeed: item }) }}>
                                <Text>{item.title} </Text>
                            </TouchableHighlight>
                        </View>
                    )}
                />
            )}
        </View>
    )
}

export default ListaFeeds

const styles = StyleSheet.create({})