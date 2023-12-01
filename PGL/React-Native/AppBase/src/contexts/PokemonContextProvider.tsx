import { StyleSheet, Text, View } from 'react-native'
import React, { Dispatch , SetStateAction, createContext, useContext, useState } from 'react';
import {useEffect} from 'react';
import axios from 'axios';

type Props = {}

export type PokemonData = {
    dexEntry: number;
    nombre: string;
    mini_sprite: string;
    sprites: string[];
    render: string;
    habilidad: string[];
    tipo: string[];
}

interface EntryData {
    name: string;
    url: string;
}



//interfaz
export interface PokemonContextType {
    pokemon: PokemonData[];
    setpokemon: Dispatch<SetStateAction<PokemonData[]>>;
}

//contexto
const PokemonContext = createContext<PokemonContextType>({
    pokemon: [],
    setpokemon: () => {}
});

//Proveedor
const PokemonContextProvider = (props: any) => {
    const [listaPokemon, setListaPokemon] = useState<PokemonData[]>([]);
    const uri: string = "https://pokeapi.co/api/v2/pokemon?offset=302&limit=20";
    const [entryData, setEntryData] = useState<EntryData[]>({} as EntryData[]);

    useEffect(() => {
        async function cargarUrl(direccion: string) {
            const response = await axios.get(direccion);
            //console.log(response.data.results);
            const resultados = response.data.results;
            setEntryData(resultados);
        }
        cargarUrl(uri);

    }, []);

    useEffect(() => {
        // console.log("Entry data");
        // console.log(entryData);

        // Función para obtener los datos individuales de un Pokémon
        async function obtenerDatosIndividuales() {
            const datosIndividuales: PokemonData[] = [];

            // Itera sobre la lista de entryData y realiza solicitudes para cada Pokémon
            for (const entry of entryData) {
                try {
                    const response = await axios.get(entry.url);

                    let tipos = [];

                    for(let i = 0; i < 2; i++){
                        if (response.data.types[i]) {
                            tipos.push(response.data.types[i].type.name);
                        }
                    }

                    let habilidades = [];
                    for(let i = 0; i < 3; i++){
                        if (response.data.abilities[i]) {
                            habilidades.push(response.data.abilities[i].ability.name);
                        }
                    }

                    const datosPokemon: PokemonData = {
                        dexEntry: response.data.id,
                        nombre: response.data.name,
                        mini_sprite: response.data.sprites.versions['generation-viii'].icons.front_default,
                        habilidad: habilidades,
                        render: response.data.sprites.other.home.front_default,
                        tipo: tipos,
                        sprites: [response.data.sprites.front_default, response.data.sprites.front_shiny, response.data.sprites.back_default, response.data.sprites.back_shiny]
                    }
                    //setListaPokemon([...listaPokemon, datosPokemon]);
                    datosIndividuales.push(datosPokemon);
                } catch (error) {
                    console.error(`Error al obtener datos del Pokémon ${entry.name}:`, error);
                }
            }

            //console.log(datosIndividuales);
            setListaPokemon(datosIndividuales);
        }

        // Verifica que entryData tenga datos antes de llamar a la función
        if (entryData.length > 0) {
            obtenerDatosIndividuales();
        }
    }, [entryData]);

    useEffect(() => {
        console.log(listaPokemon);
        

    }, [listaPokemon]);

    const contextValues: PokemonContextType = {
        pokemon: listaPokemon,
        setpokemon: setListaPokemon
    }


    return (
        <PokemonContext.Provider value={contextValues}>
            {props.children}
        </PokemonContext.Provider>
      )

}

export const usePokemonContext = () => {
    return useContext(PokemonContext);
}

export default PokemonContextProvider;