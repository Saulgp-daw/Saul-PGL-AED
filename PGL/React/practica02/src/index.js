import React from 'react';
import ReactDOM from 'react-dom';// también puede aparecer como: ‘react-dom/client’
const mensaje = <h1>Vamos a renderizar este mensaje en nuestra web</h1>;
const divRoot = document.getElementById("root");
ReactDOM.render( mensaje, divRoot)