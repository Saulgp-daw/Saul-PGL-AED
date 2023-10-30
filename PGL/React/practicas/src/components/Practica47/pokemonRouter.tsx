import React from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import PokemonListCard from '../practica40/PokemonListCard';
import PokemonFavorito from './pokemonFavorito';

type Props = {}

function PokemonRouter() {


        return (
            <div className="App">
                <BrowserRouter>
                    <h3>Aplicación pokémon</h3>
                    <PokemonFavorito/>
                    <Routes>
                        
                        <Route path="/" element={ <PokemonListCard/>} />

                    </Routes>
                </BrowserRouter>
            </div>
        );
    
}

export default PokemonRouter