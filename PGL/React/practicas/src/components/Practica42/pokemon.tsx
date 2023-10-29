import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom';

type Props = {}

interface interfazPokemon {
    name: string; // El nombre del Pokémon
    front: string; // La URL de la imagen del Pokémon
    front_shiny: string;
    back: string;
    back_shiny: string;
    weight: number;
    height: number;
    type1: string;
    type2: string;
}

const Pokemon = (props: Props) => {
    const { pokedex }= useParams();
    const [pokemon, setPokemon] = useState<interfazPokemon>({} as interfazPokemon);
    let rutaPokemon = "https://pokeapi.co/api/v2/pokemon/";

    useEffect(() => {
        async function getPokemon(direccion: string) {
            const response = await axios.get(direccion+pokedex);
            console.log(response.data.types[0].type.name);

            const newPokemon: interfazPokemon = {
                name: response.data.name,
                front: response.data.sprites.front_default,
                front_shiny: response.data.sprites.front_shiny,
                back: response.data.sprites.back_default,
                back_shiny: response.data.sprites.back_shiny,
                weight: response.data.weight,
                height: response.data.height,
                type1: response.data.types[0].type.name,
                type2: response.data.types[1].type.name
            }
            setPokemon(newPokemon);
        }
        getPokemon(rutaPokemon);
    }, [pokedex])

  return (
    <div>
        <h3>Pokédex</h3>
        
        <p>{JSON.stringify(pokemon)}</p>
    </div>
  )
}

export default Pokemon