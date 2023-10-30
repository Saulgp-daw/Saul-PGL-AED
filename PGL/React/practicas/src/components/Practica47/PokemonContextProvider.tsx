import React, { Dispatch, SetStateAction, createContext, useContext, useState } from 'react'
import { PokemonCardData } from '../practica40/PokemonCard';



type Props = {}

export interface PokemonFavorito {
    favorito: PokemonCardData; // El nombre del Pokémon
    setfavorito: Dispatch<SetStateAction<PokemonCardData>>
}

export const PokemonContext = createContext<PokemonFavorito>({} as PokemonFavorito);

const PokemonContextProvider = (props: Props) => {
    const [favorito, setFavorito] = useState<PokemonCardData>({} as PokemonCardData);
    const contextValues: PokemonFavorito = {
        favorito: favorito,
        setfavorito: setFavorito
    }


  return (
    <div>PokemonContextProvider</div>
  );

}

export const useAppContext = () => {
    return useContext(PokemonContext);
}

export default PokemonContextProvider