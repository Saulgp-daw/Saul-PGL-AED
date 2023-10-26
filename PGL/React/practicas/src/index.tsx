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
import Practica23 from './components/practica23';
import Practica27 from './components/practica27';
import Practica24 from './components/practica24';
import Practica25 from './components/practica25';
import Practica28 from './components/practica28';
import Practica29 from './components/practica29';
import Practica30 from './components/practica30';
import Practica31 from './components/practica31';
import Practica31_2 from './components/Practica31_chimp_test/practica31_2';
import FormularioProductos from './components/practica32';
import Practica33 from './components/practica33';
import Practica34 from './components/practica34';
import { HijoModificaPadre, PadreModificadoPorHijo } from './components/ejemploPadreHijo';
import EjStateByProps from './components/Practica35/ejStateByProps';
import ComponentePadre from './components/Practica36/componentePadre';
import Practica37 from './components/practica37/practica37';
import PokemonCard from './components/practica40/PokemonCard';
import PokemonListCard from './components/practica40/PokemonListCard';
import CreatePoblacion from './components/createPoblacion';



const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
    <PokemonListCard />
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
