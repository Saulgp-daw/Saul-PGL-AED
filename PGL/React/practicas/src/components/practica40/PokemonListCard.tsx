import axios from 'axios';
import React, { useEffect, useState } from 'react'
import PokemonCard from './PokemonCard';
import '../CSS/practica40.css'
import { BrowserRouter } from 'react-router-dom';

type Props = {}

interface DatosPokemon {
    name: string;
    url: string;
}


const PokemonListCard = (props: Props) => {
    const [urlPokemon, setUrlPokemon] = useState<DatosPokemon[]>([]);
    const uri: string = "https://pokeapi.co/api/v2/pokemon?offset=302&limit=20";


    useEffect(() => {
        async function cargarUrl(direccion: string) {
            const response = await axios.get(direccion);
            //console.log(response.data.results);
            const reultados = response.data.results
            setUrlPokemon(response.data.results);

        }
        cargarUrl(uri);
    }, []);




    return (
        <div>
            <h3>Cartas de Pokémon</h3>
            <div className="pokedex">
                {
                    urlPokemon.map(pokemon => (
                        <PokemonCard urlApi={pokemon.url} />
                    ))
                }
            </div>


        </div>
    )
}

export default PokemonListCard