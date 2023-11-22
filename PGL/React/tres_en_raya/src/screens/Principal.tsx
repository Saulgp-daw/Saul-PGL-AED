import React from 'react'
import Navbar from '../components/Navbar'
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Tablero from '../components/Tablero';
import Historial from '../components/Historial';

type Props = {}

const Principal = (props: Props) => {
    return (
        <div>
            <h3>Tres en raya</h3>
            <BrowserRouter>
                <Navbar />
                <Routes>
                <Route path='/' element={<Tablero/>}></Route>
                    <Route path='/jugar' element={<Tablero/>}></Route>
                    <Route path='/historial' element={<Historial/>}></Route>
                </Routes>
            </BrowserRouter>


        </div>
    )
}

export default Principal