import React from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Navbar from './Navbar';
import Categorias from '../screens/Categorias';
import Crear from '../screens/Crear';
import Operaciones from '../screens/Operaciones';

type Props = {}

const RouterPeliculas = (props: Props) => {
  return (
    <div>
        <BrowserRouter>
            <Navbar/>
            <Routes>
                <Route path='/crear_pelicula' element={<Crear/>}></Route>
                <Route path='/operaciones' element={<Operaciones/>}></Route>
                <Route path='/categorias' element={<Categorias/>}></Route>
            </Routes>
        </BrowserRouter>
    </div>
  )
}

export default RouterPeliculas