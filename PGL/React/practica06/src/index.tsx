import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import RelojesMundiales from './Components/RelojesMundiales';
import ComponenteApp from './Components/practica08';
import FCContador from './Components/practica08';
import ComponenteMostrarHora from './Components/practica07';
import MultiplicationTable from './Components/practica09';
import ComponenteArrayAleatorio from './Components/practica10';
import Practica11 from './Components/practica11';
import Practica12 from './Components/practica12';
import practica17 from './Components/practica17';



const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
    <practica17 />
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
