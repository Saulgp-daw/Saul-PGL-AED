import { FlatList, StyleSheet, Text, TouchableHighlight, View } from 'react-native'
import React, { useEffect, useState } from 'react'
import { Feed } from '../../data/entity/Feed'
import { NoticiaRepository } from '../../data/Database'
import { Noticia } from '../../data/entity/Noticia'

type Props = {
    miFeed: Feed;
    navigation?: any;
}

const ListaNoticiasNoVistas = ({ miFeed, navigation }: Props) => {
    const feed = miFeed;
    const [noticias, setNoticias] = useState<Noticia[]>();
    console.log(feed);

    useEffect(() => {
        const cargarNoticias = async () => {
            const noticiasCargadas = await NoticiaRepository.find({
                where: {
                    feed: { id: feed.id },
                }
            });
            setNoticias(noticiasCargadas);
        }
        const unsubscribe = navigation.addListener("focus", () => {
            cargarNoticias();
        });

        return unsubscribe;
    }, [navigation])

    return (
        <View>
            <Text>Lista Noticias No Vistas</Text>
            {noticias != undefined && noticias.length === 0 ? null : (
                <FlatList
                    data={noticias}
                    keyExtractor={(item) => item.id.toString()}
                    renderItem={({ item }) => {
                        if (item.visto) {
                            return (
                                <View>
                                    <TouchableHighlight onPress={() => { navigation.navigate('Articulo', { articulo: item.descripcion }) }}>
                                        <Text>{item.titulo} </Text>
                                    </TouchableHighlight>
                                </View>
                            );
                        }
                    }}
                />
            )}
        </View>
    )
}

export default ListaNoticiasNoVistas

const styles = StyleSheet.create({})