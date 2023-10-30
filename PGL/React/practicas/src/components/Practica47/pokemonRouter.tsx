import React from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import PokemonListCard from '../practica40/PokemonListCard';
import PokemonFavorito from './pokemonFavorito';
import PokemonContextProvider from './PokemonContextProvider';

type Props = {}

function PokemonRouter() {


        return (
            <div className="App">
                <BrowserRouter>
                    <h3>Aplicación pokémon</h3>
                    <PokemonContextProvider>
                    <PokemonFavorito/>
                    <Routes>
                        
                        <Route path="/" element={ <PokemonListCard/>} />

                    </Routes>
                    </PokemonContextProvider>
                </BrowserRouter>
            </div>
        );
    
}

export default PokemonRouter