import React from 'react';
import logo from './logo.svg';
import './App.css';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import RelojesMundiales from './components/RelojesMundiales';
import Practica27 from './components/practica27';
import Navbar from './components/navbar';
import Practica19 from './components/practica19';
import About from './components/Practica38/about';
import ComponentePadre from './components/Practica36/componentePadre';
import AplicacionJuegos from './components/Practica39/aplicacionJuegos';
import Practica31_2 from './components/Practica31_chimp_test/practica31_2';
import Practica20 from './components/practica20';
import Pokemon from './components/Practica42/pokemon';
import Capital from './components/Practica42/capital';
import NavbarEjemplos from './components/Practica42/navbarEjemplos';
import CreatePoblacion from './components/Practica43-44/createPoblacion';
import NavbarProvincias from './components/Practica43-44/navbarProvincias';
import BorrarPoblacion from './components/Practica43-44/borrarPoblacion'; //Practica
import ModifyPoblacion from './components/Practica43-44/modificarPoblacion';

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <h3>Aplicación de juegos</h3>
        <AplicacionJuegos/>
        <h3>Navbar componentes</h3>
        <Navbar />
        <h3>Navbar Pokemon</h3>
        <NavbarEjemplos/>
        <h3>Navbar CRUD</h3>
        <NavbarProvincias/>
          <Routes>
            <Route path="/" element={<About />} /> 
            <Route path="/relojesmundiales" element={<RelojesMundiales />} /> 
            <Route path="/cronometro" element={<Practica27 />} />
            <Route path="/imc" element={<ComponentePadre />} />
            <Route path="/chimp_test" element={<Practica31_2/>}/>
            <Route path="/acertar_numero" element={<Practica20/>}/>
            <Route path="/pokemon/:pokedex" element={<Pokemon/>}/>
            <Route path="/capital/:id" element={<Capital/>}/>
            <Route path="/crear_capital" element={<CreatePoblacion/>}/>
            <Route path="/borrar_capital" element={<BorrarPoblacion/>}/>
            <Route path="/modificar_capital" element={<ModifyPoblacion/>}/>
          </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
