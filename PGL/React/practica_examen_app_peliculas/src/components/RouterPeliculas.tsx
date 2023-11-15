import React from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Navbar from './Navbar';
import Categorias from '../screens/Categorias';
import Crear from '../screens/Crear';
import Operaciones from '../screens/Operaciones';
import Mostrar from '../screens/Mostrar';
import PeliculaCard from './PeliculaCard';
import PeliculasContextProvider from '../contexts/PeliculasContextProvider';
import PeliculasFavoritas from './PeliculasFavoritas';
import MostrarPorCategoria from '../screens/MostrarPorCategoria';

type Props = {}

const RouterPeliculas = (props: Props) => {
  return (
    <div>
      <BrowserRouter>
        <Navbar />
        <PeliculasContextProvider>
          <PeliculasFavoritas />

          <Routes>
            <Route path='/' element={<Mostrar />}></Route>
            <Route path='/pelicula/:id' element={<PeliculaCard />}></Route>
            <Route path='/mostrar' element={<Mostrar />}></Route>
            <Route path='/crear_pelicula' element={<Crear />}></Route>
            <Route path='/categorias' element={<Categorias />}></Route>
            <Route path='/categorias/:nombre' element={<MostrarPorCategoria />}></Route>
          </Routes>
        </PeliculasContextProvider>
      </BrowserRouter>
    </div>
  )
}

export default RouterPeliculas