import logo from './logo.svg';
import './App.css';

import React from 'react';
import propTypes from 'prop-types';

export const App = (numeros) => {

  const suma = parseInt(numeros.num1) + parseInt(numeros.num2);
  return (
    <>
      <div>La suma de los dos números es: {suma}</div>
    </>
  )

 
}

App.propTypes = {
  num1: propTypes.number.isRequired,
  num2: propTypes.number.isRequired
}

export default App;

