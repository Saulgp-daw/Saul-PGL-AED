import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import "./components/CSS/practica16.css";

import App from './App';
import reportWebVitals from './reportWebVitals';
import ListaMonedas from './components/practica13';
import Tabla from './components/Tabla';
import TodasLasTablas from './components/practica14';
import Practica15 from './components/practica15';
import Practica16 from './components/practica16';
import Practica17 from './components/practica17';
import PruebaUseEffect from './components/pruebaUseEffect';
import Practica18_useEffect from './components/practica18_1';
import Practica19 from './components/practica19';
import Practica20 from './components/practica20';
import EjemploRelojActivo from './components/practica21';
import RelojMundialActivo from './components/Practica22/practica22';

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
    <RelojMundialActivo />
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
