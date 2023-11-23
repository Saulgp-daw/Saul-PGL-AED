import React from 'react'
import Navbar from '../components/Navbar'
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Tablero from '../components/Tablero';
import Historial from '../components/Historial';
import PartidaContextProvider from '../contexts/PartidaContextProvider';

type Props = {}

const Principal = (props: Props) => {
    return (
        <div>
            <h3>Tres en raya</h3>
            <BrowserRouter>
                <Navbar />
                <PartidaContextProvider>
                    <Routes>
                        <Route path='/' element={<Tablero />}></Route>
                        <Route path='/jugar' element={<Tablero />}></Route>
                        <Route path='/historial' element={<Historial />}></Route>
                    </Routes>
                </PartidaContextProvider>
            </BrowserRouter>


        </div>
    )
}

export default Principal