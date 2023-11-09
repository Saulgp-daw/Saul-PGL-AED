import React from 'react'
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import ComponentePadre from '../Practica36/componentePadre';

type Props = {}

const IMCRouter = (props: Props) => {
    return (
        <div className="App">
            <BrowserRouter>
                <h3>Aplicación IMC</h3>

                <Routes>
                    
                    <Route path="/" element={ <ComponentePadre/>} />

                </Routes>
               
            </BrowserRouter>
        </div>
    );
}

export default IMCRouter