import React, { Dispatch, SetStateAction, createContext, useContext, useState } from 'react'
import { PokemonCardData } from '../practica40/PokemonCard';



export interface PokemonFavorito {
    favorito: PokemonCardData; // El nombre del Pokémon
    setfavorito: Dispatch<SetStateAction<PokemonCardData>>
}

export const PokemonContext = createContext<PokemonFavorito>({} as PokemonFavorito);

const PokemonContextProvider = (props: any) => {
    const [favorito, setFavorito] = useState<PokemonCardData>({} as PokemonCardData);
    const contextValues: PokemonFavorito = {
        favorito: favorito,
        setfavorito: setFavorito
    }


  return (
    <PokemonContext.Provider value={contextValues}>
        {props.children}
    </PokemonContext.Provider>

  );

}

export const useAppContext = () => {
    return useContext(PokemonContext);
}

export default PokemonContextProvider